<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    protected $category;
    protected $brand;
    protected $receipt_detail;


    public function __construct(Product $product, Category $category, Brand $brand)
    {
        $this->product = $product;
        $this->category = $category;
        $this->brand = $brand;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->product->with('brand')->latest('id');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10);
        return view('admin.products.index', compact('products'))->with('search', $request->search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->get(['id', 'name']);
        $brands = $this->brand->get(['id', 'name']);
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $dataUpdate = $request->all();
        $dataUpdate['img'] = $this->product->saveImage($request);
        $product = $this->product->create($dataUpdate);
        $product->assignCategory($dataUpdate['category_ids']);
        return to_route('products.index')->with(['message' => 'Thêm sản phẩm mới thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = $this->category->get(['id', 'name']);
        $brands = $this->brand->get(['id', 'name']);
        $product = $this->product->with(['categories'])->findOrFail($id);
        return view('admin.products.show', compact('product', 'categories', 'brands'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->category->get(['id', 'name']);
        $brands = $this->brand->get(['id', 'name']);
        $product = $this->product->with(['categories'])->findOrFail($id);
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $dataUpdate = $request->all();
        $product = $this->product->findOrFail($id);
        $currentImange = $product->img ? $product->img : '';
        $dataUpdate['img'] = $this->product->updateImage($request, $currentImange);
        $product->update($dataUpdate);
        $product->assignCategory($dataUpdate['category_ids']);
        return to_route('products.index')->with(['message' => 'Chỉnh sửa sản phẩm thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);
        $imageName = $product->img ? $product->img : '';
        $product->delete();
        $this->product->deleteImage($imageName);
        return to_route('products.index')->with(['message' => 'Xóa sản phẩm thành công']);
    }
}

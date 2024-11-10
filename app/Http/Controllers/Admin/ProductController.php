<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.products.index', compact('products', 'staff'))->with('search', $request->search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateStaffNumber()
    {
        do {
            // Random số từ 0 đến 9999 và chuyển thành chuỗi 4 chữ số
            $productCode = str_pad(mt_rand(0, 9999999), 7, '0', STR_PAD_LEFT);

            // Kiểm tra xem mã số này đã tồn tại hay chưa
        } while ($this->product->where('code', $productCode)->exists());

        return $productCode;
    }
    public function create()
    {
        $productCode = $this->generateStaffNumber();
        $categories = $this->category->get(['id', 'name']);
        $brands = $this->brand->get(['id', 'name']);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.products.create', compact('categories', 'brands', 'productCode', 'staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $dataCreate = $request->all();
        $dataCreate['img'] = $this->product->saveImage($request);
        $product = $this->product->create($dataCreate);
        $product->assignCategory($dataCreate['category_ids']);
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
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.products.show', compact('product', 'categories', 'brands', 'staff'));
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
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'staff'));
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

    public function searchProduct(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")->get();
        return response()->json($products);
    }
}

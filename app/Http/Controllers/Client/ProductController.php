<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $categoryId)
    {
        $products = $this->product->getBy($request->all(), $categoryId);

        if (Auth::check() && Auth::user()->userable_type === Customer::class) {
            $customer = Customer::find(Auth::user()->userable_id);
            return view('client.products.index', compact('products', 'categoryId', 'customer'));
        }
        return view('client.products.index', compact('products', 'categoryId'));
    }



    public function filter(Request $request, $categoryId)
    {
        $option = $request->input('option');

        $products = Product::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->with('productdetails');


        // Lọc sản phẩm theo tùy chọn
        switch ($option) {
            case 'latest':
                $products = $products->orderBy('created_at', 'desc');
                break;
            case 'price_asc':
                $products = $products->with(['productdetails' => function ($query) {
                    $query->orderBy('price', 'asc');
                }])->addSelect([
                    'min_price' => ProductDetail::select('price') // tạo cột min_price để lấy giá thấp nhất của từng sản phẩm
                        ->whereColumn('product_id', 'products.id')
                        ->orderBy('price', 'asc')
                        ->limit(1)
                ])->orderBy('min_price', 'asc'); // sắp xếp các sản phẩm theo thứ tự giá tăng dần
                break;
            case 'price_desc':
                $products = $products->with(['productdetails' => function ($query) {
                    $query->orderBy('price', 'desc');
                }])->addSelect([
                    'min_price' => ProductDetail::select('price')
                        ->whereColumn('product_id', 'products.id')
                        ->orderBy('price', 'desc')
                        ->limit(1)
                ])->orderBy('min_price', 'desc');
                break;
            default:
                break;
        }

        $products = $products->paginate(12);

        if (Auth::check() && Auth::user()->userable_type === Customer::class) {
            $customer = Customer::find(Auth::user()->userable_id);
            return view('client.products.index', compact('products', 'categoryId', 'customer'));
        }
        return view('client.products.index', compact('products', 'categoryId'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->with('productdetails', 'categories', 'brand')->findOrFail($id);
        return view('client.products.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

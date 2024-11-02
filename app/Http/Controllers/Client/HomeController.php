<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\News;
use App\Models\Product;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $product;
    protected $category;
    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = Banner::all();
        $brands = Brand::where('highlight', true)->get();
        $news = News::where('highlight', true)->get();


        $query = $this->product->query();
        $products = $query->where('name', 'like', '%' . $request->search . '%')->get();

        $categories = $this->category->all();

        foreach ($categories as $category) {
            $category->products = $category->products()->latest()->take(6)->get();
        }
        if (Auth::check()) {
            if (Auth::user()->userable_type === Customer::class) {
                $customer = Customer::find(Auth::user()->userable_id);
                return view('client.home.index', compact('categories', 'customer', 'products', 'brands', 'news', 'banners'))->with('search', $request->search);
            } else if (Auth::user()->userable_type === Staff::class) {
                $staff = Staff::find(Auth::user()->userable_id);
                return view('admin.dashboard.index', compact('staff'));
            }
        } else
            return view('client.home.index', compact('categories', 'products', 'brands', 'news', 'banners'))->with('search', $request->search);
    }

    public function contact()
    {
        if (Auth::check() && Auth::user()->userable_type === Customer::class) {
            $customer = Customer::find(Auth::user()->userable_id);
            return view('client.home.contact', compact('customer'));
        }
        return view('client.home.contact');
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
        //
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

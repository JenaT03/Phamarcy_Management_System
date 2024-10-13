<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReleaseDetails\CreateReleaseDetailRequest;
use App\Http\Requests\ReleaseDetails\UpdateReleaseDetailRequest;
use App\Models\Product;
use App\Models\Release;
use App\Models\ReleaseDetail;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReleaseDetailController extends Controller
{
    protected $releaseDetail;
    protected $release;
    protected $product;

    public function __construct(ReleaseDetail $releaseDetail, Release $release, Product $product)
    {
        $this->release = $release;
        $this->releaseDetail = $releaseDetail;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $release = $this->release->find($id);
        $releaseId = $release->id;
        $customer = $release->customer;
        $releaseDetails = $release->release_details()->with('product')->get();
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.releasedetails.create', compact('releaseId', 'releaseDetails', 'customer', 'staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */




    public function store(CreateReleaseDetailRequest $request)
    {
        $dataCreate = $request->all();
        $product = $this->product->where('code', $dataCreate['product_code'])->first();

        $releaseId = $dataCreate['release_id'];
        $release = $this->release->findOrFail($releaseId);
        $sameReleaseDetail = $release->release_details()->where('product_code', $dataCreate['product_code'])->get();
        $quantity = $dataCreate['quantity'] + $sameReleaseDetail->sum('quantity');

        if (!$this->releaseDetail->checkQuantity($product, $quantity)) {
            return redirect()->back()->withErrors(['quantity' => 'Vượt quá số lượng tồn kho'])->withInput();
        } else {
            $productPrice = $product->productdetails()->latest('id')->first()->price ?? 0;
            $releaseDetail = $this->releaseDetail->create(array_merge($dataCreate, ['product_id' => $product->id], ['price' => $productPrice]));
            return to_route('releasedetails.create', $releaseId);
        }
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
    public function edit($id, $releaseId)
    {
        $release = $this->release->findOrFail($releaseId);
        $releaseDetail = $this->releaseDetail->findOrFail($id);
        $customer = $release->customer;
        $releaseDetails = $release->release_details()->with('product')->get();
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.releasedetails.edit', compact('releaseDetail', 'releaseId', 'releaseDetails', 'customer', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReleaseDetailRequest $request, $id)
    {
        $dataUpdate = $request->all();
        $releaseDetail = $this->releaseDetail->findOrFail($id);
        $product = $this->product->where('code', $dataUpdate['product_code'])->first();

        $releaseId = $dataUpdate['release_id'];
        $release = $this->release->findOrFail($releaseId);
        $sameReleaseDetail = $release->release_details()
            ->where('product_code', $dataUpdate['product_code'])
            ->where('id', '!=', $id)
            ->get();
        $quantity = $dataUpdate['quantity'] + $sameReleaseDetail->sum('quantity');

        if (!$this->releaseDetail->checkQuantity($product, $quantity)) {
            return redirect()->back()->withErrors(['quantity' => 'Vượt quá số lượng tồn kho'])->withInput();
        } else {
            $productPrice = $product->productdetails()->latest('id')->first()->price ?? 0;
            $releaseDetail->update(array_merge($dataUpdate, ['product_id' => $product->id], ['price' => $productPrice]));
            return to_route('releasedetails.create', $releaseId);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $releaseId)
    {
        $releaseDetail = $this->releaseDetail->findOrFail($id);
        $releaseDetail->delete();
        return to_route('releasedetails.create', ['id' => $releaseId]);
    }
}

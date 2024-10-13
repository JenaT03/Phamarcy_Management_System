<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiptDetails\CreateReceiptDetailRequest;
use App\Http\Requests\ReceiptDetails\UpdateReceiptDetailRequest;
use App\Http\Requests\Receipts\UpdateReceiptRequest;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptDetailController extends Controller
{
    protected $receiptDetail;
    protected $receipt;
    protected $productDetail;
    protected $product;

    public function __construct(ReceiptDetail $receiptDetail, Receipt $receipt, ProductDetail $productDetail, Product $product)
    {
        $this->receiptDetail = $receiptDetail;
        $this->receipt = $receipt;
        $this->productDetail = $productDetail;
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $receipt = $this->receipt->find($id);
        $receiptId = $receipt->id;
        $supplierName = $receipt->supplier->name;
        $receiptDetails = $receipt->receipt_details()->with('product')->get();
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.receiptdetails.create', compact('receiptId', 'receiptDetails', 'supplierName', 'staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReceiptDetailRequest $request)
    {

        $dataCreate = $request->all();
        $product = $this->product->where('code', $dataCreate['product_code'])->first();



        $receiptDetail = $this->receiptDetail->create(array_merge($dataCreate, ['product_id' => $product->id]));
        $receiptId = $receiptDetail->receipt_id;

        $this->productDetail->create(
            [
                'product_id' => $product->id,
                'receipt_detail_id' => $receiptDetail->id,
                'price' => $dataCreate['selling_price'],
                'quantity' => $dataCreate['quantity'],
                'expiry' => $dataCreate['expiry']
            ]
        );
        return to_route('receiptdetails.create', ['id' => $receiptId]);
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
    public function edit($id, $receiptId)
    {
        $receipt = $this->receipt->find($receiptId);
        $receiptDetail = $this->receiptDetail->findOrFail($id);

        $supplierName = $receipt->supplier->name;
        $receiptDetails = $receipt->receipt_details()->with('product')->get();
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.receiptdetails.edit', compact('receiptId', 'receiptDetails', 'supplierName', 'receiptDetail', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceiptDetailRequest $request, $id)
    {
        $dataUpdate = $request->all();
        $receiptDetail = $this->receiptDetail->findOrFail($id);
        $receiptId = $dataUpdate['receipt_id'];
        $product = $this->product->where('code', $dataUpdate['product_code'])->first();



        $receiptDetail->update(array_merge($dataUpdate, ['product_id' => $product->id]));
        $productDetail = $this->productDetail->where('receipt_detail_id', $receiptDetail->id)->first();

        if ($productDetail) {
            $productDetail->update([
                'product_id' => $product->id,
                'receipt_detail_id' => $receiptDetail->id,
                'price' => $dataUpdate['selling_price'],
                'quantity' => $dataUpdate['quantity'],
                'expiry' => $dataUpdate['expiry']
            ]);
        }
        return to_route('receiptdetails.create', ['id' => $receiptId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id, $receiptId)
    {
        $receiptDetail = $this->receiptDetail->findOrFail($id);
        $receiptDetail->delete();
        return to_route('receiptdetails.create', ['id' => $receiptId]);
    }
}

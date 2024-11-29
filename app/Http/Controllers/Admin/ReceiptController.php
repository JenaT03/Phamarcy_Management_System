<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Receipts\CreateReceiptRequest;
use App\Http\Requests\Receipts\UpdateReceiptRequest;
use App\Models\ProductDetail;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use App\Models\Staff;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class ReceiptController extends Controller
{

    protected $receipt;
    protected $supplier;
    protected $staff;
    public function __construct(Receipt $receipt, Staff $staff, Supplier $supplier)
    {
        $this->receipt = $receipt;
        $this->staff = $staff;
        $this->supplier = $supplier;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            $staff = $this->staff->find(Auth::user()->userable_id);
            $query = $this->receipt->with('supplier', 'staff', 'receipt_details')->latest('id');
            $search = $request->search ?? '';
            $search = $request->search ?? '';
            if (!empty($search)) {
                $query->where('id', 'like', '%' . $request->search . '%');
            }
            $receipts = $query->paginate(10);
            return view('admin.receipts.index', compact('staff', 'receipts', 'search'));
        } else return to_route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $staff = $this->staff->find(Auth::user()->userable_id);
            $suppliers = $this->supplier->get(['id', 'name']);
            $currentDateTime = now()->format('Y-m-d H:i');
            return view('admin.receipts.create', compact('staff', 'suppliers', 'currentDateTime'));
        } else return to_route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReceiptRequest $request)
    {
        $dataCreate = $request->all();
        $dataCreate['datetime'] = Carbon::createFromFormat('Y-m-d H:i', $request->datetime);
        $receipt = $this->receipt->create($dataCreate);
        $receiptId = $receipt->id;
        return to_route('receiptdetails.create', ['id' => $receiptId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (Auth::check()) {
            $staff = Staff::find(Auth::user()->userable_id);
            $receipt = $this->receipt->find($id);
            $query = ReceiptDetail::with('product')->where('receipt_id', $id)->latest('id');
            $search = $request->search ?? '';
            if (!empty($search)) {
                $query->whereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            }

            $receiptDetails = $query->paginate(10);
            return view('admin.receipts.show', compact('staff', 'receiptDetails', 'receipt', 'search'));
        } else return to_route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $staff = $this->staff->find(Auth::user()->userable_id);
            $suppliers = $this->supplier->get(['id', 'name']);
            $currentDateTime = now()->format('Y-m-d H:i');
            $receipt = $this->receipt->findOrFail($id);
            return view('admin.receipts.edit', compact('receipt', 'staff', 'suppliers', 'currentDateTime'));
        } else return to_route('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceiptRequest $request, $id)
    {
        $dataUpdate = $request->all();
        $receipt = $this->receipt->findOrFail($id);
        $receipt->update($dataUpdate);
        return to_route('receiptdetails.create', ['id' => $receipt->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $receipt = $this->receipt->findOrFail($id);
        $receipt->delete();
        return to_route('receipts.index')->with(['message' => 'Xóa đơn nhập hàng thành công']);
    }

    public function saveTotal(Request $data, $id)
    {
        $receipt = $this->receipt->with(['receipt_details'])->findOrFail($id);
        $receipt->update(['total' => $data['total']]);
        $receiptDetails = $receipt->receipt_details()->get();
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.receipts.receipt-finish', compact('receipt', 'receiptDetails', 'staff'));
    }

    public function generatePrintReceipt($id)
    {
        $receipt = $this->receipt->findOrFail($id);
        $receiptDetails = $receipt->receipt_details()->get();
        $data = ['receipt' => $receipt, 'receiptDetails' => $receiptDetails];
        $pdf = Pdf::loadView('admin.receipts.receipt-print', $data);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('phieu_nhap-' . $receipt->id . '-' . $todayDate . '.pdf');
    }
}

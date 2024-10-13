<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Releases\SearchCustomerRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Release;
use App\Models\ReleaseDetail;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class ReleaseController extends Controller
{
    protected $customer;
    protected $release;
    protected $staff;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Release $release, Customer $customer, Staff $staff)
    {
        $this->release = $release;
        $this->customer = $customer;
        $this->staff = $staff;
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            $staff = $this->staff->find(Auth::user()->userable_id);
            $query = $this->release->with('customer', 'staff')->latest('id');
            $search = $request->search ?? '';
            if (!empty($search)) {
                $query->where('id', 'like', '%' . $request->search . '%');
            }
            $releases = $query->paginate(10);
            return view('admin.releases.index', compact('staff', 'releases', 'search'));
        } else return to_route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $customer = $this->customer->find($id);
        $staff = Staff::find(Auth::user()->userable_id);
        $currentDateTime = now()->format('Y-m-d H:i');
        return view('admin.releases.create', compact('customer', 'staff', 'currentDateTime'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataCreate = $request->all();
        $staff = $this->staff->where('code', $dataCreate['staff_code'])->first();
        $dataCreate['staff_id'] = $staff->id;
        $release = $this->release->create($dataCreate);
        $releaseId = $release->id;
        return to_route('releasedetails.create', $releaseId);
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
            $release = $this->release->find($id);
            $query = ReleaseDetail::with('product')->where('release_id', $id)->latest('id');
            $search = $request->search ?? '';
            if (!empty($search)) {
                $query->whereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            }

            $releaseDetails = $query->paginate(10);
            return view('admin.releases.show', compact('staff', 'releaseDetails', 'release', 'search'));
        } else return to_route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $customerId)
    {
        $customer = null;
        if ($customerId != 0) {
            $customer = $this->customer->findOrFail($customerId);
        }
        $release = $this->release->findOrFail($id);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.releases.edit', compact('release', 'customer', 'staff'));
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
        $dataCreate = $request->all();
        $staff = $this->staff->where('code', $dataCreate['staff_code'])->first();
        $dataCreate['staff_id'] = $staff->id;
        $release = $this->release->findOrFail($id);
        $release->update($dataCreate);
        $releaseId = $release->id;
        return to_route('releasedetails.create', $releaseId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $release = $this->release->findOrFail($id);
        $release->delete();
        return to_route('releases.index')->with(['message' => 'Xóa đơn nhập hàng thành công']);
    }


    public function search(Request $request)
    {
        $query = $this->customer->latest('id');
        if ($request->has('search') && !empty($request->search)) {
            $query->where('phone', 'like', '%' . $request->search . '%');
        }

        $customers = $query->paginate(10);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.releases.search_customer', compact('customers', 'staff'))->with('search', $request->search);
    }



    public function finish(Request $data, $id)
    {
        $release = $this->release->findOrFail($id);
        $release->update(['total' => $data['total']]);
        $releaseDetails = $release->release_details()->get();
        foreach ($releaseDetails as $releaseDetail) {
            $product = Product::where('code', $releaseDetail->product_code)->first();
            $quantity = $releaseDetail->quantity;
            $this->release->reduceProductQuantity($product, $quantity);
        }
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.releases.invoice', compact('release', 'releaseDetails', 'staff'));
    }

    public function generateInvoice($id)
    {
        $release = $this->release->findOrFail($id);
        $releaseDetails = $release->release_details()->get();
        $data = ['release' => $release, 'releaseDetails' => $releaseDetails];
        $pdf = Pdf::loadView('admin.releases.invoice-print', $data);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('hoa_don-' . $release->id . '-' . $todayDate . '.pdf');
    }
}

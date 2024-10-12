<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suppliers\CreateSupplierRequest;
use App\Http\Requests\Suppliers\UpdateSupplierRequest;
use App\Models\Staff;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    protected $supplier;
    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->supplier->latest('id');
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $suppliers = $query->paginate(10);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.suppliers.index', compact('suppliers', 'staff'))->with('search', $request->search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.suppliers.create', compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSupplierRequest $request)
    {
        $dataCreate = $request->all();
        $supplier = $this->supplier->create($dataCreate);
        return to_route('suppliers.index')->with(['message' => 'Thêm nhà cung cấp mới thành công']);
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
        $supplier = $this->supplier->findOrFail($id);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.suppliers.edit', compact('supplier', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, $id)
    {
        $dataUpdate = $request->all();
        $supplier = $this->supplier->findOrFail($id);
        if (!$supplier->update($dataUpdate)) {
            return back()->withErrors(['error' => 'Cập nhật thông tin nhà cung cấp thất bại.']);
        }
        return to_route('suppliers.index')->with(['message' => 'Cập nhật thông tin nhà cung cấp thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = $this->supplier->findOrFail($id);
        if (! $supplier->delete()) {
            return back()->withErrors(['error' => 'Xóa nhà cung cấp thất bại.']);
        }

        return to_route('suppliers.index')->with(['message' => 'Xóa nhà cung cấp thành công']);
    }
}

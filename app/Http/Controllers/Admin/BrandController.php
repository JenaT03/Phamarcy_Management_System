<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brands\CreateBrandRequest;
use App\Http\Requests\Brands\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{

    protected $brand;
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->brand->latest('id');
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $brands = $query->paginate(10);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.brands.index', compact('brands', 'staff'))->with('search', $request->search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.brands.create', compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrandRequest $request)
    {
        $dataCreate = $request->all();
        $brand = $this->brand->create($dataCreate);
        return to_route('brands.index')->with(['message' => 'Thêm nhãn hàng mới thành công']);
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
        $brand = $this->brand->findOrFail($id);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.brands.edit', compact('brand', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $dataUpdate = $request->all();
        $brand = $this->brand->findOrFail($id);
        if (!$brand->update($dataUpdate)) {
            return back()->withErrors(['error' => 'Cập nhật thông tin nhãn hàng thất bại.']);
        }
        return to_route('brands.index')->with(['message' => 'Cập nhật thông tin nhãn hàng thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->brand->findOrFail($id);
        if (! $brand->delete()) {
            return back()->withErrors(['error' => 'Xóa nhãn hàng thất bại.']);
        }

        return to_route('brands.index')->with(['message' => 'Xóa nhãn hàng thành công']);
    }
}

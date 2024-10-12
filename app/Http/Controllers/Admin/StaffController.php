<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staffs\CreateStaffRequest;
use App\Http\Requests\Staffs\UpdateStaffRequest;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    protected $staff;
    protected $role;

    public function __construct(Staff $staff, Role $role)
    {
        $this->staff = $staff;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->staff->latest('id');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        $staffs = $query->paginate(10);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.staffs.index', compact('staffs', 'staff'))->with('search', $request->search);
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
            $staffCode = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

            // Kiểm tra xem mã số này đã tồn tại hay chưa
        } while (Staff::where('code', $staffCode)->exists());

        return $staffCode;
    }
    public function create()
    {
        $staffCode = $this->generateStaffNumber();
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.staffs.create', compact('staffCode', 'staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStaffRequest $request)
    {
        $dataCreate = $request->all();
        $staff = $this->staff->create($dataCreate);
        return to_route('users.create', ['phone' => $staff->phone, 'user_type' => 'staff']);
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
        $staffEdited = $this->staff->findOrFail($id);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.staffs.edit', compact('staffEdited', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStaffRequest $request, $id)
    {
        $dataUpdate = $request->all();
        $staff = $this->staff->findOrFail($id);
        if (!$staff->update($dataUpdate)) {
            return back()->withErrors(['error' => 'Cập nhật thông tin nhân viên thất bại.']);
        }

        $staff = $this->staff->findOrFail($id);
        $user = $staff->users;
        if ($user) {
            return to_route('users.edit', ['user' => $user->id, 'phone' => $staff->phone, 'user_type' => 'staff']);
        }
        return back()->withErrors(['error' => 'Không tìm thấy người dùng liên quan tới nhân viên này.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = $this->staff->findOrFail($id);
        $user = $staff->users;
        $staff->delete();
        if ($user) {
            $user->delete();
            return to_route('staffs.index')->with(['message' => 'Xóa khách hàng thành công']);
        }
        return back()->withErrors(['error' => 'Không tìm thấy người dùng liên quan tới khách hàng này.']);
    }

    public function detail()
    {
        //
    }
}

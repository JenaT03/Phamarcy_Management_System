<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Customer;
use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $user;
    protected $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->all()->groupBy('group');
        $user_type = request('user_type');
        $groupName = '';
        if ($user_type == 'customer') {
            $roles = $roles['user'];
            $groupName = 'User';
        } else {
            if ($user_type == 'staff') {
                $roles = $roles['system'];
                $groupName = 'System';
            }
        }

        $role = request('role');
        if ($role == 'customer') return view('admin.users.create', compact('roles', 'groupName', 'user_type', 'role'));
        else {
            $staff = Staff::find(Auth::user()->userable_id);
            return view('admin.users.create', compact('roles', 'user_type', 'groupName', 'staff'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $dataCreate = $request->all();
        // Mã hóa mật khẩu
        $dataCreate['password'] = Hash::make($request->password);
        $user = new User();
        $user->phone = $dataCreate['phone'];
        $user->password = $dataCreate['password'];
        // $redirectRoute = 'admin.dashboard.index';
        // $message = 'Đã có lỗi xảy ra';
        if ($request->user_type == 'customer') {
            $customer = Customer::where('phone', $request->phone)->first();
            if (!$customer) {
                return back()->withErrors(['message' => 'Không tìm thấy khách hàng với số điện thoại này']);
            }
            $user->userable_id = $customer->id;
            $user->userable_type = Customer::class;
            if ($request->role == 'customer') {
                $redirectRoute = 'login.index';
                $message = 'Tạo tài khoản thành công, hãy đăng nhập.';
            } else {
                $redirectRoute = 'customers.index';
                $message = 'Thêm khách hàng thành công';
            }
        } else {
            if ($request->user_type == 'staff') {
                $staff = Staff::where('phone', $request->phone)->first();
                if (!$staff) {
                    return back()->withErrors(['message' => 'Không tìm thấy khách hàng với số điện thoại này']);
                }
                $user->userable_id = $staff->id;
                $user->userable_type = Staff::class;
                $redirectRoute = 'staffs.index';
                $message = 'Thêm nhân viên thành công';
            }
        }
        $user->save();
        $user->roles()->attach($dataCreate['role_ids']);
        return to_route($redirectRoute)->with(['message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staffShow = Staff::where('id', $id)->firstOrFail();
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.users.show', compact('staff', 'staffShow'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = $this->user->findOrFail($id)->load('roles');
        $roles = $this->role->all()->groupBy('group');
        $phone = request('phone');
        $user_type = request('user_type');
        $groupName = '';
        if (request('user_type') == 'customer') {
            $roles = $roles['user'];
            $groupName = 'User';
        } else {
            if (request('user_type') == 'staff') {
                $roles = $roles['system'];
                $groupName = 'System';
            }
        }

        $role = request('role');
        if ($role == 'customer') return view('admin.users.edit', compact('user', 'roles', 'phone', 'user_type', 'groupName', 'role'));
        else return view('admin.users.edit', compact('user', 'roles', 'phone', 'user_type', 'groupName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $dataCreate = $request->except('password');

        // Mã hóa mật khẩu nếu có mật khẩu mới
        if ($request->password) {
            $dataCreate['password'] = Hash::make($request->password);
        }

        $user = null;


        if ($request->user_type == 'customer') {
            $customer = Customer::where('phone', $request->phone)->first();

            if ($customer) {

                $user = $this->findOrCreateUser($customer->id, Customer::class, $dataCreate);
                if ($request->role) {
                    $message = 'Chỉnh sửa thông tin cá nhân thành công';
                    return to_route('profile.show', $customer->id)->with(['message' => $message]);
                } else {
                    $redirectRoute = 'customers.index';
                    $message = 'Chỉnh sửa thông tin khách hàng thành công';
                }
            } else {
                return back()->withErrors(['message' => 'Không tìm thấy khách hàng với số điện thoại này']);
            }
        } elseif ($request->user_type == 'staff') {
            $staff = Staff::where('phone', $request->phone)->first();

            if ($staff) {
                $user = $this->findOrCreateUser($staff->id, Staff::class, $dataCreate);
                $redirectRoute = 'staffs.index';
                $message = 'Chỉnh sửa thông tin nhân viên thành công';
            } else {
                return back()->withErrors(['message' => 'Không tìm thấy nhân viên với số điện thoại này']);
            }
        }

        if ($user && isset($dataCreate['role_ids'])) {
            $user->roles()->sync($dataCreate['role_ids']);
        }

        return to_route($redirectRoute)->with(['message' => $message]);
    }

    /**
     * Tìm hoặc tạo User dựa trên userable_id và userable_type
     */
    private function findOrCreateUser($userableId, $userableType, $dataCreate)
    {
        $user = User::where('userable_id', $userableId)->where('userable_type', $userableType)->first();

        if (!$user) {
            $user = new User();
            $user->phone = $dataCreate['phone'];
            $user->password = $dataCreate['password'];
            $user->userable_id = $userableId;
            $user->userable_type = $userableType;
            $user->save();
        } else {
            if (isset($dataCreate['password'])) {
                $user->password = $dataCreate['password'];
            }
            $user->phone = $dataCreate['phone'];
            $user->save();
        }

        return $user;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->findOrFail($id)->load('roles');
        $user->delete();
        //return to_route('customers.index')->with(['message' => 'Xóa khách hàng thành công']);
    }
}

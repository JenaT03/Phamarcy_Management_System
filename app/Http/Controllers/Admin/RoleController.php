<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\CreateRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Role::latest('id');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $roles = $query->paginate(10);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.roles.index', compact('roles', 'staff'))->with('search', $request->search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('group');
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.roles.create', compact('permissions', 'staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $dataCreate = $request->all();

        $role = Role::create($dataCreate);
        $role->permissions()->attach($dataCreate['permission_ids']); //gán quyền
        return to_route('roles.index')->with(['message' => 'Tạo vai trò mới thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.roles.show', compact('role', 'staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $role = Role::with('permissions')->findOrFail($id); //Tìm role theo id rồi Role::with('permissions') lấy thông tin của role và các permission liên quan
        $permissions = Permission::all()->groupBy('group'); // lấy toàn bộ permission và nhóm theo group
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.roles.edit', compact('role', 'permissions', 'staff')); // compact 2 mảng
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $dataUpdate = $request->all();
        $role->update($dataUpdate);
        $role->permissions()->sync($dataUpdate['permission_ids']); //Nếu không có quyền nào được chọn trong form, sync() sẽ xóa tất cả quyền liên quan đến vai trò này.
        return to_route('roles.index')->with(['message' => 'Cập nhật vai trò thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return to_route('roles.index')->with(['message' => 'Xóa vai trò thành công']);
    }
}

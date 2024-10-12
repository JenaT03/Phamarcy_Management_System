<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $permissions = [
            ['name' => 'create-receipt', 'display_name' => 'Thêm phiếu nhập/Chi tiết phiếu nhập', 'group' => 'Phiếu nhập/Chi tiết phiếu nhập'],
            ['name' => 'edit-receipt', 'display_name' => 'Sửa phiếu nhập/Chi tiết phiếu nhập', 'group' => 'Phiếu nhập/Chi tiết phiếu nhập'],
            ['name' => 'delete-receipt', 'display_name' => 'Xóa phiếu nhập/Chi tiết phiếu nhập', 'group' => 'Phiếu nhập/Chi tiết phiếu nhập'],
            ['name' => 'show-receipt', 'display_name' => 'Xem danh sách phiếu nhập/Chi tiết phiếu nhập', 'group' => 'Phiếu nhập/Chi tiết phiếu nhập'],

            ['name' => 'create-release', 'display_name' => 'Thêm phiếu xuất/Chi tiết phiếu xuất', 'group' => 'Phiếu xuất/Chi tiết phiếu xuất'],
            ['name' => 'edit-release', 'display_name' => 'Sửa phiếu xuất/Chi tiết phiếu xuất', 'group' => 'Phiếu xuất/Chi tiết phiếu xuất'],
            ['name' => 'delete-release', 'display_name' => 'Xóa phiếu xuất/Chi tiết phiếu xuất', 'group' => 'Phiếu xuất/Chi tiết phiếu xuất'],
            ['name' => 'show-release', 'display_name' => 'Xem danh sách phiếu xuất/Chi tiết phiếu xuất', 'group' => 'Phiếu xuất/Chi tiết phiếu xuất'],

            ['name' => 'create-customer', 'display_name' => 'Thêm khách hàng', 'group' => 'Khách hàng'],
            ['name' => 'edit-customer', 'display_name' => 'Sửa khách hàng', 'group' => 'Khách hàng'],
            ['name' => 'delete-customer', 'display_name' => 'Xóa khách hàng', 'group' => 'Khách hàng'],
            ['name' => 'show-customer', 'display_name' => 'Xem danh sách khách hàng', 'group' => 'Khách hàng'],

            ['name' => 'create-staff', 'display_name' => 'Thêm nhân viên', 'group' => 'Nhân viên'],
            ['name' => 'edit-staff', 'display_name' => 'Sửa nhân viên', 'group' => 'Nhân viên'],
            ['name' => 'delete-staff', 'display_name' => 'Xóa nhân viên', 'group' => 'Nhân viên'],
            ['name' => 'show-staff', 'display_name' => 'Xem danh sách nhân viên', 'group' => 'Nhân viên'],

            ['name' => 'create-brand', 'display_name' => 'Thêm nhãn hàng', 'group' => 'Nhãn hàng'],
            ['name' => 'edit-brand', 'display_name' => 'Sửa nhãn hàng', 'group' => 'Nhãn hàng'],
            ['name' => 'delete-brand', 'display_name' => 'Xóa nhãn hàng', 'group' => 'Nhãn hàng'],
            ['name' => 'show-brand', 'display_name' => 'Xem danh sách nhãn hàng', 'group' => 'Nhãn hàng'],

            ['name' => 'create-supplier', 'display_name' => 'Thêm nhà cung cấp', 'group' => 'Nhà cung cấp'],
            ['name' => 'edit-supplier', 'display_name' => 'Sửa nhà cung cấp', 'group' => 'Nhà cung cấp'],
            ['name' => 'delete-supplier', 'display_name' => 'Xóa nhà cung cấp', 'group' => 'Nhà cung cấp'],
            ['name' => 'show-supplier', 'display_name' => 'Xem danh sách nhà cung cấp', 'group' => 'Nhà cung cấp'],

            ['name' => 'create-category', 'display_name' => 'Thêm danh mục', 'group' => 'Danh mục'],
            ['name' => 'edit-category', 'display_name' => 'Sửa danh mục', 'group' => 'Danh mục'],
            ['name' => 'delete-category', 'display_name' => 'Xóa danh mục', 'group' => 'Danh mục'],
            ['name' => 'show-category', 'display_name' => 'Xem danh sách danh mục', 'group' => 'Danh mục'],

            ['name' => 'create-product', 'display_name' => 'Thêm sản phẩm', 'group' => 'Sản phẩm'],
            ['name' => 'edit-product', 'display_name' => 'Sửa sản phẩm', 'group' => 'Sản phẩm'],
            ['name' => 'delete-product', 'display_name' => 'Xóa sản phẩm', 'group' => 'Sản phẩm'],
            ['name' => 'show-product', 'display_name' => 'Xem danh sách sản phẩm', 'group' => 'Sản phẩm'],

            ['name' => 'create-role', 'display_name' => 'Thêm vai trò', 'group' => 'Vai trò'],
            ['name' => 'edit-role', 'display_name' => 'Sửa vai trò', 'group' => 'Vai trò'],
            ['name' => 'delete-role', 'display_name' => 'Xóa vai trò', 'group' => 'Vai trò'],
            ['name' => 'show-role', 'display_name' => 'Xem danh sách vai trò', 'group' => 'Vai trò'],

            ['name' => 'create-user', 'display_name' => 'Thêm tài khoản', 'group' => 'Tài khoản'],
            ['name' => 'edit-user', 'display_name' => 'Sửa tài khoản', 'group' => 'Tài khoản'],
            ['name' => 'delete-user', 'display_name' => 'Xóa tài khoản', 'group' => 'Tài khoản'],
            ['name' => 'show-user', 'display_name' => 'Xem danh sách tài khoản', 'group' => 'Tài khoản'],

            ['name' => 'statistic', 'display_name' => 'Thống kê', 'group' => 'Thống kê'],
        ];
        foreach ($permissions as $item) {
            Permission::updateOrCreate($item);
        }


        $roles = [
            ['name' => 'super-admin', 'display_name' => 'Quản trị viên', 'group' => 'system'],
            ['name' => 'manager', 'display_name' => 'Quản lý', 'group' => 'system'],
            ['name' => 'staff', 'display_name' => 'Nhân viên', 'group' => 'system'],
            ['name' => 'user', 'display_name' => 'Người dùng', 'group' => 'user'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate($role);
        }

        // Lấy vai trò super_admin
        $superAdminRole = Role::where('name', 'super-admin')->first();

        // Lấy tất cả permissions
        $allPermissions = Permission::all();

        // Gán tất cả các quyền cho vai trò super_admin
        $superAdminRole->permissions()->sync($allPermissions->pluck('id')->toArray());
    }
}

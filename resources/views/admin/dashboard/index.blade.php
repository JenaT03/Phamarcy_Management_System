@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid featurs mt-4">
        <div class="container py-2">
            <div class="row d-flex justify-content-around mb-4">
                <a href="{{ route('releases.search') }}" class="btn btn-primary col-5 py-3">
                    <!-- <i class="fa-solid fa-scroll text-white" style="font-size: 2rem;"></i> -->
                    <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Bán hàng</p>
                </a>

                <a href="{{ route('receipts.create') }}" class="btn btn-primary col-5 py-3">
                    <!-- <i class="fa-solid fa-scroll text-white" style="font-size: 2rem;"></i> -->
                    <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Nhập hàng</p>
                </a>
            </div>

            <div class="row d-flex justify-content-around mb-4">
                <a href="{{ route('customers.index') }}" class="btn btn-primary col-5 py-3">
                    <!-- <i class="fa-solid fa-scroll text-white" style="font-size: 2rem;"></i> -->
                    <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Khách hàng</p>
                </a>

                <a href="{{ route('staffs.index') }}" class="btn btn-primary col-5 py-3">
                    <!-- <i class="fa-solid fa-scroll text-white" style="font-size: 2rem;"></i> -->
                    <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Nhân viên</p>
                </a>
            </div>

            <div class="row d-flex justify-content-around mb-4">
                <a href="{{ route('products.index') }}" class="btn btn-primary col-5 py-3">
                    <!-- <i class="fa-solid fa-scroll text-white" style="font-size: 2rem;"></i> -->
                    <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Sản phẩm</p>
                </a>

                <a href="{{ route('categories.index') }}" class="btn btn-primary col-5 py-3">
                    <!-- <i class="fa-solid fa-scroll text-white" style="font-size: 2rem;"></i> -->
                    <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Loại sản phẩm</p>
                </a>
            </div>

            <div class="row d-flex justify-content-around mb-4">
                <a href="{{ route('brands.index') }}" class="btn btn-primary col-5 py-3">
                    <!-- <i class="fa-solid fa-scroll text-white" style="font-size: 2rem;"></i> -->
                    <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Nhãn hàng</p>
                </a>

                <a href="{{ route('suppliers.index') }}" class="btn btn-primary col-5 py-3">
                    <!-- <i class="fa-solid fa-scroll text-white" style="font-size: 2rem;"></i> -->
                    <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Nhà cung cấp</p>
                </a>
            </div>

            <div class="row d-flex justify-content-around mb-4">
                <a href="{{ route('statistics.showreleaselist') }}" class="btn btn-primary col-5 py-3">
                    <!-- <i class="fa-solid fa-scroll text-white" style="font-size: 2rem;"></i> -->
                    <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Thống kê</p>
                </a>

                <a href="{{ route('roles.index') }}" class="btn btn-primary col-5 py-3">
                    <!-- <i class="fa-solid fa-scroll text-white" style="font-size: 2rem;"></i> -->
                    <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Quản lý vai trò</p>
                </a>
            </div>
        </div>
    </div>
@endsection

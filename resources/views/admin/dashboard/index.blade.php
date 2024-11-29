@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid featurs mt-4">
        <div class="container py-2">
            <div class="row g-4">
                @can('create-release')
                    <div class="col-md-6 col-xl-4  mb-4 text-center ">
                        <a href="{{ route('releases.search') }}"
                            class="  btn btn-primary py-3 pandx-10 background-grad-right border-0">
                            <i class="fa-solid fa-hand-holding-medical text-white" style="font-size: 2rem;"></i>
                            <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Bán hàng</p>
                        </a>
                    </div>
                @endcan

                @can('create-receipt')
                    <div class="col-md-6 col-xl-4 mb-4 text-center ">
                        <a href="{{ route('receipts.create') }}"
                            class=" btn btn-primary py-3 pandx-10 background-grad-right border-0">
                            <i class="fa-solid fa-boxes-packing text-white" style="font-size: 2rem;"></i>
                            <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Nhập hàng</p>
                        </a>
                    </div>
                @endcan
                @can('show-customer')
                    <div class="col-md-6 col-xl-4 mb-4 text-center ">
                        <a href="{{ route('customers.index') }}"
                            class="btn btn-primary pandx-10 py-3 background-grad-right border-0">
                            <i class="fa-solid fa-users text-white" style="font-size: 2rem;"></i>
                            <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Khách hàng</p>
                        </a>
                    </div>
                @endcan

                @can('show-staff')
                    <div class="col-md-6 col-xl-4 mb-4 text-center ">
                        <a href="{{ route('staffs.index') }}"
                            class="btn btn-primary pandx-10 py-3 background-grad-right border-0">
                            <i class="fa-solid fa-id-card-clip  text-white" style="font-size: 2rem;"></i>
                            <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Nhân viên</p>
                        </a>
                    </div>
                @endcan

                @can('show-product')
                    <div class="col-md-6 col-xl-4 mb-4 text-center ">
                        <a href="{{ route('products.index') }}"
                            class="btn btn-primary pandx-10 py-3 background-grad-right border-0">
                            <i class="fa-solid fa-pills  text-white" style="font-size: 2rem;"></i>
                            <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Sản phẩm</p>
                        </a>
                    </div>
                @endcan

                @can('show-category')
                    <div class="col-md-6 col-xl-4 mb-4 text-center ">
                        <a href="{{ route('categories.index') }}"
                            class="btn btn-primary pandx-10 py-3 background-grad-right border-0">
                            <i class="fa-solid fa-list-check text-white" style="font-size: 2rem;"></i>
                            <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Loại sản phẩm</p>
                        </a>
                    </div>
                @endcan

                @can('show-brand')
                    <div class="col-md-6 col-xl-4 mb-4 text-center ">
                        <a href="{{ route('brands.index') }}"
                            class="btn btn-primary pandx-10 py-3 background-grad-right border-0">
                            <i class="fa-solid fa-tags text-white" style="font-size: 2rem;"></i>
                            <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Nhãn hàng</p>
                        </a>
                    </div>
                @endcan

                @can('show-supplier')
                    <div class="col-md-6 col-xl-4 mb-4 text-center ">
                        <a href="{{ route('suppliers.index') }}"
                            class="btn btn-primary pandx-10 py-3 background-grad-right border-0">
                            <i class="fa-solid fa-truck text-white" style="font-size: 2rem;"></i>
                            <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Nhà cung cấp</p>
                        </a>
                    </div>
                @endcan

                @can('access-statistics')
                    <div class="col-md-6 col-xl-4 mb-4 text-center ">
                        <a href="{{ route('statistics.showreleaselist') }}"
                            class="btn btn-primary pandx-10 py-3 background-grad-right border-0">
                            <i class="fa-solid fa-calculator text-white" style="font-size: 2rem;"></i>
                            <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Thống kê</p>
                        </a>
                    </div>
                @endcan

                @can('access-website-management')
                    <div class="col-md-6 col-xl-4 mb-4 text-center ">
                        <a href="{{ route('website.banners.index') }}"
                            class="btn btn-primary pandx-10 py-3 background-grad-right border-0">
                            <i class="fa-solid fa-globe text-white" style="font-size: 2rem;"></i>
                            <p class="text-white ms-3 mb-0 text-center" style="font-size: 1.25rem;">Quản lý website</p>
                        </a>
                    </div>
                @endcan

                @hasrole('super-admin')
                    <div class="col-md-6 col-xl-4 mb-4 text-center ">
                        <a href="{{ route('roles.index') }}"
                            class="btn btn-primary pandx-10 py-3 background-grad-right border-0">
                            <i class="fa-solid fa-sitemap text-white" style="font-size: 2rem;"></i>
                            <p class="text-white ms-4 mb-0 text-center" style="font-size: 1.25rem;">Quản lý vai trò</p>
                        </a>
                    </div>
                @endhasrole()
            </div>
            <div class="row d-flex justify-content-around mb-4">


            </div>
        </div>
    </div>
    <div style="min-height: 30vh"></div>
@endsection

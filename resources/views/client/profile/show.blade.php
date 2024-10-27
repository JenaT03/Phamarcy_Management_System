@extends('client.layouts.app')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header" style="padding: 7rem 0 3rem 0;">
        <h1 class="text-center text-white display-6">Thông tin cá nhân</h1>
    </div>
    <!-- Single Page Header End -->


    <div class="container-fluid bg-light-blue py-4">
        <div class="rounded bg-white">
            @if (session('message'))
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center ">
                        <h5 class="animate__animated animate__fadeInLeft text-primary mt-4">{{ session('message') }}</h5>
                    </div>
                </div>
            @endif
            <div class="text-center"><img src="{{ asset('img/avatar.png') }}" style="width: 25%;"></div>
            <div class="container py-3 mt-3" style="width: 50%;">
                <a href="{{ route('customers.show', $customer->id) }}" class="btn d-flex btn-primary justify-content-center">
                    <i class="fa-solid fa-scroll text-white" style="padding-top: 3px;"></i>
                    <p class="text-white ms-3 mb-0">Đơn mua của tôi</p>
                </a>
            </div>

            <table class="table">
                <tbody>
                    <tr>
                        <td class="text-center">Họ và tên</td>
                        <td class="text-center user-info">{{ $customer->name }}</td>
                    </tr>

                    <tr>
                        <td class="text-center">Số điện thoại</td>
                        <td class="text-center user-info">{{ $customer->phone }}</td>
                    </tr>

                    <tr>
                        <td class="text-center">Năm sinh</td>
                        <td class="text-center user-info">{{ $customer->birth }}</td>
                    </tr>

                    <tr>
                        <td class="text-center">Giới tính</td>
                        <td class="text-center user-info">{{ $customer->gender }}</td>
                    </tr>
                </tbody>

            </table>

            <div class="container py-2 mt-3" style="width: 70%;">
                <a href="{{ route('profile.edit', $customer->id) }}" class="btn d-flex btn-primary justify-content-center">
                    <i class="fa-solid fa-pen text-white" style="padding-top: 3px;"></i>
                    <p class="text-white ms-3 mb-0">Chỉnh sửa thông tin cá nhân</p>
                </a>
            </div>

            <div class="container py-4 mt-2 d-flex justify-content-center" style="width: 70%;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" name="submit" class="btn d-flex btn-danger ">
                        <p class="text-white  mb-0" style="padding: 6px 35px">Đăng xuất</p>
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection

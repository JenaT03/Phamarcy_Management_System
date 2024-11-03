@extends('errors.app')
@section('content')
    <div class="container-fluid py-5">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-secondary"></i>
                    <h1 class="display-1">Lỗi</h1>
                    <h1 class="mb-4">Đã xảy ra lỗi</h1>
                    <p class="mb-4">Xin lỗi, có lỗi gì đó đang xảy ra, chúng tôi không thể hiển thị trang web này</p>
                    <a class="btn border-secondary rounded-pill py-3 px-5" href="{{ route('home') }}">Trở về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
@endsection

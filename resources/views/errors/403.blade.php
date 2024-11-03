@extends('errors.app')
@section('content')
    <div class="container-fluid py-5">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-secondary"></i>
                    <h1 class="display-1">403</h1>
                    <h1 class="mb-4">Không thể truy cập</h1>
                    <p class="mb-4">Bạn không có quyền truy cập trang web này.</p>
                    <a class="btn border-secondary rounded-pill py-3 px-5" href="{{ route('home') }}">Trở về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
@endsection

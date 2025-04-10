@extends('admin.layouts.app-page')
@section('title', 'quản lý vai trò')
@section('content')

    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-primary py-2 px-3 mt-5 text-white fs-5">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>

        <div class="bg-white rounded mt-5">
            <h3 class="text-center py-4">Chi tiết vai trò</h3>


            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <h6 class="">Tên:</h6>
                <p class="">{{ $role->name }}</p>
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <h6 class="mb-3">Tên hiển thị:</h6>
                <p class="">{{ $role->display_name }}</p>
            </div>


            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <h6 class="mb-3">Quyền hạn:</h6>
                @foreach ($role->permissions as $item)
                    <p>{{ $item->display_name }}</p>
                @endforeach

            </div>
        </div>


        <div class="col-md-6 offset-md-3 pb-3 my-3 d-flex justify-content-end">


            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary text-white text-center"
                style="padding: 15px 30px; font-size: 1.25rem;">Chỉnh sửa</a>


        </div>
    </div>
@endsection

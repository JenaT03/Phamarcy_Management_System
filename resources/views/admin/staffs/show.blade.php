@extends('admin.layouts.app-page')
@section('title', 'nhân viên')
@section('content')

    <div class="container">
        <h3 class="text-center my-5">Chi tiết nhân viên</h3>


        <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
            <h6 class="">Tên:</h6>
            <p class="">{{ $staffDetail->name }}</p>
        </div>

        <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
            <h6 class="mb-3">Mã số:</h6>
            <p class="">{{ $staffDetail->code }}</p>
        </div>

        <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
            <h6 class="mb-3">Số điện thoại:</h6>
            <p class="">{{ $staffDetail->phone }}</p>
        </div>

        <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
            <h6 class="mb-3">Năm sinh:</h6>
            <p class="">{{ $staffDetail->birth }}</p>
        </div>

        <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
            <h6 class="mb-3">Giới tính:</h6>
            <p class="">{{ $staffDetail->gender }}</p>
        </div>

        <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
            <h6 class="mb-3">Đại chỉ:</h6>
            <p class="">{{ $staffDetail->address }}</p>
        </div>

        <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
            <h6 class="mb-3">Chức vụ:</h6>
            @foreach ($roles as $role)
                <p>{{ $role->display_name }}</p>
            @endforeach

        </div>



        <div class="col-md-6 offset-md-3 pb-3 my-3 d-flex justify-content-between">
            <a href="{{ route('staffs.index') }}" class="btn btn-primary text-white text-center"
                style="padding: 15px 30px; font-size: 1.25rem;">Quay lại</a>

            <a href="{{ route('staffs.edit', $role->id) }}" class="btn btn-primary text-white text-center"
                style="padding: 15px 30px; font-size: 1.25rem;">Chỉnh sửa</a>


        </div>
    </div>
@endsection

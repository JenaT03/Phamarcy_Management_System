@extends('admin.layouts.app-page')
@section('title', 'khách hàng')
@section('content')
    <div class=" container">
        <a href="{{ url()->previous() }}" class="btn btn-primary py-2 px-3 mt-5 text-white fs-5">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
        <h3 class="text-center my-5"> Tạo khách hàng mới</h3>
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Số điện thoại khách hàng</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Tên khách hàng</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Năm sinh</label>
                <input type="text" class="form-control" name="birth" value="{{ old('birth') }}">
                @error('birth')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <p class="">Giới tính</p>
                <div class="d-flex">
                    <input type="radio" class="me-2 form-check-input" value="Nam" name="gender"
                        {{ old('gender') == 'Nam' ? 'checked' : '' }}>
                    <label class="form-label me-4">Nam</label>
                    <input type="radio" class="me-2 form-check-input" value="Nữ" name="gender"
                        {{ old('gender') == 'Nam' ? 'checked' : '' }}>
                    <label class="form-label me-4">Nữ</label>

                </div>
                @error('gender')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="my-3 mt-5 d-flex justify-content-end">
                <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                    style="padding: 15px 45px; font-size: 1.25rem;">Tiếp</button>

            </div>

        </form>
    </div>
@endsection

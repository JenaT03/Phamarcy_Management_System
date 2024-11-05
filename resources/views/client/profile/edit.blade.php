@extends('client.layouts.app')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header" style="padding: 7rem 0 3rem 0;">
        <h1 class="text-center text-white display-6">Thông tin cá nhân</h1>
    </div>
    <!-- Single Page Header End -->
    <div class=" container">
        @if ($errors->has('error'))
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center ">
                    <h5 class="animate__animated animate__fadeInLeft text-primary mt-4">{{ $errors->first('error') }}</h5>
                </div>
            </div>
        @endif
        <a href="{{ url()->previous() }}" class="btn btn-primary py-2 px-3 mt-5 text-white fs-5">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
        <h3 class="text-center my-5"> Chỉnh sửa thông tin cá nhân</h3>
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone') ?? $customer->phone }}">

                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Họ và tên</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') ?? $customer->name }}">

                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Năm sinh</label>
                <input type="text" class="form-control" name="birth" value="{{ old('birth') ?? $customer->birth }}">
                @error('birth')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <p class="">Giới tính</p>
                <div class="d-flex">

                    <input type="radio" class="me-2 form-check-input" value="Nam" name="gender"
                        {{ $customer->gender == 'Nam' ? 'checked' : '' }}>
                    <label class="form-label me-4">Nam</label>
                    <input type="radio" class="me-2 form-check-input" value="Nữ" name="gender"
                        {{ $customer->gender == 'Nữ' ? 'checked' : '' }}>
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

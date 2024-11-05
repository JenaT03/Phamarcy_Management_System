@extends('admin.layouts.app-page')
@section('title', 'nhân viên')
@section('content')
    <div class=" container">
        <a href="{{ url()->previous() }}" class="btn btn-primary py-2 px-3 mt-5 text-white fs-5">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
        <h3 class="text-center my-5"> Chỉnh sửa thông tin nhân viên</h3>
        <form action="{{ route('staffs.update', $staffEdited->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Mã số</label>
                <input type="text" class="form-control" name="code" value="{{ $staffEdited->code }}" readonly>


            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Số điện thoại nhân viên</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone') ?? $staffEdited->phone }}">

                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Tên nhân viên</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') ?? $staffEdited->name }}">

                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Năm sinh</label>
                <input type="text" class="form-control" name="birth" value="{{ old('birth') ?? $staffEdited->birth }}">
                @error('birth')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <p class="">Giới tính</p>
                <div class="d-flex">

                    <input type="radio" class="me-2 form-check-input" value="Nam" name="gender"
                        {{ $staffEdited->gender == 'Nam' ? 'checked' : '' }}>
                    <label class="form-label me-4">Nam</label>
                    <input type="radio" class="me-2 form-check-input" value="Nữ" name="gender"
                        {{ $staffEdited->gender == 'Nữ' ? 'checked' : '' }}>
                    <label class="form-label me-4">Nữ</label>

                </div>
                @error('gender')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Địa chỉ</label>
                <textarea name="address" class="form-control" cols="30" rows="6" spellcheck="false">{{ old('address') ?? $staffEdited->address }}</textarea>

                @error('address')
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

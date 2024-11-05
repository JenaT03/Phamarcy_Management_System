@extends('admin.layouts.app-page')
@section('title', 'Nhà cung cấp')
@section('content')

    <div class=" container">
        <a href="{{ url()->previous() }}" class="btn btn-primary py-2 px-3 mt-5 text-white fs-5">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
        <h3 class="text-center my-5"> Thêm nhà cung cấp mới</h3>
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Tên nhà cung cấp</label>
                <input type="text" class="form-control" name = "name" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" name= "phone" value="{{ old('phone') }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Địa chỉ</label>
                <textarea name="address" class="form-control" cols="30" rows="6" spellcheck="false">{{ old('address') }}</textarea>

                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="my-3 mt-5 d-flex justify-content-end">
                <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                    style="padding: 15px 45px; font-size: 1.25rem;">Thêm</button>

            </div>

        </form>
    </div>

@endsection

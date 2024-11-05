@extends('admin.layouts.app-page')
@section('title', 'Loại sản phẩm')
@section('content')

    <div class=" container">
        <a href="{{ url()->previous() }}" class="btn btn-primary py-2 px-3 mt-5 text-white fs-5">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
        <h3 class="text-center my-5"> Chỉnh sửa loại sản phẩm mới</h3>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Tên loại sản phẩm</label>
                <input type="text" class="form-control" name = "name" value="{{ old('name') ?? $category->name }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="my-3 mt-5 d-flex justify-content-end">
                <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                    style="padding: 15px 45px; font-size: 1.25rem;">Cập nhật</button>

            </div>

        </form>
    </div>

@endsection

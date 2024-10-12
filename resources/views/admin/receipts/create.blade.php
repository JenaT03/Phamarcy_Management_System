@extends('admin.layouts.app-page')
@section('title', 'Nhập hàng')
@section('content')
    <div class="container-fluid pt-5">
        <div class="container d-flex justify-content-end">
            <a href="{{ route('receipts.index') }}" class="py-4 px-3 fs-5  text-decoration-underline">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Lịch sử nhập hàng
            </a>

        </div>
    </div>
    <div class=" container">
        <form action="{{ route('receipts.store') }}" method="POST">
            @csrf
            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Mã nhân viên</label>
                <input type="text" name="staff_id" class="form-control" value="{{ $staff->id }}" readonly>
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Tên nhân viên</label>
                <input type="text" name="staff_name" class="form-control" value="{{ $staff->name }}" readonly>
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Nhà cung cấp </label>
                <select name="supplier_id" class="form-control bg-white">
                    <option value="">Chọn</option>
                    @foreach ($suppliers as $item)
                        <option value="{{ $item->id }}" {{ old('supplier_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Ngày nhập</label>
                <input type="text" class="form-control" name="datetime" value="{{ $currentDateTime }}" readonly>
            </div>


            <div class="my-3 d-flex justify-content-end">
                <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                    style="padding: 15px 45px; font-size: 1.25rem;">Tiếp tục</button>
            </div>

        </form>
    </div>
@endsection

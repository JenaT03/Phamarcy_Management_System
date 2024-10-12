@extends('admin.layouts.app-page')
@section('title', 'Bán hàng')
@section('content')
    <div class=" container">
        <form action="{{ route('releases.search') }}" method="POST">
            @csrf
            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Số điện thoại khách hàng</label>
                <input type="text" class="form-control" name = "phone" value="{{ old('phone') }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-3 d-flex justify-content-end">
                <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                    style="padding: 15px 45px; font-size: 1.25rem;">Tiếp tục</button>
            </div>
        </form>
    </div>
@endsection

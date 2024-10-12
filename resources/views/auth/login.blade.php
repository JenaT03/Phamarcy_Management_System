@extends('client.layouts.app')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header" style="padding: 7rem 0 3rem 0;">
        <h1 class="text-center text-white display-6">Đăng nhập</h1>
    </div>
    <!-- Single Page Header End -->
    @if (session('message'))
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center ">
                <h5 class="animate__animated animate__fadeInLeft text-primary mt-4">{{ session('message') }}</h5>
            </div>
        </div>
    @endif

    <div class=" container">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control">
                @if ($errors->has('fail'))
                    <span class="text-danger">{{ $errors->first('fail') }}</span>
                @endif
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="my-3">
                <button type="submit" name="submit" class="btn btn-primary text-white text-center col-4 offset-4">Đăng
                    nhập</button>
            </div>

            <div class="">
                <p class="text-center">Nếu chưa có tài khoản? Hãy <a href="{{ route('register.index') }}">Đăng ký</a></p>
            </div>

        </form>
    </div>
@endsection

@extends('client.layouts.app')
@section('content')

<!-- Single Page Header start -->
    <div class="container-fluid page-header" style="padding: 7rem 0 3rem 0;">
        <h1 class="text-center text-white display-6">Đăng ký</h1>
    </div>
    <!-- Single Page Header End -->
<div class=" container">
    <form action="{{route('customers.store')}}" method="POST">
            @csrf

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Họ và tên</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" >

                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Năm sinh</label>
                <input type="text" class="form-control" name="birth" value="{{old('birth')}}">
                @error('birth')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <p class="">Giới tính</p>
                <div class="d-flex">
                    <input type="radio" class="me-2 form-check-input" value="Nam" name="gender" {{ old('gender') == 'Nam' ? 'checked' : '' }}>
                    <label class="form-label me-4">Nam</label>
                    <input type="radio" class="me-2 form-check-input" value="Nữ" name="gender" {{ old('gender') == 'Nam' ? 'checked' : '' }}>
                    <label class="form-label me-4">Nữ</label>
                    
                </div>
                @error('gender')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>


            <div class="my-3 mt-5">
            <button type="submit" name="submit"
                class="btn btn-primary text-white text-center col-4 offset-4">Tiếp tục</button>
            </div>

            <div class="">
                <p class="text-center">Nếu bạn đã tài khoản? <a href="{{route('login.index')}}">Đăng nhập</a></p>
            </div>

        </form>
    
</div>
@endsection

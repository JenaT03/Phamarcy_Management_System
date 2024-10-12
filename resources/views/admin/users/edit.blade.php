@extends('admin.layouts.app-handle-user')
@section('title', 'Tài khoản')
@section('content')
<div class=" container">
        <h3 class="text-center my-5">Chỉnh sửa tài khoản</h3>

        <div class="row">
            <div class="col-md-6 offset-md-3 text-center ">
                <h6 class="animate__animated animate__fadeInLeft text-warning ">Mật khẩu mặc định là số điện thoại, hãy thay đổi nếu cần thiết.</h6>
            </div>
        </div>
        <form action="{{route('users.update', $user->id)}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_type" value="{{ request('user_type') }}">
            @if (request('role'))
                 <input type="hidden" name="role" value="{{ request('role') }}">
            @endif
            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" value="{{request('phone') ?? $user->phone}}" readonly>
                
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3" >
                <label class="form-label">Mật khẩu</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" value="{{ request('user_type') == 'customer' || request('user_type') == 'staff' ? request('phone') : '' }}"   placeholder="Nhập mật khẩu mới" >
                    <span class="input-group-text">
                        <i class="fa-regular fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                    </span>
                </div>                
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3" >
                <label class="form-label">Nhập lại mật khẩu</label>
                <div class="input-group">
                    <input type="password" id="confirmPassword" name="password_confirmation" class="form-control" value="{{ request('user_type') == 'customer' || request('user_type') == 'staff' ? request('phone') : '' }}"  placeholder="Nhập lại mật khẩu mới"  >
                    <span class="input-group-text">
                        <i class="fa-regular fa-eye" id="toggleConfirmPassword" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="text-danger">{{$message}}</span>
            @enderror

            

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Vai trò</label>
                <div class="row">
                     
                        <div class="col-md-6">
                            <h6 class="mb-0 text-dark py-4">{{$groupName}}</h6>
                            @foreach ($roles as $item)
                                <div class="form-check text-start">
                                    <input type="checkbox" id="{{$item->id}}" class="form-check-input border-1" name="role_ids[]"
                                        value="{{$item->id}}" {{$user->roles->contains('id', $item->id) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="{{$item->id}}" >{{$item->display_name}}</label>
                                </div>
                            @endforeach 
                        </div>
                </div>
                 @error('role_ids')
                    <span class="text-danger">{{$message}}</span>
                @enderror

            </div>
            

            

            <div class="my-3 d-flex justify-content-end">
                <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                    style="padding: 15px 45px; font-size: 1.25rem;">Cập nhật</button>
            </div>

        </form>
</div>
@endsection
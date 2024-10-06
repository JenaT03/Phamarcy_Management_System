@extends('admin.layouts.app-page')
@section('title', 'Nhãn hàng')
@section('content')

<div class=" container">
        <h3 class="text-center my-5"> Chỉnh sửa thông tin nhãn hàng</h3>
        <form action="{{route('brands.update', $brand->id)}}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Tên nhãn hàng</label>
                <input type="text" class="form-control"  name = "name" value="{{old('name') ?? $brand->name}}">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Quốc gia</label>
                <input type="text" class="form-control" name= "country" value="{{old('country') ?? $brand->country}}">
                @error('country')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="my-3 mt-5 d-flex justify-content-between">
                
                <a href="{{route('brands.index')}}" class="btn btn-primary text-white text-center"
                style="padding: 15px 30px; font-size: 1.25rem;">Quay lại</a>

                <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                style="padding: 15px 45px; font-size: 1.25rem;">Cập nhật</button>

            </div>
           
        </form>
    
    </div>

@endsection
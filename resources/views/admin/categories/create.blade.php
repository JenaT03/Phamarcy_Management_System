@extends('admin.layouts.app-page')
@section('title', 'Loại sản phẩm')
@section('content')

<div class=" container">
        <h3 class="text-center my-5"> Thêm loại sản phẩm mới</h3>
        <form action="{{route('categories.store')}}" method="POST">
            @csrf
            
            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Tên loại sản phẩm</label>
                <input type="text" class="form-control"  name = "name" value="{{old('name')}}">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>


            <div class="my-3 mt-5 d-flex justify-content-between">
                
                <a href="{{route('categories.index')}}" class="btn btn-primary text-white text-center"
                style="padding: 15px 30px; font-size: 1.25rem;">Quay lại</a>

                <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                style="padding: 15px 45px; font-size: 1.25rem;">Thêm</button>

            </div>

        </form>
    </div>

@endsection
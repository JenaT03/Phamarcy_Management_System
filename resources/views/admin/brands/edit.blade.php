@extends('admin.layouts.app-page')
@section('title', 'Nhãn hàng')
@section('content')

    <div class=" container">
        <a href="{{ url()->previous() }}" class="btn btn-primary py-2 px-3 mt-5 text-white fs-5">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
        <h3 class="text-center my-5"> Chỉnh sửa thông tin nhãn hàng</h3>
        <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Logo</label>
                <input type="file" accept="image/*" id="image-input" class="form-control bg-white" name = "img">
                <div class="mt-2">
                    <img src="{{ $brand->img ? asset('uploads/' . $brand->img) : '' }}" id="show-image" width="300px">
                </div>
                @error('img')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Tên nhãn hàng</label>
                <input type="text" class="form-control" name = "name" value="{{ old('name') ?? $brand->name }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label">Quốc gia</label>
                <input type="text" class="form-control" name= "country" value="{{ old('country') ?? $brand->country }}">
                @error('country')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <label class="form-label" for="hightlight">Nổi bật</label>
                <input type="checkbox" class="form-check-input border-1" id="hightlight" name= "hightlight" value="true">

            </div>

            <div class="my-3 mt-5 d-flex justify-content-end">
                <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                    style="padding: 15px 45px; font-size: 1.25rem;">Cập nhật</button>

            </div>

        </form>

    </div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(() => {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#show-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image-input").change(function() {
                readURL(this);
            });



        });
    </script>

@endsection

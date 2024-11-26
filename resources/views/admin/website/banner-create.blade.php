@extends('admin.layouts.app-page')
@section('title', 'Quản lý website')
@section('content')
    <div class="row g-0 py-2 bg-white border-bot-lr">
        @can('banner_website')
            <a href="{{ route('website.banners.index') }}" class="col-4 text-center py-2 border-cus ">BANNER</a>
        @endcan
        @can('news_website')
            <a href="{{ route('website.news.index') }}" class="col-4 text-center py-2">TIN TỨC</a>
        @endcan
        @can('introduce_website')
            <a href="{{ route('website.introduce.index') }}" class="col-4 text-center py-2">GIỚI THIỆU</a>
        @endcan

    </div>

    <div class="container-fluid fruite ">

        <div class="container py-4 bg-white mt-5 rounded">
            <h3 class="text-center my-5"> Thêm banner</h3>
            <form action="{{ route('website.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                    <label class="form-label">Hình ảnh </label>
                    <input type="file" accept="image/*" id="image-input" class="form-control bg-white" name = "img">
                    <div class="mt-2">
                        <img src="" id="show-image" width="300px">
                    </div>
                    @error('img')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="d-flex justify-content-center">
                    <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                        style="padding: 15px 45px; font-size: 1.25rem;">Thêm</button>
                </div>

            </form>
        </div>
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

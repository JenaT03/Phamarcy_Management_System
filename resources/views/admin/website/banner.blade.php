@extends('admin.layouts..app-page')
@section('title', 'Quản lý website')
@section('content')
    <div class="row g-0 pt-3 bg-white">
        @can('banner_website')
            <a href="{{ route('website.banners.index') }}" class="col-4 text-center py-2 border-cus fw-bold">BANNER</a>
        @endcan
        @can('news_website')
            <a href="{{ route('website.news.index') }}" class="col-4 text-center py-2">TIN TỨC</a>
        @endcan
        @can('introduce_website')
            <a href="{{ route('website.introduce.index') }}" class="col-4 text-center py-2">GIỚI THIỆU</a>
        @endcan

    </div>

    <div class="container-fluid fruite ">

        <div class="container py-5">
            <div class="row g-4 bg-white mt-2 rounded">
                @foreach ($banners as $banner)
                    <div class="col-sm-2 col-md-4 mb-4 col-lg-3 rounded position-relative  ">
                        <form action="{{ route('website.banners.destroy', $banner->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" data-bs-toggle="modal" data-bs-target="#delete-confirm"
                                class="btn btn-danger px-3 py-1 position-absolute text-white"
                                style="top: -15px; right: 0px; border-radius: 25px;">x</button>
                        </form>

                        <img src="{{ $banner->img ? asset('uploads/' . $banner->img) : '' }}" class="img-fluid rounded"
                            style="width: 500px; height: 200px" alt="" />
                    </div>
                @endforeach


                <div class="col-sm-2 col-md-4 mb-4 col-lg-3 d-flex align-items-center  justify-content-center">
                    <a href="{{ route('website.banners.create') }}" class="btn btn-primary text-white"><i
                            class="fa-solid fa-plus"></i><a>
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fw-bold" id="staticBackdropLabel">Xác nhận xóa</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete">Xóa</button>
                    <button type="button" class="btn" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>
@endsection

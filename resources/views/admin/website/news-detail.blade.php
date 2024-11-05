@extends('admin.layouts.app-page')
@section('title', 'Quản lý website')
@section('content')
    <div class="row g-0 pt-3 bg-white">
        @can('banner_website')
            <a href="{{ route('website.banners.index') }}" class="col-4 text-center py-2 ">BANNER</a>
        @endcan
        @can('news_website')
            <a href="{{ route('website.news.index') }}" class="col-4 text-center py-2 border-cus fw-bold">TIN TỨC</a>
        @endcan
        @can('introduce_website')
            <a href="{{ route('website.introduce.index') }}" class="col-4 text-center py-2 ">GIỚI THIỆU</a>
        @endcan

    </div>
    <div class="container-fluid fruite ">

        <div class="container py-5">
            <div class="bg-white mt-2 rounded pb-3">
                <a href="{{ url()->previous() }}" class="btn btn-primary py-2 px-3 ms-5 mt-3 text-white fs-5">
                    <i class="fa-solid fa-arrow-left"></i>
                    Quay lại
                </a>
                <div class="row g-4 px-5">
                    <h1 class="col-sm-12 col-md-8 d-flex align-items-center">{{ $news->title }}
                    </h1>
                    <div class="rounded col-sm-12 col-md-4">
                        <img src="{{ $news->img ? asset('uploads/' . $news->img) : '' }}" class="img-fluid rounded"
                            style="width: 400px; height: 300px" alt="" />
                    </div>
                </div>
                <div class="mt-5 px-5 quote-box col-6 offset-1">
                    <i class="fa-solid fa-quote-left quote-icon"></i>
                    {!! $news->abstract !!}
                </div>
                <hr>
                <div class="px-5">{!! $news->content !!}</div>

                <h6 class="px-5" style="right:0;">Tác giả: {{ $news->author }}</h6>
                <p class="px-5">Người đăng: {{ $poster }}</p>
            </div>
        </div>
    </div>
@endsection

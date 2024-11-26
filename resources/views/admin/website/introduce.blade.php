@extends('admin.layouts.app-page')
@section('title', 'Quản lý website')
@section('content')
    <div class="row g-0 py-2 bg-white border-bot-lr">
        @can('banner_website')
            <a href="{{ route('website.banners.index') }}" class="col-4 text-center py-2 ">BANNER</a>
        @endcan
        @can('news_website')
            <a href="{{ route('website.news.index') }}" class="col-4 text-center py-2">TIN TỨC</a>
        @endcan
        @can('introduce_website')
            <a href="{{ route('website.introduce.index') }}" class="col-4 text-center py-2 border-cus">GIỚI THIỆU</a>
        @endcan

    </div>
    <div class="container-fluid fruite ">
        <div class=" container my-5 bg-white p-5 rounded">
            {!! $introduce->content !!}

            <div class="d-flex justify-content-end"><a href="{{ route('website.introduce.edit') }}"
                    class="btn btn-primary text-white">Chỉnh sửa</a></div>

        </div>
    </div>


@endsection

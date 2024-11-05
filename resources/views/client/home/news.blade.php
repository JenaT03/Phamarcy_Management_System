@extends('client.layouts.app')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header" style="padding: 7rem 0 3rem 0;">
        <h1 class="text-center text-white display-6">Tin tức sức khỏe</h1>
    </div>
    <!-- Single Page Header End -->
    <div class="container py-5">
        <div class="row g-4 ">
            <h1 class="col-sm-12 col-md-8 d-flex align-items-center">{{ $news->title }}
            </h1>
            <div class="rounded col-sm-12 col-md-4">
                <img src="{{ $news->img ? asset('uploads/' . $news->img) : '' }}" class="img-fluid rounded"
                    style="width: 400px; height: 300px" alt="" />
            </div>
        </div>
        <div class="mt-5 quote-box col-6 offset-1">
            <i class="fa-solid fa-quote-left quote-icon"></i>
            {!! $news->abstract !!}
        </div>
        <hr>
        {!! $news->content !!}
        <h6 style="right:0;">Tác giả: {{ $news->author }}</h6>
        <p>Người đăng: {{ $poster }}</p>
    </div>
@endsection

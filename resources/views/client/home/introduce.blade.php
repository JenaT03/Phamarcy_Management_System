@extends('client.layouts.app')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header" style="padding: 7rem 0 3rem 0;">
        <h1 class="text-center text-white display-6">Giới thiệu</h1>
    </div>
    <!-- Single Page Header End -->
    <div class=" container my-5">
        {!! $introduce->content !!}
    </div>
@endsection

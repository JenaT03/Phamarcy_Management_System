@extends('admin.layouts.app-page')
@section('title', 'khách hàng')
@section('content')

<div class="container-fluid py-5">
        <div class="container py-5">
             <a href="#" class="p-3 border border-2 border-primary rounded">
                Tài khoản
            </a>
            <h2 class="text-center mb-5">Phan Thị Lan Anh</h2>
            
            <a href="#" class="d-flex justify-content-around my-4 mx-5 py-4 px-3 btn btn-primary">
                <p class="text-white m-0">7408654</p>
                <p class="text-white m-0">7951 - Trần Yến Nhi</p>
                <p class="text-white m-0">22-08-2024, 16:03:28</p>
                <p class="text-white m-0">267.000đ</p>
            </a>

            <a href="#" class="d-flex justify-content-around my-4 mx-5 py-4 px-3 btn btn-primary">
                <p class="text-white m-0">7408654</p>
                <p class="text-white m-0">7951 - Trần Yến Nhi</p>
                <p class="text-white m-0">22-08-2024, 16:03:28</p>
                <p class="text-white m-0">267.000đ</p>
            </a>
        </div>




        <div class="col-12">
                <div class="pagination d-flex justify-content-center mt-5">
                    {{-- Previous Page Link --}}
                    @if ($roles->onFirstPage())
                        <a href="#" class="rounded disabled">&laquo;</a>
                    @else
                        <a href="{{ $roles->previousPageUrl() }}" class="rounded">&laquo;</a>
                    @endif

                    {{-- Pagination Links --}}
                    @foreach ($roles->getUrlRange(1, $roles->lastPage()) as $page => $url)
                        @if ($page == $roles->currentPage())
                            <a href="{{ $url }}" class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($roles->hasMorePages())
                        <a href="{{ $roles->nextPageUrl() }}" class="rounded">&raquo;</a>
                    @else
                        <a href="#" class="rounded disabled">&raquo;</a>
                    @endif
                </div>
            </div>

    </div>


@endsection
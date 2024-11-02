@extends('client.layouts.app')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header" style="padding: 7rem 0 3rem 0;">
        <h1 class="text-center text-white display-6">Tin tức sức khỏe</h1>
    </div>
    <!-- Single Page Header End -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4">
                @foreach ($news as $item)
                    <div class="col-md-6 mb-4 ">
                        <a href="{{ route('news', $item->id) }}">
                            <div class=" img-border-radius bg-light rounded p-4">
                                <div class="position-relative">
                                    <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                                        style=" right: -15px;  top: -5px"></i>

                                    <div class="d-flex align-items-center flex-nowrap">
                                        <div class="bg-secondary rounded">
                                            <img src="{{ $item->img ? asset('uploads/' . $item->img) : '' }}"
                                                class="img-fluid rounded" style="width: 100px; height: 100px"
                                                alt="" />
                                        </div>
                                        <div class="ms-4 d-block">
                                            <h4 class="text-dark">{{ $item->title }}</h4>
                                            <p class="m-0 pb-3 text-dark">{{ $item->author }}</p>
                                        </div>
                                    </div>
                                    <div class="mb-4 pb-4 border-top border-secondary">
                                        <p class="mb-0 news-abstract text-dark">
                                            {{ strip_tags($item->abstract) }}
                                        </p>
                                    </div>
                                </div>


                            </div>
                        </a>




                    </div>
                @endforeach

                <div class="col-12">
                    <div class="pagination d-flex justify-content-center mt-5">
                        {{-- Previous Page Link --}}
                        @if ($news->onFirstPage())
                            <a href="#" class="rounded disabled">&laquo;</a>
                        @else
                            <a href="{{ $news->previousPageUrl() }}" class="rounded">&laquo;</a>
                        @endif

                        {{-- Pagination Links --}}
                        @foreach ($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                            @if ($page == $news->currentPage())
                                <a href="{{ $url }}" class="active rounded">{{ $page }}</a>
                            @else
                                <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($news->hasMorePages())
                            <a href="{{ $news->nextPageUrl() }}" class="rounded">&raquo;</a>
                        @else
                            <a href="#" class="rounded disabled">&raquo;</a>
                        @endif
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection

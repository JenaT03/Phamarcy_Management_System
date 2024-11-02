@extends('client.layouts.app')
@section('content')
    <!-- Shop Start-->
    <div class="container-fluid fruite container-padding" style="background-image: linear-gradient(#F0F5FF, white);">
        <div class="container py-4">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4 pt-3">
                        <div class="col-xl-3"></div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4"
                                style="box-shadow: 4px 4px 10px">
                                <label for="fruits">Sắp xếp theo:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="volvo">Mặc định</option>
                                    <option value="saab">Giá giảm dần</option>
                                    <option value="opel">Giá tăng dần</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4 justify-content-center bg-white mt-2 rounded px-4 py-2">
                                @foreach ($products as $product)
                                    <div class="col-6 col-md-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item border border-secondary rounded">

                                            <div class="">
                                                <div class="fruite-img">
                                                    <img src="{{ $product->img ? asset('uploads/' . $product->img) : '' }}"
                                                        class="img-fluid w-100 rounded-top" alt="" />
                                                </div>
                                                <div class="p-4">
                                                    <h6 class="product-name">{{ $product->name }}</h6>
                                                    <p class="description-text">
                                                        {{ $product->description }}
                                                    </p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><span
                                                                style="color: red">{{ $product->productdetails->first()->price ?? '0' }}đ</span>
                                                            {{ $product->unit ? '/' . $product->unit : '' }}</p>
                                                        <a href="{{ route('client.products.show', $product->id) }}"
                                                            class="btn border border-secondary rounded-pill px-3 text-primary"
                                                            style="height: fit-content">
                                                            <i class="fa-solid fa-eye icon-detail"></i>
                                                            <span class="text-detail">Xem chi tiết</span></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach




                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        {{-- Previous Page Link --}}
                                        @if ($products->onFirstPage())
                                            <a href="#" class="rounded disabled">&laquo;</a>
                                        @else
                                            <a href="{{ $products->previousPageUrl() }}" class="rounded">&laquo;</a>
                                        @endif

                                        {{-- Pagination Links --}}
                                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                            @if ($page == $products->currentPage())
                                                <a href="{{ $url }}" class="active rounded">{{ $page }}</a>
                                            @else
                                                <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($products->hasMorePages())
                                            <a href="{{ $products->nextPageUrl() }}" class="rounded">&raquo;</a>
                                        @else
                                            <a href="#" class="rounded disabled">&raquo;</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

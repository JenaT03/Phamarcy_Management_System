@extends('client.layouts.app')
@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container pb-5 container-padding">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ $product->img ? asset('uploads/' . $product->img) : '' }}"
                                        class="img-fluid rounded" alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                            @foreach ($product->categories as $category)
                                <p class="mb-3">{{ $category->nane }}</p>
                            @endforeach

                            <p class="text-dark fw-bold mb-0 mb-2 font-size-p">
                                <span style="color: red">{{ $product->productdetails->first()->price ?? '0' }}đ</span>
                                {{ $product->unit ? '/' . $product->unit : '' }}
                            </p>
                            <p class="mb-4">{!! $product->description !!}</p>

                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-ingre-tab" data-bs-toggle="tab" data-bs-target="#nav-ingre"
                                        aria-controls="nav-ingre" aria-selected="true">Thành phần</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-instruc-tab" data-bs-toggle="tab" data-bs-target="#nav-instruc"
                                        aria-controls="nav-instruc" aria-selected="false">Hướng dẫn sử dụng</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-produce-tab" data-bs-toggle="tab" data-bs-target="#nav-produce"
                                        aria-controls="nav-produce" aria-selected="false">Thông tin sản xuất</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-ingre" role="tabpanel" aria-labelledby="nav-ingre-tab">
                                    <p>{!! $product->ingredient !!}</p>
                                </div>
                                <div class="tab-pane" id="nav-instruc" role="tabpanel" aria-labelledby="nav-instruc-tab">
                                    <p>{!! $product->intruction !!}</p>
                                </div>

                                <div class="tab-pane" id="nav-produce" role="tabpanel" aria-labelledby="nav-produce-tab">
                                    <p>Thuộc thương hiệu:</p>
                                    <p>{{ $product->brand->name }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- Single Product End -->
@endsection

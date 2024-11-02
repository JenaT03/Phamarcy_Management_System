@extends('client.layouts.app')
@section('content')

    @if (empty($search))
        <!-- Hero Start -->
        <div class="container-fluid py-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-4">
                        <h4 class="mb-3 text-secondary">Nhận tư vấn từ dược sĩ ngay</h4>
                        <h2 class="display-5 text-primary">0359999999</h2>

                    </div>

                    <div class="col-md-12 col-lg-8">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">

                                @foreach ($banners as $index => $banner)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }} rounded">
                                        <img src="{{ $banner->img ? asset('uploads/' . $banner->img) : '' }}"
                                            class="img-fluid w-100 h-50 bg-secondary rounded" alt="First slide" />
                                    </div>
                                @endforeach

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero End -->

        <!-- Featurs Section Start -->
        <div class="container-fluid featurs">
            <div class="container py-5">
                <h3 class="text-primary text-center display-4">
                    CHUYÊN MÔN - CHẤT LƯỢNG - TẬN TÌNH
                </h3>
            </div>
        </div>
        <!-- Featurs Section End -->

        <!-- Featurs Section End -->

        <!-- Đơn mua -->

        @if (Auth::check())
            <div class="container-fluid featurs">
                <div class="container py-5">
                    <a href="{{ route('customers.show', Auth::user()->userable_id) }}"
                        class="btn d-flex btn-primary col-12 col-lg-6 offset-lg-3 py-4 justify-content-center">
                        <i class="fa-solid fa-scroll text-white" style="font-size: 2rem"></i>
                        <p class="text-white ms-4 mb-0" style="font-size: 1.5rem">
                            ĐƠN MUA CỦA TÔI
                        </p>
                    </a>
                </div>
            </div>
        @endif




        <!-- Vesitable Shop Start-->
        <div class="container-fluid vesitable py-5 bg-light-blue">
            @foreach ($categories as $category)
                <div class="container p-5 bg-white rounded mb-5">
                    <h1 class="mb-0">{{ $category->name }} mới nhất</h1>
                    <div class="owl-carousel vegetable-carousel justify-content-center">
                        @foreach ($category->products as $product)
                            <div class="border border-primary rounded position-relative vesitable-item">
                                <div class="vesitable-img">
                                    <img src="{{ $product->img ? asset('uploads/' . $product->img) : '' }}"
                                        class="img-fluid w-100 rounded-top" alt="" />
                                </div>
                                <!-- <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div> -->
                                <div class="p-4 rounded-bottom">
                                    <h6 class="product-name">
                                        {{ $product->name }}
                                    </h6>
                                    <p class="description-text">
                                        {{ $product->description }}
                                    </p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fw-bold mb-0 mb-2">
                                            <span
                                                style="color: red">{{ $product->productdetails->first()->price ?? '0' }}đ</span>
                                            {{ $product->unit ? '/' . $product->unit : '' }}
                                        </p>
                                        <a href="{{ route('client.products.show', $product->id) }}"
                                            class="btn border border-secondary rounded-pill px-3 text-primary"
                                            style="height: fit-content"><i class="fa-solid fa-eye icon-detail"></i>
                                            <span class="text-detail">Xem chi tiết</span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            @endforeach


        </div>
        <!-- Vesitable Shop End -->

        <!-- Banner Section Start-->
        <div class="container-fluid banner bg-secondary">
            <div class="container py-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="py-4">
                            <h1 class="display-3 text-white">Nhà thuốc Hoa Đà</h1>
                            <p class="fw-normal display-3 text-dark mb-4">
                                thành lập năm 2012
                            </p>
                            <p class="mb-4 text-dark">
                                Do chính Tiến sĩ Hóa dược của Đại học Adelaide (Úc) Lý Hoa Đà
                                xây dựng và thành lập, chúng tôi tự hào có những dược sĩ chuyên
                                môn dày dặn kinh nghiệm, đảm bảo 100% thuốc chính hãng và dịch
                                vụ chăm sóc khách hàng tận tình
                            </p>
                            <a href="#"
                                class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">Đọc
                                thêm về chúng tôi</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img src="img/banner11.png" class="img-fluid w-100 rounded" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Section End -->



        <!-- Fact Start -->
        <div class="container-fluid py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 700px">
                <h1 class="display-4">Thương hiệu nổi bật</h1>
            </div>
            <div class="container">
                <div class="bg-light p-5 rounded">
                    <div class="row g-4 justify-content-center">
                        @foreach ($brands as $brand)
                            <div class="col-md-6 col-lg-6 col-xl-3">
                                <div class="counter bg-white rounded p-5">
                                    <img src="{{ $brand->img ? asset('uploads/' . $brand->img) : '' }}" alt="Nhã hàng" />
                                    <h5>{{ $brand->name }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact Start -->

        <!-- Tastimonial Start -->
        <div class="container-fluid testimonial py-5">
            <div class="container py-5">
                <div class="testimonial-header text-center">
                    <h4 class="text-primary">Góc sức khỏe</h4>
                    <h1 class="display-5 mb-5 text-dark">
                        Tin tức sức khỏe
                    </h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                    @foreach ($news as $item)
                        <a href="{{ route('news', $item->id) }}">
                            <div class="testimonial-item img-border-radius bg-light rounded p-4">
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
                    @endforeach
                </div>
                <p></p>
                <a href="{{ route('all-news') }}" class="text-primary text-decoration-underline fs-5 fw-bold">Xem tất cả
                    <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>
        <!-- Tastimonial End -->
    @endif


@endsection

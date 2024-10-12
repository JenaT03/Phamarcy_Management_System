@if ($products->isEmpty() && !empty($search))
    <div class="container-fluid fruite container-padding" style="background-image: linear-gradient(#F0F5FF, white);">
        <div class="container py-4">
            <p class="text-center">Không tìm thấy sản phẩm nào có tên "{{ $search }}".</p>
        </div>
    </div>
@endif

@if (!$products->isEmpty() && !empty($search))
    <div class="container-fluid fruite container-padding" style="background-image: linear-gradient(#F0F5FF, white);">
        <div class="container py-4">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4 justify-content-center bg-white mt-2 rounded px-4 py-2">
                                @foreach ($products as $product)
                                    <div class="col-6 col-md-4 col-xl-3">
                                        <div
                                            class="rounded position-relative fruite-item border border-secondary rounded">

                                            <div class="">
                                                <div class="fruite-img">
                                                    <img src="{{ $product->img ? asset('upload/products/' . $product->img) : asset('upload/products/default.png') }}"
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

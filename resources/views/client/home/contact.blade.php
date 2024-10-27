@extends('client.layouts.app')
@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header" style="padding: 7rem 0 3rem 0;">
    <h1 class="text-center text-white display-6">Liên hệ</h1>
</div>
<!-- Single Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto mb-4" style="max-width: 700px;">
                            <h1 class="text-primary">Liên hệ với chúng tôi</h1>
                        </div>
                        <div>
                            <div class="text-center">
                                <div class="d-flex p-4 rounded mb-4 bg-white">
                                    <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>

                                    <h4>Địa chỉ :</h4>
                                    <p class="mb-0 ms-3">Đường 30/2, An Khánh, Ninh Kiều, Cần Thơ</p>

                                </div>
                                <div class="d-flex p-4 rounded mb-4 bg-white">
                                    <i class="fas fa-envelope fa-2x text-primary me-4"></i>

                                    <h4>Email :</h4>
                                    <p class="mb-0 ms-3">hoada@gmail.com</p>

                                </div>
                                <div class="d-flex p-4 rounded bg-white">
                                    <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>

                                    <h4>Số điện thoại :</h4>
                                    <p class="mb-0 ms-3">(+084) 0359999999</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="h-100 rounded">
                            <iframe class="rounded w-100" style="height: 400px;"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3916.280661899265!2d105.7657444!3d10.0299337!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2s%C4%90%E1%BA%A1i%20h%E1%BB%8Dc%20C%E1%BA%A7n%20Th%C6%A1!5e0!3m2!1svi!2s!4v1694259649153!5m2!1svi!2s"
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection
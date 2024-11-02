<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 ">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.5)">
            <div class="row g-4">
                <div class="col-lg-3">
                    <a href="{{ route('home') }}">
                        <h1 class="text-primary mb-0">Hoa Đà</h1>
                    </a>
                </div>
                <div class="col-lg-6"></div>
                <div class="col-lg-3">
                    <div class="d-flex justify-content-end pt-3">
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Thành lập năm 2012</h4>
                    <p class="mb-4">
                        Do chính Tiến sĩ Hóa dược của Đại học Adelaide (Úc) Lý Hoa Đà
                        xây dựng và thành lập, chúng tôi tự hào có những dược sĩ chuyên
                        môn dày dặn kinh nghiệm, đảm bảo 100% thuốc chính hãng và dịch
                        vụ chăm sóc khách hàng tận tình
                    </p>
                    <a href="{{ route('introduce') }}"
                        class="btn border-secondary py-2 px-4 rounded-pill text-primary">Đọc thêm về chúng
                        tôi</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Thông tin nhà thuốc</h4>
                    <a class="btn-link" href="{{ route('introduce') }}">Giới thiệu</a>
                    <a class="btn-link" href="{{ route('contact') }}">Liên hệ</a>
                    <a class="btn-link" href="{{ route('all-news') }}">Góc sức khỏe</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Tài khoản</h4>
                    <a class="btn-link"
                        href="{{ Auth::check() ? route('profile.show', $customer->id) : route('login.index') }}">Đăng
                        nhập</a>
                    <a class="btn-link"
                        href="{{ Auth::check() ? route('profile.show', $customer->id) : route('register.index') }}">Đăng
                        ký</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <a href="{{ route('contact') }}" class="btn border-secondary py-2 px-4 rounded-pill mb-2 ">
                        <h5 class="text-primary mb-0">Thông tin liên hệ</h5>
                    </a>
                    <p>
                        Địa chỉ: Đường 3/2, P. Xuân Khách, Q. Ninh Kiều, TP. Cần Thơ
                    </p>
                    <p>Email:nhib2111857@student.ctu.edu.vn</p>
                    <p>Phone: +84 0359999999</p>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright bg-dark py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Trần Yến
                        Nhi</a>, 2024</span>
            </div>
            <div class="col-md-6 my-auto text-center text-md-end text-white">

            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->

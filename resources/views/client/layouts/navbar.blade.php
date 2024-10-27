<!-- Spinner Start -->
<div id="spinner"
    class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->

<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-white"></i>
                    <a href="#" class="text-white">Đường 3/2, P. Xuân Khách, Q. Ninh Kiều, TP. Cần Thơ</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-white"></i><a href="#"
                        class="text-white">nhib2111857@student.ctu.edu.vn</a></small>
            </div>
            <div class="top-link pe-2">
                <small class="me-3"><i class="fa-solid fa-phone me-2 text-white"></i><a href="#"
                        class="text-white">Tư vấn ngay: 0359999999</a></small>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar-light bg-white navbar-expand-xl">
            <div class="d-flex">
                <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
                    <img src="{{ asset('img/logo_hoada.png') }}" alt="logo" class="logo me-2" />
                    <div class="text-center">
                        <h5 class="text-primary display-7 m-0">Nhà thuốc</h5>
                        <h1 class="text-primary display-6">Hoa Đà</h1>
                    </div>
                </a>

                <form method="GET" class="d-flex ms-5 search-form" name="search" action="{{ route('home') }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập tên sản phẩm để tìm" aria-label="Search">
                    <button type="submit" class="btn btn-primary border-0 border-secondary rounded-pill text-white"><i
                            class="icon_search fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>


            </div>

            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto justify-content-around">
                    <a href="{{ route('home') }}"
                        class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}"><i
                            class="fa-solid fa-house"></i></a>
                    @foreach ($categories as $item)
                        <a href="{{ route('client.products.index', ['category_id' => $item->id]) }}"
                            class="nav-item nav-link ms-5 {{ request('category_id') == $item->id ? 'active' : '' }}">{{ $item->name }}</a>
                    @endforeach

                </div>
                @if (Auth::check())
                    <a class="my-auto d-flex justify-content-between" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false" style="font-size: 1.25rem">
                        <i class="fa-regular fa-user" style="margin-right: 10px; padding-top: 5px"></i>
                        <p class="m-0">{{ $customer->name }}</p>
                    </a>
                    <ul class="dropdown-menu text-center">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Đăng xuất</button>
                            </form>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('profile.show', $customer->id) }}">Trang cá
                                nhân</a></li>

                    </ul>
                @else
                    <div class="d-flex m-3 me-0">
                        <a href="{{ route('login.index') }}" class="my-auto">Đăng nhập</a>
                        <span class="mx-2 my-auto">/</span>
                        <a href="{{ route('register.index') }}" class="my-auto">Đăng ký</a>
                    </div>
                @endif


            </div>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
        </nav>
    </div>

</div>
<!-- Navbar End -->

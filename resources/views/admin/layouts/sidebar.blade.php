<div class="container-fluid page-header-login-register" style="padding: 1rem 0 1rem 0;">
    <div class="mb-4">
        <h3 class="text-primary text-center">Nhà thuốc Hoa Đà</h3>
        <h6 class="text-primary text-center"> CHUYÊN MÔN - CHẤT LƯỢNG - TẬN TÌNH</h6>
    </div>

    <h1 class="text-center text-white display-5 text-uppercase">Trang chủ</h1>
    <div class=" text-end me-5">
        <a class=" text-white dropdown-toggle fs-5 " role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-regular fa-user" style="margin-right: 10px;"></i>{{ $staff->name }}</a>
        <ul class="dropdown-menu text-center">
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                </form>
            </li>
            <li><a class="dropdown-item" href="{{ route('users.show', $staff->id) }}">Trang cá nhân</a></li>
        </ul>
    </div>
</div>

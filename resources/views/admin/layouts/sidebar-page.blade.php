<div class="container-fluid page-header-login-register" style="padding: 1rem 0 1rem 0;">

    <h1 class="text-center text-white display-5 text-uppercase">@yield('title')</h1>
    <div class="d-flex justify-content-between">
        <a href="{{ route('dashboard') }}"><i class="fa-solid fa-house text-white rounded-circle ms-5 back-icon"></i></a>
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



</div>

@if (session('message'))
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center ">
            <h5 class="animate__animated animate__fadeInLeft text-primary mt-4">{{ session('message') }}</h5>
        </div>
    </div>
@endif

@if ($errors->has('error'))
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center ">
            <h5 class="animate__animated animate__fadeInLeft text-primary mt-4">{{ $errors->first('error') }}</h5>
        </div>
    </div>
@endif

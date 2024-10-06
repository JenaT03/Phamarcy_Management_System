

     <div class="container-fluid page-header-login-register" style="padding: 1rem 0 1rem 0;">

        <h1 class="text-center text-white display-5 text-uppercase">@yield('title')</h1>
        <div class="d-flex justify-content-between">
            <a href="{{route('manage-home')}}"><i class="fa-solid fa-house text-white rounded-circle ms-5 back-icon"></i></a>
            <h5 class=" manage-user text-end me-5"> <i class="fa-regular fa-user" style="margin-right: 10px;"></i> Trần
                Yến
                Nhi</h5>
        </div>
    </div>

    @if (session('message'))
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center ">
                <h5 class="animate__animated animate__fadeInLeft text-primary mt-4">{{session('message')}}</h5>
            </div>
        </div>
    @endif

    @if($errors->has('error'))
    <div class="row">
            <div class="col-md-6 offset-md-3 text-center ">
                <h5 class="animate__animated animate__fadeInLeft text-primary mt-4">{{ $errors->first('error') }}</h5>
            </div>
    </div>
    
    @endif
    
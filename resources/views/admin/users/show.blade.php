@extends('admin.layouts.app-page')
@section('title', 'Thông tin cá nhân')
@section('content')
    <div class="container-fluid  py-4">
        <div class="rounded mx-4">
            <table class="table">
                <tbody>
                    <tr>
                        <td class="text-center">Mã số</td>
                        <td class="text-center user-info">{{ $staffShow->code }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">Họ và tên</td>
                        <td class="text-center user-info">{{ $staffShow->name }}</td>
                    </tr>

                    <tr>
                        <td class="text-center">Số điện thoại</td>
                        <td class="text-center user-info">{{ $staffShow->phone }}</td>
                    </tr>

                    <tr>
                        <td class="text-center">Năm sinh</td>
                        <td class="text-center user-info">{{ $staffShow->birth }}</td>
                    </tr>

                    <tr>
                        <td class="text-center">Giới tính</td>
                        <td class="text-center user-info">{{ $staffShow->gender }}</td>
                    </tr>
                </tbody>

            </table>
            <div class="container py-2 mt-3 d-flex justify-content-center" style="width: 70%;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" name="submit" class="btn d-flex btn-danger ">
                        <p class="text-white  mb-0" style="padding: 6px 35px">Đăng xuất</p>
                    </button>
                </form>

            </div>
        </div>
    </div>

@endsection

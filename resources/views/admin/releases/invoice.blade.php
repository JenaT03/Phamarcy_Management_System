@extends('admin.layouts.app-page')
@section('title', 'Bán hàng')
@section('content')
    <div class="container-fluid py-3 bg-light-blue">
        <div class="container py-2 col-md-8 offset-md-2 text-center bg-white rounded"
            style="font-family: 'DejaVu Sans', sans-serif;">
            <div class="img-fluid"><img src="{{ asset('img/logo-name.png') }}" alt="" style="width: 200px;"></div>
            <p>Đường 3/2, P. Xuân Khách, Q. Ninh Kiều, TP. Cần Thơ</p>
            <p>Hotline: 0359999999</p>
            <h2>HÓA ĐƠN</h2>
            <div class="d-flex">
                <p>NGÀY: </p>
                <p>{{ $release->datetime }}</p>
            </div>
            <div class="d-flex">
                <p>MÃ HÓA ĐƠN: </p>
                <p>{{ $release->id }}</p>
            </div>

            <div class="d-flex">
                <p>NHÂN VIÊN: </p>
                <p>{{ $release->staff->code . ' - ' . $release->staff->name }}</p>
            </div>

            <div class="d-flex">
                <p>KHÁCH HÀNG: </p>
                <p>{{ $release->customer->name ?? '' }}</p>
            </div>

            <div class="d-flex">
                <p>SĐT: </p>
                <p>{{ $release->customer->phone ?? '' }}</p>
            </div>

            <div class="d-flex">
                <p>GHI CHÚ:</p>
                <p>{{ $release->note }}</p>
            </div>
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($releaseDetails as $item)
                            <tr>
                                <th>{{ $item->product->name }}</th>
                                <th>{{ $item->quantity . ' ' . $item->product->unit }}</th>
                                <th>{{ $item->price }}đ</th>
                                <th>{{ $item->price * $item->quantity }}đ</th>
                                <th>{{ $item->note }}</th>
                            </tr>
                        @endforeach

                        <tr>
                            <th colspan="3"> Tổng tiền: </th>
                            <th>{{ $release->total }}đ</th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="fw-bold">
                <h5>LƯU Ý:</h5>
                <p>Sản phẩm được đổi trả 30 ngày dành cho khách hàng có thông tin số điện thoại, không áp dụng đổi trả
                    cho một số sản phẩm đặc thù</p>
            </div>


        </div>






        <div class="my-3 mt-5 d-flex justify-content-end">

            <a href="{{ route('releases.generate', $release->id) }}" class="btn btn-primary text-white text-center mx-4"
                style="padding: 15px 45px; font-size: 1.25rem;">Xuất hóa đơn</a>
            <a href="{{ route('releases.search') }}" name="submit" class="btn btn-primary text-white text-center mx-4"
                style="padding: 15px 45px; font-size: 1.25rem;">Trở về</a>
        </div>
    </div>
@endsection

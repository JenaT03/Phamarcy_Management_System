@extends('admin.layouts.app-page')
@section('title', 'Nhập hàng')
@section('content')
    <div class="container-fluid py-3 bg-light-blue">
        <div class="container py-2 col-md-8 offset-md-2 text-center bg-white rounded"
            style="font-family: 'DejaVu Sans', sans-serif;">
            <div class="img-fluid"><img src="{{ asset('img/logo-name.png') }}" alt="" style="width: 200px;"></div>
            <p>Đường 3/2, P. Xuân Khách, Q. Ninh Kiều, TP. Cần Thơ</p>
            <p>Hotline: 0359999999</p>
            <h2>BIÊN LAI</h2>
            <div class="d-flex">
                <p>NGÀY: </p>
                <p>{{ $receipt->datetime }}</p>
            </div>
            <div class="d-flex">
                <p>MÃ PHIẾU NHẬP: </p>
                <p>{{ $receipt->id }}</p>
            </div>

            <div class="d-flex">
                <p>NHÂN VIÊN: </p>
                <p>{{ $receipt->staff->code . ' - ' . $receipt->staff->name }}</p>
            </div>

            <div class="d-flex">
                <p>NHÀ CUNG CẤP: </p>
                <p>{{ $receipt->supplier->name }}</p>
            </div>
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá gốc</th>
                            <th>Giá bán</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receiptDetails as $item)
                            <tr>
                                <th>{{ $item->product->name }}</th>
                                <th>{{ $item->quantity . ' ' . $item->product->unit }}</th>
                                <th>{{ $item->original_price }}đ</th>
                                <th>{{ $item->selling_price }}đ</th>

                                <th>{{ $item->original_price * $item->quantity }}đ</th>
                            </tr>
                        @endforeach

                        <tr>
                            <th colspan="4"> Tổng tiền: </th>
                            <th>{{ $receipt->total }}đ</th>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>






        <div class="my-3 mt-5 d-flex justify-content-end">

            <a href="{{ route('receipts.generate', $receipt->id) }}" class="btn btn-primary text-white text-center mx-4"
                style="padding: 15px 45px; font-size: 1.25rem;">Xuất biên lai</a>
            <a href="{{ route('receipts.index') }}" name="submit" class="btn btn-primary text-white text-center mx-4"
                style="padding: 15px 45px; font-size: 1.25rem;">Trở về</a>
        </div>
    </div>
@endsection

@extends('admin.layouts.app-page')
@section('title', 'thống kê')
@section('content')
    <div class="row g-0 pt-3 bg-white">
        @can('releases-statistic')
            <a href="{{ route('statistics.showreleaselist') }}" class="col-3 text-center py-2  ">BÁN HÀNG</a>
        @endcan
        @can('receipts-statistic')
            <a href="{{ route('statistics.showreceiptlist') }}" class="col-3 text-center py-2">NHẬP HÀNG</a>
        @endcan
        @can('products-statistic')
            <a href="{{ route('statistics.productlist') }}" class="col-3 text-center py-2 ">SẢN
                PHẨM HẾT HẠN</a>

            <a href="{{ route('statistics.show-best-selling') }}" class="col-3 text-center py-2 border-cus fw-bold ">SẢN PHẨM
                BÁN CHẠY</a>
        @endcan




    </div>

    <div class="container-fluid fruite ">

        <div class="container py-5">
            <div class="row g-4 bg-white mt-2 rounded">
                <form action="{{ route('statistics.best-selling') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-between mb-3">
                        <p class="mb-0 ms-3" style="align-content: center;">LOẠI</p>
                        <div class="bg-light ps-3 py-2   rounded d-flex" style="box-shadow: 4px 4px 10px">
                            <select name="category" class="border-0 form-select-sm bg-light me-3">
                                <option value="all">Tất cả</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ $category == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="mb-0 ms-3" style="align-content: center;">PHIẾU XUẤT TỪ</p>

                        <div class="form-item ">
                            <input type="date" name="date-start" class="form-control  px-5"
                                value="{{ old('date-start', $dateStart ?? '') }}">
                            @error('date-start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <p class="mb-0" style="align-content: center;">ĐẾN</p>


                        <div class="form-item me-3">
                            <input type="date" name="date-end" class="form-control  px-5 "
                                value="{{ old('date-end', $dateEnd ?? '') }}">
                            @error('date-end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="text-center"><button class="btn btn-primary my-3 text-white px-4 py-2"> THỰC
                            HIỆN</button>
                    </div>
                </form>
                <hr>

                <div class="mt-4">
                    <h2 class="text-center mb-5">SẢN PHẨM BÁN CHẠY</h2>

                    <table class="table hid-border-style">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Mã số</th>
                                <th scope="col"></th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Số lượng bán ra</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($bestSellingProducts))
                                <p class="text-center"> Không có sản phẩm thuộc loại bạn cần tìm bán trong thời gian này</p>
                            @else
                                @foreach ($bestSellingProducts as $item)
                                    <tr class="text-center border-top">
                                        <td class="py-5">{{ $item->code }}</td>
                                        <td class="py-5"><img
                                                src="{{ $item->img ? asset('uploads/' . $item->img) : '' }}"
                                                style="width: 140px; height: 90px;" alt="Hình ảnh"></td>

                                        <td class="py-5">{{ $item->name }}</td>
                                        <td class="py-5">
                                            {{ $item->total_quantity }}{{ $item->unit ? '/' . $item->unit : '' }}</td>


                                    </tr>
                                @endforeach
                            @endif



                        </tbody>

                    </table>
                </div>


            </div>

        </div>
    </div>

@endsection

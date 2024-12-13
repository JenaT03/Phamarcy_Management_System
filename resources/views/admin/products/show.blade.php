@extends('admin.layouts.app-page')
@section('title', 'Sản phẩm')
@section('content')

    <div class=" container">
        <a href="{{ url()->previous() }}" class="btn btn-primary py-2 px-3 mt-5 text-white fs-5">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
        <div class="bg-white rounded mt-5">
            <h3 class="text-center py-4">Chi tiết sản phẩm</h3>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <h6 class="mb-3">Hình ảnh</h6>
                <div class="">
                    <img class="img-border" src="{{ $product->img ? asset('uploads/' . $product->img) : '' }}"
                        width="300px">
                </div>
            </div>


            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <h6 class="mb-3">Tên sản phẩm:</h6>
                <p class="">{{ $product->name }}</p>
            </div>


            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <h6 class="mb-3">Mô tả:</h6>
                <div>
                    {!! $product->description !!}
                </div>

            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <h6 class="mb-3">Thành phần:</h6>
                <div>
                    {!! $product->ingredient !!}
                </div>

            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <h6 class="mb-3">Hướng dẫn sử dụng:</h6>
                <div>
                    {!! $product->intruction !!}
                </div>
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <h6 class="mb-3">Phân loại:</h6>
                @foreach ($categories as $item)
                    @if ($product->categories->contains('id', $item->id))
                        <p class="">{{ $item->name }}</p>
                    @endif
                @endforeach
            </div>

            <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                <h6 class="mb-3">Nhãn hàng:</h6>
                @foreach ($brands as $item)
                    @if ($product->brand_id == $item->id)
                        <p class="">{{ $item->name }}</p>
                    @endif
                @endforeach

            </div>
        </div>


        <div class="col-md-6 offset-md-3 pb-3 my-3 d-flex justify-content-end">

            @can('edit-product')
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary text-white text-center"
                    style="padding: 15px 30px; font-size: 1.25rem;">Chỉnh sửa</a>
            @endcan


        </div>
    </div>


@endsection

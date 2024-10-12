@extends('admin.layouts.app-page')
@section('title', 'Sản phẩm')
@section('content')

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="d-flex justify-content-around mb-5">
                <a href="{{ route('products.create') }}" class="btn btn-primary text-white py-4 px-3">Thêm sản phẩm mới</a>
                <form method="GET" class="d-flex ms-5 search-form" name="search" action="{{ route('products.index') }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập tên sản phẩm để tìm" aria-label="Search">
                    <button type="submit" class="btn btn-primary border-0 border-secondary rounded-pill text-white"><i
                            class="icon_search fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div>
                @if ($products->isEmpty() && !empty($search))
                    <p class="text-center">Không tìm thấy sản phẩm nào có tên "{{ $search }}".</p>
                @endif
                <table class="table hid-border-style">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Mã số</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng tồn</th>
                            <th scope="col">Nhãn hàng</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody class="border-bottom">
                        @foreach ($products as $product)
                            <tr class="text-center border-top">
                                <td class="py-5">
                                    <img src="{{ $product->img ? asset('upload/products/' . $product->img) : asset('upload/products/default.png') }}"
                                        style="width: 140px; height: 90px;" alt="Hình ảnh">
                                </td>
                                <td class="py-5">{{ $product->code }}</td>
                                <td class="py-5">{{ $product->name }}</td>
                                <td class="py-5">{{ $product->productdetails->first()->price ?? '0' }}đ</td>
                                <td class="py-5">
                                    {{ $product->productdetails->first()->quantity ?? '0' }}{{ $product->unit ? '/' . $product->unit : '' }}
                                </td>
                                <td class="py-5">{{ $product->brand ? $product->brand->name : '' }}</td>
                                <td class="py-5 d-flex justify-content-around">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn"><i
                                            class="fa-solid fa-eye text-secondary" style="font-size: 1.25rem;"></i></a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn"><i
                                            class="fa-solid fa-pen text-primary" style="font-size: 1.25rem;"></i></a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" name="delete" data-bs-toggle="modal"
                                            data-bs-target="#delete-confirm"><i class="fa-solid fa-trash text-danger"
                                                style="font-size: 1.25rem;"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
            <div class="col-12">
                <div class="pagination d-flex justify-content-center mt-5">
                    {{-- Previous Page Link --}}
                    @if ($products->onFirstPage())
                        <a href="#" class="rounded disabled">&laquo;</a>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="rounded">&laquo;</a>
                    @endif

                    {{-- Pagination Links --}}
                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <a href="{{ $url }}" class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="rounded">&raquo;</a>
                    @else
                        <a href="#" class="rounded disabled">&raquo;</a>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="delete-confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fw-bold" id="staticBackdropLabel">Xác nhận xóa</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete">Xóa</button>
                    <button type="button" class="btn" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>

@endsection

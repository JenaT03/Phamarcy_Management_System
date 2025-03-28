@extends('admin.layouts.app-page')
@section('title', 'Lịch sử nhập hàng')
@section('content')
    <div class="container-fluid py-5">
        <div class="container pb-5">
            <div class="d-flex justify-content-between">
                <a href="{{ route('receipts.index') }}" class="btn btn-primary py-2 px-3 text-white fs-5">
                    <i class="fa-solid fa-arrow-left"></i>
                    Quay lại
                </a>

                <div>
                    <p class="mb-0 text-dark py-2 fs-5 fw-bold">Tổng tiền: {{ $receipt->total }}đ</p>
                </div>
            </div>
            <div class="d-flex justify-content-around mb-5">
                <form method="GET" class="d-flex ms-5 search-form" name="search"
                    action="{{ route('receipts.show', $receipt->id) }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập tên sản phẩm để tìm" aria-label="Search">
                    <button type="submit" class="btn btn-primary border-0 border-secondary rounded-pill text-white"><i
                            class="icon_search fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div>
                @if ($receiptDetails->isEmpty() && !empty($search))
                    <p class="text-center">Không tìm thấy sản phẩm có tên "{{ $search }}".</p>
                @endif
                <table class="table hid-border-style">
                    <thead>
                        <tr class="text-center">
                            <th scope="col"></th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá nhập</th>
                            <th scope="col">Giá bán</th>
                            <th scope="col">Hạn sử dụng</th>
                            <th scope="col">Thành tiền</th>

                        </tr>
                    </thead>
                    <tbody class="border-bottom">
                        @foreach ($receiptDetails as $item)
                            @php $total = 0; @endphp
                            <tr class="border-top text-center">
                                @php
                                    $itemTotal = $item->quantity * $item->original_price;
                                    $total += $itemTotal;
                                @endphp
                                <td class="py-5" width="15%"><img class="img-border"
                                        src="{{ $item->product->img ? asset('uploads/' . $item->product->img) : 'uploads/default.png' }}"
                                        alt="" width="110px"></td>
                                <td class="py-5" width="30%">{{ $item->product->name }}</td>
                                <td class="py-5" width="5%">{{ $item->quantity . ' ' . $item->product->unit }}</td>
                                <td class="py-5" width="10%">{{ $item->original_price }}đ</td>
                                <td class="py-5" width="10%">{{ $item->selling_price }}đ</td>
                                <td class="py-5" width="10%">{{ $item->expiry }}</td>
                                <td class="py-5" width="20%">{{ $itemTotal }}đ</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
            <div class="col-12">
                <div class="pagination d-flex justify-content-center mt-5">
                    {{-- Previous Page Link --}}
                    @if ($receiptDetails->onFirstPage())
                        <a href="#" class="rounded disabled">&laquo;</a>
                    @else
                        <a href="{{ $receiptDetails->previousPageUrl() }}" class="rounded">&laquo;</a>
                    @endif

                    {{-- Pagination Links --}}
                    @foreach ($receiptDetails->getUrlRange(1, $receiptDetails->lastPage()) as $page => $url)
                        @if ($page == $receiptDetails->currentPage())
                            <a href="{{ $url }}" class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($receiptDetails->hasMorePages())
                        <a href="{{ $receiptDetails->nextPageUrl() }}" class="rounded">&raquo;</a>
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

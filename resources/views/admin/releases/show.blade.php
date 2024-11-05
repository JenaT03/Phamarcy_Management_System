@extends('admin.layouts.app-page')
@section('title', 'Lịch sử bán hàng')
@section('content')
    <div class="container-fluid py-5 ">
        <div class="container pb-5 ">
            <div class="d-flex justify-content-between">
                <a href="{{ route('releases.index') }}" class="btn btn-primary py-2 px-3 text-white fs-5">
                    <i class="fa-solid fa-arrow-left"></i>
                    Quay lại
                </a>

                <div>
                    <p class="mb-0 text-dark py-2 fs-5 fw-bold">Tổng tiền: {{ $release->total }}đ</p>
                </div>
            </div>
            <div class="d-flex justify-content-around mb-5">
                <form method="GET" class="d-flex ms-5 search-form" name="search"
                    action="{{ route('releases.show', $release->id) }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập tên sản phẩm để tìm" aria-label="Search">
                    <button type="submit" class="btn btn-primary border-0 border-secondary rounded-pill text-white"><i
                            class="icon_search fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>

            </div>

            <div>
                @if ($releaseDetails->isEmpty() && !empty($search))
                    <p class="text-center">Không tìm thấy sản phẩm có tên"{{ $search }}".</p>
                @endif
                <table class="table hid-border-style">
                    <thead>
                        <tr class="text-center">
                            <th scope="col"></th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Ghi chú</th>

                        </tr>
                    </thead>
                    <tbody class="border-bottom">
                        @foreach ($releaseDetails as $item)
                            <tr class="border-top">
                                <td class="py-5"><img
                                        src="{{ $item->product->img ? asset('uploads/' . $item->product->img) : 'uploads/default.png' }}"
                                        alt="" width="70px"></td>
                                <td class="py-5">{{ $item->product->name }}</td>
                                <td class="py-5">{{ $item->quantity . ' ' . $item->product->unit }}</td>
                                <td class="py-5">{{ $item->price }}đ</td>
                                <td class="py-5">{{ $item->price * $item->quantity }}đ</td>
                                <td class="py-5">{{ $item->note }}</td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
            <div class="col-12">
                <div class="pagination d-flex justify-content-center mt-5">
                    {{-- Previous Page Link --}}
                    @if ($releaseDetails->onFirstPage())
                        <a href="#" class="rounded disabled">&laquo;</a>
                    @else
                        <a href="{{ $releaseDetails->previousPageUrl() }}" class="rounded">&laquo;</a>
                    @endif

                    {{-- Pagination Links --}}
                    @foreach ($releaseDetails->getUrlRange(1, $releaseDetails->lastPage()) as $page => $url)
                        @if ($page == $releaseDetails->currentPage())
                            <a href="{{ $url }}" class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($releaseDetails->hasMorePages())
                        <a href="{{ $releaseDetails->nextPageUrl() }}" class="rounded">&raquo;</a>
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

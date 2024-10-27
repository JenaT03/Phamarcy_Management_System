@extends('admin.layouts.app-page')
@section('title', 'khách hàng')
@section('content')

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="d-flex justify-content-around mb-5">
                <a href="{{ route('customers.create') }}" class="btn btn-primary text-white py-4 px-3">Thêm khách hàng mới</a>
                <form method="GET" class="d-flex ms-5 search-form" name="search" action="{{ route('customers.index') }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập số điện thoại để tìm" aria-label="Search">
                    <button type="submit" class="btn btn-primary border-0 border-secondary rounded-pill text-white"><i
                            class="icon_search fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            @if ($customers->isEmpty() && !empty($search))
                <p class="text-center">Không tìm thấy khách hàng nào có số điện thoại "{{ $search }}".</p>
            @endif
            <div>
                <table class="table hid-border-style">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Tên</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Năm sinh</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody class="border-bottom">
                        @foreach ($customers as $customer)
                            <tr class="text-center border-top">
                                <td class="py-5">{{ $customer->name }}</td>
                                <td class="py-5">{{ $customer->phone }}</td>
                                <td class="py-5">{{ $customer->birth }}</td>
                                <td class="py-5">{{ $customer->gender }}</td>
                                <td class="py-5 d-flex justify-content-around">
                                    <a href="{{ route('customers.show', $customer->id) }}" class="btn"><i
                                            class="fa-solid fa-eye text-secondary" style="font-size: 1.25rem;"></i></a>
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn"><i
                                            class="fa-solid fa-pen text-primary" style="font-size: 1.25rem;"></i></a>

                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
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
                    @if ($customers->onFirstPage())
                        <a href="#" class="rounded disabled">&laquo;</a>
                    @else
                        <a href="{{ $customers->previousPageUrl() }}" class="rounded">&laquo;</a>
                    @endif

                    {{-- Pagination Links --}}
                    @foreach ($customers->getUrlRange(1, $customers->lastPage()) as $page => $url)
                        @if ($page == $customers->currentPage())
                            <a href="{{ $url }}" class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($customers->hasMorePages())
                        <a href="{{ $customers->nextPageUrl() }}" class="rounded">&raquo;</a>
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

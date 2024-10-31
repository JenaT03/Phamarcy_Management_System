@extends('admin.layouts.app-page')
@section('title', 'Bán hàng')
@section('content')
    <div class="container-fluid pt-3">
        @can('show-release')
            <div class="container d-flex justify-content-end">
                <a href="{{ route('releases.index') }}" class="py-4 px-3 fs-5  text-decoration-underline">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    Lịch sử bán hàng
                </a>
            @endcan
        </div>
    </div>
    <div class="container-fluid pt-3">
        <div class="container pb-3">
            <div class="d-flex justify-content-around mb-5">
                @can('create-release')
                    <a href="{{ route('releases.create', 'null') }}" class="btn btn-primary text-white mx-2 py-4 px-3">Khách vãng
                        lai</a>
                @endcan

                @can('create-customer')
                    <a href="{{ route('customers.create') }}" class="btn btn-primary text-white mx-2 py-4 px-3">Thêm khách hàng
                        mới</a>
                @endcan
                <form method="GET" class="d-flex ms-5 search-form" name="search" action="{{ route('releases.search') }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập số điện thoại khách hàng để tìm" aria-label="Search">
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
                                @can('create-release')
                                    <td class="py-5">
                                        <a href="{{ route('releases.create', $customer->id) }}"
                                            class="btn btn-primary text-white"><i class="fa-solid fa-plus"></i><a>
                                    </td>
                                @endcan
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
@endsection

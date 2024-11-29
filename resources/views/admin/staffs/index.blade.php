@extends('admin.layouts.app-page')
@section('title', 'nhân viên')
@section('content')

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="d-flex justify-content-around mb-5">
                @can('create-staff')
                    <a href="{{ route('staffs.create') }}" class="btn btn-primary text-white py-4 px-3">Thêm nhân viên mới</a>
                @endcan
                <form method="GET" class="d-flex ms-5 search-form" name="search" action="{{ route('staffs.index') }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập mã số nhân viên để tìm" aria-label="Search">
                    <button type="submit" class="btn btn-primary border-0 border-secondary rounded-pill text-white"><i
                            class="icon_search fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            @if ($staffs->isEmpty() && !empty($search))
                <p class="text-center">Không tìm thấy nhân viên nào có mã số "{{ $search }}".</p>
            @endif
            <div>
                <table class="table hid-border-style me-0">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Mã số</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Năm sinh</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody class="border-bottom">
                        @foreach ($staffs as $staff)
                            <tr class="text-center border-top">
                                <td class="py-5" width="5%">{{ $staff->code }}</td>
                                <td class="py-5" width="20%">{{ $staff->name }}</td>
                                <td class="py-5" width="10%">{{ $staff->phone }}</td>
                                <td class="py-5" width="10%">{{ $staff->birth }}</td>
                                <td class="py-5" width="10%">{{ $staff->gender }}</td>
                                <td class="py-5" width="30%">{{ $staff->address }}</td>
                                <td class="py-5 d-flex justify-content-around" width="15%">
                                    @can('edit-staff')
                                        <a href="{{ route('staffs.edit', $staff->id) }}" class="btn"><i
                                                class="fa-solid fa-pen text-primary" style="font-size: 1.25rem;"></i></a>
                                    @endcan
                                    @can('show-detail-staff')
                                        <a href="{{ route('staffs.show', $staff->id) }}" class="btn"><i
                                                class="fa-solid fa-eye text-secondary" style="font-size: 1.25rem;"></i></a>
                                    @endcan
                                    @can('delete-staff')
                                        <form action="{{ route('staffs.destroy', $staff->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn" name="delete" data-bs-toggle="modal"
                                                data-bs-target="#delete-confirm"><i class="fa-solid fa-trash text-danger"
                                                    style="font-size: 1.25rem;"></i></button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="col-12">
                <div class="pagination d-flex justify-content-center mt-5">
                    {{-- Previous Page Link --}}
                    @if ($staffs->onFirstPage())
                        <a href="#" class="rounded disabled">&laquo;</a>
                    @else
                        <a href="{{ $staffs->previousPageUrl() }}" class="rounded">&laquo;</a>
                    @endif

                    {{-- Pagination Links --}}
                    @foreach ($staffs->getUrlRange(1, $staffs->lastPage()) as $page => $url)
                        @if ($page == $staffs->currentPage())
                            <a href="{{ $url }}" class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($staffs->hasMorePages())
                        <a href="{{ $staffs->nextPageUrl() }}" class="rounded">&raquo;</a>
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

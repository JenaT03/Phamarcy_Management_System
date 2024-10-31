@extends('admin.layouts.app-page')
@section('title', 'Nhà cung cấp')
@section('content')

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="d-flex justify-content-around mb-5">
                @can('create-supplier')
                    <a href="{{ route('suppliers.create') }}" class="btn btn-primary text-white py-4 px-3">Thêm nhà cung cấp
                        mới</a>
                @endcan
                <form method="GET" class="d-flex ms-5 search-form" name="search" action="{{ route('suppliers.index') }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập tên nhà cung cấp để tìm" aria-label="Search">
                    <button type="submit" class="btn btn-primary border-0 border-secondary rounded-pill text-white"><i
                            class="icon_search fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div>
                @if ($suppliers->isEmpty() && !empty($search))
                    <p class="text-center">Không tìm thấy nhà cung cấp nào có tên "{{ $search }}".</p>
                @endif
                <table class="table hid-border-style">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Tên</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Địa chỉ</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody class="border-bottom">
                        @foreach ($suppliers as $supplier)
                            <tr class="text-center border-top">
                                <td class="py-5">{{ $supplier->name }}</td>
                                <td class="py-5">{{ $supplier->phone }}</td>
                                <td class="py-5">{{ $supplier->address }}</td>
                                <td class="py-5 d-flex justify-content-around">
                                    @can('edit-supplier')
                                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn"><i
                                                class="fa-solid fa-pen text-primary" style="font-size: 1.25rem;"></i></a>
                                    @endcan
                                    @can('delete-supplier')
                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
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
                    @if ($suppliers->onFirstPage())
                        <a href="#" class="rounded disabled">&laquo;</a>
                    @else
                        <a href="{{ $suppliers->previousPageUrl() }}" class="rounded">&laquo;</a>
                    @endif

                    {{-- Pagination Links --}}
                    @foreach ($suppliers->getUrlRange(1, $suppliers->lastPage()) as $page => $url)
                        @if ($page == $suppliers->currentPage())
                            <a href="{{ $url }}" class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($suppliers->hasMorePages())
                        <a href="{{ $suppliers->nextPageUrl() }}" class="rounded">&raquo;</a>
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

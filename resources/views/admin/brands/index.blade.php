@extends('admin.layouts.app-page')
@section('title', 'Nhãn hàng')
@section('content')

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="d-flex justify-content-around mb-5">
                @can('create-brand')
                    <a href="{{ route('brands.create') }}" class="btn btn-primary text-white py-4 px-3">Thêm nhãn hàng mới</a>
                @endcan
                <form method="GET" class="d-flex ms-5 search-form" name="search" action="{{ route('brands.index') }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập tên nhãn hàng để tìm" aria-label="Search">
                    <button type="submit" class="btn btn-primary border-0 border-secondary rounded-pill text-white"><i
                            class="icon_search fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div>
                @if ($brands->isEmpty() && !empty($search))
                    <p class="text-center">Không tìm thấy nhãn hàng nào có tên "{{ $search }}".</p>
                @endif
                <table class="table hid-border-style">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Logo</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Quốc gia</th>
                            <th scope="col">Nổi bật</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody class="border-bottom">
                        @foreach ($brands as $brand)
                            <tr class="text-center border-top">
                                <td class="py-5">
                                    <img src="{{ $brand->img ? asset('uploads/' . $brand->img) : '' }}"
                                        style="width: 140px; height: 90px;" alt="Hình ảnh">
                                </td>
                                <td class="py-5">{{ $brand->name }}</td>
                                <td class="py-5">{{ $brand->country }}</td>
                                <td class="py-5">{{ $brand->hightlight == true ? 'Nổi bật' : '' }}</td>
                                <td class="py-5 d-flex justify-content-around">
                                    @can('edit-brand')
                                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn"><i
                                                class="fa-solid fa-pen text-primary" style="font-size: 1.25rem;"></i></a>
                                    @endcan
                                    @can('delete-brand')
                                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
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
                    @if ($brands->onFirstPage())
                        <a href="#" class="rounded disabled">&laquo;</a>
                    @else
                        <a href="{{ $brands->previousPageUrl() }}" class="rounded">&laquo;</a>
                    @endif

                    {{-- Pagination Links --}}
                    @foreach ($brands->getUrlRange(1, $brands->lastPage()) as $page => $url)
                        @if ($page == $brands->currentPage())
                            <a href="{{ $url }}" class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($brands->hasMorePages())
                        <a href="{{ $brands->nextPageUrl() }}" class="rounded">&raquo;</a>
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

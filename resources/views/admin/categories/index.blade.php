@extends('admin.layouts.app-page')
@section('title', 'Loại sản phẩm')
@section('content')

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="d-flex justify-content-around mb-5">
                @can('create-category')
                    <a href="{{ route('categories.create') }}" class="btn btn-primary text-white py-4 px-3">Thêm loại sản phẩm
                        mới</a>
                @endcan
                <form method="GET" class="d-flex ms-5 search-form" name="search" action="{{ route('categories.index') }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập tên loại sản phẩm để tìm" aria-label="Search">
                    <button type="submit" class="btn btn-primary border-0 border-secondary rounded-pill text-white"><i
                            class="icon_search fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div>
                @if ($categories->isEmpty() && !empty($search))
                    <p class="text-center">Không tìm thấy loại sản phẩm nào có tên "{{ $search }}".</p>
                @endif
                <table class="table hid-border-style">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Tên</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody class="border-bottom">
                        @foreach ($categories as $category)
                            <tr class="text-center border-top">
                                <td class="py-5">{{ $category->name }}</td>
                                <td class="py-5 d-flex justify-content-around">
                                    @can('edit-category')
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn"><i
                                                class="fa-solid fa-pen text-primary" style="font-size: 1.25rem;"></i></a>
                                    @endcan
                                    @can('delete-category')
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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

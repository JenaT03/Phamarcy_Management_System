@extends('admin.layouts.app-page')
@section('title', 'Lịch sử bán hàng')
@section('content')
    <div class="container-fluid py-5">
        <div class="container pb-5">
            <div class="d-flex justify-content-around mb-5">
                <form method="GET" class="d-flex ms-5 search-form" name="search" action="{{ route('releases.index') }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập mã số hóa đơn để tìm" aria-label="Search">
                    <button type="submit" class="btn btn-primary border-0 border-secondary rounded-pill text-white"><i
                            class="icon_search fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div>
                @if ($releases->isEmpty() && !empty($search))
                    <p class="text-center">Không tìm thấy hóa đơn nào có mã "{{ $search }}".</p>
                @endif
                <table class="table hid-border-style">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Mã hóa đơn</th>
                            <th scope="col">SĐT khách hàng</th>
                            <th scope="col">Nhân viên</th>
                            <th scope="col">Ngày bán</th>
                            <th scope="col">Tổng tiền</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody class="border-bottom">
                        @foreach ($releases as $release)
                            <tr class="text-center border-top">
                                <td class="py-5">{{ $release->id }}</td>
                                <td class="py-5">{{ $release->customer->phone ?? 'Chưa được lưu' }}</td>
                                <td class="py-5">{{ $release->staff->code . ' - ' . $release->staff->name }}</td>
                                <td class="py-5">{{ $release->datetime }}</td>
                                <td class="py-5">{{ $release->total }}</td>
                                <td class="py-5 d-flex justify-content-around">
                                    <a href="{{ route('releases.show', $release->id) }}" class="btn"><i
                                            class="fa-solid fa-eye text-secondary" style="font-size: 1.25rem;"></i></a>
                                    {{-- <a href="{{ route('releases.edit', [$release->id, $release->customer->id]) }}"
                                        class="btn"><i class="fa-solid fa-pen text-primary"
                                            style="font-size: 1.25rem;"></i></a> --}}
                                    @if (!$release->release_details->isEmpty())
                                        <a href="{{ route('releases.generate', $release->id) }}" class="btn"><i
                                                class="fa-solid fa-print" style="font-size: 1.25rem;"></i></a>
                                    @endif

                                    <form action="{{ route('releases.destroy', $release->id) }}" method="POST">
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
                    @if ($releases->onFirstPage())
                        <a href="#" class="rounded disabled">&laquo;</a>
                    @else
                        <a href="{{ $releases->previousPageUrl() }}" class="rounded">&laquo;</a>
                    @endif

                    {{-- Pagination Links --}}
                    @foreach ($releases->getUrlRange(1, $releases->lastPage()) as $page => $url)
                        @if ($page == $releases->currentPage())
                            <a href="{{ $url }}" class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($releases->hasMorePages())
                        <a href="{{ $releases->nextPageUrl() }}" class="rounded">&raquo;</a>
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

@extends('admin.layouts.app-page')
@section('title', 'Quản lý website')
@section('content')

    <div class="row g-0 py-2 bg-white border-bot-lr">
        @can('banner_website')
            <a href="{{ route('website.banners.index') }}" class="col-4 text-center py-2 ">BANNER</a>
        @endcan
        @can('news_website')
            <a href="{{ route('website.news.index') }}" class="col-4 text-center py-2 border-cus">TIN TỨC</a>
        @endcan
        @can('introduce_website')
            <a href="{{ route('website.introduce.index') }}" class="col-4 text-center py-2 ">GIỚI THIỆU</a>
        @endcan

    </div>


    <div class="container-fluid fruite ">

        <div class="container py-5">
            <div class="row g-4 bg-white mt-2 rounded">
                <form method="GET" class="d-flex ms-5 search-form" name="search"
                    action="{{ route('website.news.index') }}">
                    <input class="form-control me-2 rounded-pill" type="search" name="search"
                        placeholder="Nhập tựa tin tức để tìm" aria-label="Search">
                    <button type="submit" class="btn btn-primary border-0 border-secondary rounded-pill text-white"><i
                            class="icon_search fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
                <a href="{{ route('website.news.create') }}"
                    class="btn btn-primary text-white col-3 align-content-center offset-md-2">
                    <p class="mb-0"> Thêm tin tức</p>
                </a>

                @if ($news->isEmpty() && !empty($search))
                    <p class="text-center">Không tìm thấy tin tức nào nào có tựa đề "{{ $search }}".</p>
                @endif

                <table class="table hid-border-style mt-5">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Tựa đề</th>
                            <th scope="col">Nổi bật</th>
                            <th scope="col">Tác giả</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $item)
                            <tr class="text-center border-top">
                                <td class="py-5" width="60%">{{ $item->title }}</td>
                                <td class="py-5" width="6%">
                                    {!! $item->highlight == true ? '<i class="fa-solid fa-star text-warning"></i>' : '' !!}</td>
                                <td class="py-5" width="17%">{{ $item->author }}</td>

                                <td class="py-5 d-flex justify-content-around" width="17%">
                                    <a href="{{ route('website.news.show', $item->id) }}" class="btn"><i
                                            class="fa-solid fa-eye text-secondary" style="font-size: 1.25rem;"></i></a>
                                    <a href="{{ route('website.news.edit', $item->id) }}" class="btn"><i
                                            class="fa-solid fa-pen text-primary" style="font-size: 1.25rem;"></i></a>
                                    <form action="{{ route('website.news.destroy', $item->id) }}" method="POST">
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

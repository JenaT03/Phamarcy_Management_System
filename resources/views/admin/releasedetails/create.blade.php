@extends('admin.layouts.app-page')
@section('title', 'Bán hàng')
@section('content')


    <div class="container-fluid py-5">
        <div class="row g-5">
            <div class="col-md-12 col-lg-4 col-xl-5">
                @include('admin.layouts.search-product')
                <form action="{{ route('releasedetails.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name ="release_id" value="{{ $releaseId }} ">
                    <div class="form-item col-md-8 offset-md-2 pb-3 my-3">
                        <label class="form-label">Mã số sản phẩm</label>
                        <input type="text" class="form-control" name ="product_code" value="{{ old('product_code') }}">
                        @error('product_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-item col-md-8 offset-md-2 pb-3 my-3">
                        <label class="form-label">Số lượng</label>
                        <input type="number" class="form-control" name ="quantity" value="{{ old('quantity') }}"
                            min="1">
                        @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-item col-md-8 offset-md-2 pb-3 my-3">
                        <label class="form-label">Ghi chú</label>
                        <textarea name="note" class="form-control" cols="30" rows="6" spellcheck="false">{{ old('note') }}</textarea>
                    </div>


                    <div class="d-flex justify-content-around">
                        <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                            style="padding: 10px 35px;">Thêm</button>
                    </div>
                </form>
            </div>



            <div class="col-md-12 col-lg-8 col-xl-7">
                <div>
                    @if ($customer)
                        <p class="fw-bold">Khách hàng: {{ $customer->name . ' - ' . $customer->phone }}</p>
                    @endif
                    <p class="fw-bold">Mã đơn hàng: {{ $releaseId }}</p>
                    <table class="table scrollable-body-table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Thành tiền</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="scrollable-body-tbody">
                            @php $total = 0; @endphp
                            @foreach ($releaseDetails as $item)
                                <tr>
                                    @php
                                        $itemTotal = $item->quantity * $item->price;
                                        $total += $itemTotal;
                                    @endphp
                                    <td class="py-5"><img
                                            src="{{ $item->product->img ? asset('uploads/' . $item->product->img) : '' }}"
                                            alt="" width="70px"></td>
                                    <td class="py-5">{{ $item->product->name }}</td>
                                    <td class="py-5">{{ $item->quantity . ' ' . $item->product->unit }}</td>
                                    <td class="py-5">{{ $item->price }}đ</td>
                                    <td class="py-5">{{ $itemTotal }}đ</td>
                                    <td class="py-5">{{ $item->note }}</td>
                                    <td class="py-5 d-flex justify-content-around" style="border-bottom: 0;">
                                        @can('edit-release')
                                            <a href="{{ route('releasedetails.edit', ['id' => $item->id, 'releaseId' => $releaseId]) }}"
                                                class="btn">
                                                <i class="fa-solid fa-pen text-primary" style="font-size: 1.25rem;"></i>
                                            </a>
                                        @endcan
                                        @can('delete-release')
                                            <form
                                                action="{{ route('releasedetails.destroy', ['id' => $item->id, 'releaseId' => $releaseId]) }}"
                                                method="POST">
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
                            <tr>
                                <td class="py-5"></td>
                                <td class="py-5"></td>
                                <td class="py-5"></td>
                                <td class="py-5"></td>
                                <td class="py-5">
                                    <p class="mb-0 text-dark py-3">Tổng tiền</p>
                                </td>
                                <td class="py-5">
                                    <div class="py-3 border-bottom border-top">
                                        <p class="mb-0 text-dark">{{ $total }}đ</p>
                                    </div>
                                </td>
                                <td class="py-5"></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="my-3 mt-5 d-flex justify-content-between">
                @can('edit-release')
                    @if ($customer)
                        <a href="{{ route('releases.edit', ['id' => $releaseId, 'customerId' => $customer->id]) }}"
                            name="" class="btn btn-primary text-white text-center"
                            style="padding: 15px 45px; font-size: 1.25rem;">Quay
                            lại</a>
                    @else
                        <a href="{{ route('releases.edit', ['id' => $releaseId, 'customerId' => 0]) }}" name=""
                            class="btn btn-primary text-white text-center" style="padding: 15px 45px; font-size: 1.25rem;">Quay
                            lại</a>
                    @endif
                @endcan
                <form action="{{ route('releases.finish', $releaseId) }}" method="POST">
                    @csrf
                    <input type="number" name="total" value="{{ $total }}" hidden>
                    <button type="submit" name="" class="btn btn-primary text-white text-center"
                        style="padding: 15px 45px; font-size: 1.25rem;">Hoàn thành</button>
                </form>

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

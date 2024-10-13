@extends('admin.layouts.app-page')
@section('title', 'Bán hàng')
@section('content')
    <div class=" container">
        @if (!$customer)
            <form action="{{ route('releases.store') }}" method="POST">
                @csrf
                <input type="text" name="customer_id" value="" hidden>
                <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                    <label class="form-label">Mã số nhân viên</label>
                    <input type="text" name="staff_code" class="form-control" value="{{ $staff->code }}" readonly>
                </div>

                <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                    <label class="form-label">Ngày bán</label>
                    <input type="text" class="form-control" name="datetime" value="{{ $currentDateTime }}" readonly>
                </div>

                <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                    <label class="form-label">Ghi chú</label>
                    <textarea name="note" class="form-control" cols="30" rows="6" spellcheck="false">{{ old('note') }}</textarea>

                </div>

                <div class="my-3 d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                        style="padding: 15px 45px; font-size: 1.25rem;">Tiếp tục</button>
                </div>

            </form>
        @else
            <form action="{{ route('releases.store') }}" method="POST">
                @csrf
                <input type="text" name="customer_id" value="{{ $customer->id }}" hidden>
                <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                    <label class="form-label">Số điện thoại khách hàng</label>
                    <input type="text" name="customer_phone" class="form-control" value="{{ $customer->phone }}"
                        readonly>
                </div>

                <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                    <label class="form-label">Tên khách hàng</label>
                    <input type="text" name="customer_name" class="form-control" value="{{ $customer->name }}" readonly>
                </div>

                <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                    <label class="form-label">Mã số nhân viên</label>
                    <input type="text" name="staff_code" class="form-control" value="{{ $staff->code }}" readonly>
                </div>

                <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                    <label class="form-label">Ngày bán</label>
                    <input type="text" class="form-control" name="datetime" value="{{ $currentDateTime }}" readonly>
                </div>

                <div class="form-item col-md-6 offset-md-3 pb-3 my-3">
                    <label class="form-label">Ghi chú</label>
                    <textarea name="note" class="form-control" cols="30" rows="6" spellcheck="false">{{ old('note') }}</textarea>

                </div>



                <div class="my-3 d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-primary text-white text-center"
                        style="padding: 15px 45px; font-size: 1.25rem;">Tiếp tục</button>
                </div>

            </form>
        @endif

    </div>
@endsection

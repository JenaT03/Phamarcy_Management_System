@extends('client.layouts.app')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header" style="padding: 7rem 0 3rem 0;">
        <h1 class="text-center text-white display-6">Lịch sử hóa đơn</h1>
    </div>
    <!-- Single Page Header End -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h2 class="text-center mb-5">Hóa đơn của bạn</h2>

            <form action="{{route('customers.release-list',  $customer->id)}}" class="d-flex justify-content-end mb-5" method="POST">
                @csrf
                <input type="text" name="customerId" value="{{$customer->id}}" hidden>
                <p class="mb-0 mx-2" style="align-content: center;">TỪ</p>

                <div class="form-item  mx-2">
                    <input type="date" name="date-start" class="form-control  px-3"
                        value="{{ old('date-start', $dateStart ?? '') }}">
                    @error('date-start')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>



                <p class="mb-0  mx-2" style="align-content: center;">ĐẾN</p>


                <div class="form-item  mx-2">
                    <input type="date" name="date-end" class="form-control  px-3"
                        value="{{ old('date-end', $dateEnd ?? '') }}">
                    @error('date-end')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary text-white px-4 py-2  mx-2"> TÌM KIẾM</button>


            </form>


            <table class="table hid-border-style">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Mã hóa đơn</th>
                        <th scope="col">Nhân viên</th>
                        <th scope="col">Ngày mua</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody class="border-bottom">
                    @foreach ($releases as $release)
                        <tr class="text-center border-top">
                            <td class="py-5">{{ $release->id }}</td>
                            <td class="py-5">{{ $release->staff->code . ' - ' . $release->staff->name }}</td>
                            <td class="py-5">{{ $release->datetime }}</td>
                            <td class="py-5">{{ $release->total }}</td>
                            <td class="py-5 d-flex justify-content-around">
                                <a href="{{route('customers.show-detail', ['customer' => $customer->id, 'release' => $release->id])}}" class="btn"><i class="fa-solid fa-eye text-secondary "
                                        style="font-size: 1.25rem;"></i></a>
                            </td>

                        </tr>
                    @endforeach



                </tbody>

            </table>
        </div>
    </div>
@endsection

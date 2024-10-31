 @extends('admin.layouts.app-page')
 @section('title', 'thống kê')
 @section('content')
     <div class="row g-0 pt-3 bg-white">
         @can('releases-statistic')
             <a href="{{ route('statistics.showreleaselist') }}" class="col-4 text-center py-2 ">BÁN HÀNG</a>
         @endcan
         @can('receipts-statistic')
             <a href="{{ route('statistics.showreceiptlist') }}" class="col-4 text-center py-2">NHẬP HÀNG</a>
         @endcan
         @can('products-statistic')
             <a href="{{ route('statistics.productlist') }}" class="col-4 text-center py-2 border-cus fw-bold">SẢN
                 PHẨM</a>
         @endcan


     </div>

     <div class="container-fluid fruite ">

         <div class="container py-5">
             <div class="row g-4 bg-white mt-2 rounded">
                 <form action="{{ route('statistics.releaselist') }}" method="POST">
                     @csrf
                     <div class="d-flex justify-content-between mb-3">
                         <p class="mb-0 ms-3" style="align-content: center;">PHIẾU XUẤT TỪ</p>

                         <div class="form-item ">
                             <input type="date" name="date-start" class="form-control  px-5"
                                 value="{{ old('date-start', $dateStart ?? '') }}">
                             @error('date-start')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                         </div>

                         <p class="mb-0" style="align-content: center;">ĐẾN</p>


                         <div class="form-item me-3">
                             <input type="date" name="date-end" class="form-control  px-5 "
                                 value="{{ old('date-end', $dateEnd ?? '') }}">
                             @error('date-end')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>

                     <div class="text-center"><button type="submit" class="btn btn-primary my-3 text-white px-4 py-2"> THỰC
                             HIỆN</button>
                 </form>
                 <hr>

                 <div class="d-flex justify-content-between my-4">
                     <p class="fs-5">TỔNG THU: {{ $totalReleases }}đ</p>
                     @if ($releases != 'start' && !$releases->isEmpty())
                         <form action="{{ route('statistics.printReleasesList') }}" method="POST">
                             @csrf
                             <input type="date" name="date-start" value="{{ $dateStart }}" hidden>
                             <input type="date" name="date-end" value="{{ $dateEnd }}"hidden>
                             <input type="text" name="total" value="{{ $totalReleases }}" hidden>

                             <button type='submit' class="btn btn-primary text-white px-3 py-4">IN DANH SÁCH PHIẾU
                                 XUẤT</button>
                         </form>
                     @endif
                 </div>

                 <div class="mt-4">
                     <h2>DANH SÁCH PHIẾU XUẤT</h2>

                     <table class="table hid-border-style">
                         <thead>
                             <tr class="text-center mb-3">
                                 <th scope="col">Mã phiếu</th>
                                 <th scope="col">Nhân viên</th>
                                 <th scope="col">Khách hàng</th>
                                 <th scope="col">Thời gian</th>
                                 <th scope="col">Tổng tiền</th>
                             </tr>
                         </thead>
                         <tbody>
                             @if ($releases == 'start')
                             @else
                                 @if ($releases->isEmpty())
                                     <p class="text-center my-4"> Không có phiếu xuất nào trong khoảng thời gian này </p>
                                 @else
                                     @foreach ($releases as $release)
                                         <tr class="text-center border-top">
                                             <td class="py-5">{{ $release->id }}</td>
                                             <td class="py-5">{{ $release->staff->code . ' - ' . $release->staff->name }}
                                             </td>
                                             <td class="py-5">{{ $release->customer->phone ?? 'Chưa lưu' }}</td>
                                             <td class="py-5">{{ $release->datetime }}</td>
                                             <td class="py-5">{{ $release->total }}</td>
                                         </tr>
                                     @endforeach
                                 @endif
                             @endif
                         </tbody>

                     </table>
                 </div>


             </div>
         </div>
     </div>
 @endsection

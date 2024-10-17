 @extends('admin.layouts.app-page')
 @section('title', 'thống kê')
 @section('content')

     <div class="row g-0 pt-3 bg-white">
         <a href="{{ route('statistics.showreleaselist') }}" class="col-4 text-center py-2 ">BÁN HÀNG</a>
         <a href="{{ route('statistics.showreceiptlist') }}" class="col-4 text-center py-2">NHẬP HÀNG</a>
         <a href="{{ route('statistics.productlist') }}" class="col-4 text-center py-2 border-cus fw-bold">SẢN
             PHẨM</a>

     </div>
     <div class="container-fluid fruite ">

         <div class="container py-5">
             <div class="row g-4 bg-white mt-2 rounded">

                 <div class="mt-4">
                     <h2 class="text-center mb-5">SẢN PHẨM CÓ HẠN SỬ DỤNG DƯỚI 6 THÁNG</h2>

                     <table class="table hid-border-style">
                         <thead>
                             <tr class="text-center">
                                 <th scope="col">Mã số</th>
                                 <th scope="col">Sản phẩm</th>
                                 <th scope="col"></th>
                                 <th scope="col">Số lượng tồn</th>
                                 <th scope="col">Hạn sử dụng</th>
                                 <th scope="col">Ngày nhập</th>
                             </tr>
                         </thead>
                         <tbody>
                             @if (!$products)
                                 <p class="text-center"> Không có sản phẩm nào có hạn sử dụng dưới 6 tháng</p>
                             @else
                                 @foreach ($products as $product)
                                     @foreach ($product->productdetails as $productDetail)
                                         <tr class="text-center border-top">
                                             <td class="py-5">{{ $product->code }}</td>
                                             <td class="py-5"><img
                                                     src="{{ $product->img ? asset('upload/products/' . $product->img) : asset('upload/products/default.png') }}"
                                                     style="width: 140px; height: 90px;" alt="Hình ảnh"></td>
                                             <td class="py-5">{{ $product->name }}</td>
                                             <td class="py-5">{{ $productDetail->quantity . ' ' . $product->unit }}</td>
                                             <td class="py-5">{{ $productDetail->expiry }}</td>
                                             <td class="py-5">
                                                 @if ($productDetail->receiptdetail && $productDetail->receiptdetail->receipt)
                                                     {{ $productDetail->receiptdetail->receipt->datetime }}
                                                 @else
                                                     Không có dữ liệu
                                                 @endif
                                             </td>

                                         </tr>
                                     @endforeach
                                 @endforeach
                             @endif


                         </tbody>

                     </table>

                 </div>


             </div>
         </div>
     </div>



 @endsection

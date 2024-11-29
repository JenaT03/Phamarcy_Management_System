<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ 'Phiếu nhập-' . $receipt->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: 'DejaVu Sans', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: 'DejaVu Sans', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: 'DejaVu Sans', sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: 'DejaVu Sans', sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: 'DejaVu Sans', sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: 'DejaVu Sans', sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #8FC9FF;
            color: #fff;
        }
    </style>
</head>

<body>

    <table class="order-details">
        <thead>
            <tr>
                <th class="text-center" width="100%" colspan="2">
                    <h1>Nhà thuốc HOA ĐÀ</h1>
                    <p>Đường 3/2, P. Xuân Khách, Q. Ninh Kiều, TP. Cần Thơ</p>
                    <p>Hotline: 0359999999</p>
                    <h2>PHIẾU XUẤT</h2>
                </th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>NGÀY:</td>
                <td>{{ $receipt->datetime }}</td>

            </tr>
            <tr>
                <td>MÃ PHIẾU NHẬP:</td>
                <td>{{ $receipt->id }}</td>

            </tr>
            <tr>
                <td>NHÂN VIÊN:</td>
                <td>{{ $receipt->staff->code . ' - ' . $receipt->staff->name }}</td>

            </tr>
            <tr>
                <td>NHÀ CUNG CẤP:</td>
                <td>{{ $receipt->supplier->name }}</td>

            </tr>

        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5"> Sản phẩm </th>
            </tr>
            <tr class="bg-blue">
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá gốc</th>
                <th>Giá bán</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receiptDetails as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td width="10%">{{ $item->quantity . ' ' . $item->product->unit }}</td>
                    <td width="10%">{{ $item->original_price }}đ</td>
                    <td width="10%">{{ $item->selling_price }}đ</td>
                    <td width="15%">{{ $item->original_price * $item->quantity }}đ</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="total-heading">TỔNG TIỀN</td>
                <td colspan="1" class="total-heading">{{ $receipt->total }}đ</td>
            </tr>
        </tbody>
    </table>
</body>

</html>

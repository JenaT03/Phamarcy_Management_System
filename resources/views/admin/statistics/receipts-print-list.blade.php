<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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

    <h2 class="text-center">DANH SÁCH PHIẾU NHẬP</h2>
    <p class="text-center">Từ ngày {{ $dateStart }} đến {{ $dateEnd }}</p>
    <table>
        <thead>
            <tr>
                <th class="no-border text-start" colspan="5"> TỔNG CHI: {{ $totalReceipts }}đ </th>
            </tr>
            <tr class="bg-blue">
                <th>Mã phiếu</th>
                <th>Nhân viên</th>
                <th>Nhà cung cấp</th>
                <th>Thời gian</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($receipts as $receipt)
                    <td>{{ $receipt->id }}</td>
                    <td>{{ $receipt->staff->code . ' - ' . $receipt->staff->name }}</td>
                    <td>{{ $receipt->supplier->name }}</td>
                    <td>{{ $receipt->datetime }}</td>
                    <td>{{ $receipt->total }}</td>
                @endforeach

            </tr>

        </tbody>
    </table>
</body>

</html>

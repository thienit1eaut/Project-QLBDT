<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn nhập hàng</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body>
    <h3>HÓA ĐƠN NHẬP HÀNG</h3>
    <p><strong>Mã đơn:</strong> {{ $import->code }}</p>
    <p><strong>Nhà cung cấp:</strong> {{ $import->supplier->name }}</p>
    <p><strong>Nhân viên tạo:</strong> {{ $import->employee->name }}</p>
    <br>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($import->details as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ format_price($item->import_price) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4 style="text-align:right">Tổng tiền: {{ format_price($import->total_price) }}</h4>
</body>
</html>

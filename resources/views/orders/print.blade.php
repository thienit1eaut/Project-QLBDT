<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body>
    <h3>HÓA ĐƠN BÁN HÀNG</h3>
    <p><strong>Mã đơn:</strong> {{ $order->order_code }}</p>
    <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
    <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
    <br>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderDetails as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price) }} đ</td>
                    <td>{{ number_format($item->into_money) }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4 style="text-align:right">Tổng tiền: {{ number_format($order->total_price) }} đ</h4>
</body>
</html>

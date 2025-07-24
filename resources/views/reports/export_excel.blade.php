<h3>Báo cáo thống kê từ {{ $from }} đến {{ $to }}</h3>
<ul>
    <li>Doanh thu: {{ number_format($totalRevenue) }} đ</li>
    <li>Đơn hàng: {{ $orderCount }}</li>
    <li>Chi phí nhập: {{ number_format($totalImportCost) }} đ</li>
    <li>Phiếu nhập: {{ $importCount }}</li>
    <li>Giá trị tồn kho: {{ number_format($inventoryValue) }} đ</li>
</ul>

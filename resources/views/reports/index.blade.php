@extends('dashboard')
@section('content')
<main id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-2">
                @include('sidebar')
            </div>
            <div class="col col-md-10">
                <div class="content-main">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between mb-3">
                            <h3 class="card-title float-left m-0 font-weight-bold" style="font-size: 18px;">BÁO CÁO - THỐNG KÊ</h3>
                        </div>
                        <div class="card-body px-3 py-3 table-responsive text-nowrap">
                            <form method="GET" class="form-inline mb-4">
                                <label>Từ ngày: </label>
                                <input type="date" name="from" value="{{ $from }}" class="form-control mx-2">
                                <label>Đến ngày: </label>
                                <input type="date" name="to" value="{{ $to }}" class="form-control mx-2">
                                <button class="btn btn-primary">Lọc</button>
                            </form>

                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Doanh thu bán hàng</h5>
                                    <ul class="list-group">
                                        <li class="list-group-item">Tổng doanh thu: <strong>{{ number_format($totalRevenue) }} đ</strong></li>
                                        <li class="list-group-item">Số đơn hàng: {{ $orderCount }}</li>
                                    </ul>
                                </div>

                                <div class="col-md-6">
                                    <h5>Nhập hàng</h5>
                                    <ul class="list-group">
                                        <li class="list-group-item">Tổng chi phí nhập: <strong>{{ number_format($totalImportCost) }} đ</strong></li>
                                        <li class="list-group-item">Số phiếu nhập: {{ $importCount }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5 class="mb-2 font-weight-bold">Tồn kho</h5>
                                <p>Tổng giá trị tồn kho: <strong>{{ number_format($inventoryValue) }} đ</strong></p>

                                <h6>Sản phẩm sắp hết hàng:</h6>
                                @if($lowStockProducts->isEmpty())
                                    <p>Không có sản phẩm sắp hết hàng.</p>
                                @else
                                    <ul class="list-group">
                                        @foreach($lowStockProducts as $product)
                                            <li class="list-group-item">
                                                {{ $product->name }} - Còn lại: {{ $product->quantity }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('reports.export.pdf', ['from' => $from, 'to' => $to]) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Xuất PDF
                            </a>
                            <a href="{{ route('reports.export.excel', ['from' => $from, 'to' => $to]) }}" class="btn btn-success ml-2">
                                <i class="fas fa-file-excel"></i> Xuất Excel
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
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
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="card-title float-left m-0 font-weight-bold" style="font-size: 18px;">Danh sách hóa đơn bán hàng</h3>
                            <div class="card-group-button">
                                <a href="#" class="btn btn-primary mr-1" title="Tìm kiếm">Tìm kiếm</a>
                                <a href="{{ route('orders.create') }}" class="btn btn-primary" title="Thêm mới">Tạo mới hóa đơn bán hàng</a>
                            </div>
                        </div>
                        <div class="card-body p-0 table-responsive text-nowrap">
                            <table class="table mb-0 card-table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <div class="form-check">
                                                <input class="form-check-input position-static m-0" type="checkbox" id="blankCheckbox">
                                            </div>
                                        </th>
                                        <th scope="col">Mã hóa đơn</th>
                                        <th scope="col">Nhân viên bán</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Số điện thoại KH</th>
                                        <th scope="col">Địa chỉ KH</th>
                                        <th scope="col">Tổng số lượng</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Thời gian tạo</th>
                                        <th scope="col" width="210"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $item)
                                    <tr class="has-link">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input position-static m-0" type="checkbox" value="{{ $loop->index + 1 }}" id="blankCheckbox">
                                            </div>
                                        </td>
                                        <td>{{ $item->order_code }}</td>
                                        <td>{{ $item->employee->name ?? 'Chưa xác định!' }}</td>
                                        <td class="text-center">{{ $item->customer_name }}</td>
                                        <td class="text-center">{{ $item->customer_phone }}</td>
                                        <td class="text-center">{{ $item->customer_address }}</td>
                                        <td class="text-center">{{ $item->total_quantity }}</td>
                                        <td class="text-center">{{ format_price($item->total_price) }}</td>
                                        <td class="text-center">{{ $item->status }}</td>
                                        <td class="text-center">{{ $item->created_at }}</td>
                                        <td class="disable-link text-right">
                                            <a href="{{ route('orders.print', $item->id) }}" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-print"></i></a>
                                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="7">Không có đơn hàng nào.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <!-- Hiển thị phân trang -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
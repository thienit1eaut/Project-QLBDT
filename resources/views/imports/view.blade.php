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
                            <h3 class="card-title float-left m-0 font-weight-bold" style="font-size: 18px;">Danh sách phiếu nhập</h3>
                            <div class="card-group-button">
                                <a href="#" class="btn btn-primary mr-1" title="Tìm kiếm">Tìm kiếm</a>
                                <a href="{{ route('imports.create') }}" class="btn btn-primary" title="Thêm mới">Tạo mới phiếu nhập</a>
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
                                        <th scope="col">Mã phiếu nhập</th>
                                        <th scope="col">Nhà cung cấp</th>
                                        <th scope="col">Nhân viên</th>
                                        <th scope="col">Tổng số lượng</th>
                                        <th scope="col">Tổng số tiền</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Thời gian tạo</th>
                                        <th scope="col" width="210"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($imports as $item)
                                    <tr class="has-link">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input position-static m-0" type="checkbox" value="{{ $loop->index + 1 }}" id="blankCheckbox">
                                            </div>
                                        </td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->supplier->name ?? 'Chưa xác định!' }}</td>
                                        <td>{{ $item->employee->name ?? 'Chưa xác định!' }}</td>
                                        <td class="text-center">{{ $item->total_quantity }}</td>
                                        <td class="text-center">{{ format_price($item->total_price) }}</td>
                                        <td class="text-center">{{ $item->status }}</td>
                                        <td class="text-center">{{ $item->created_at }}</td>
                                        <td class="disable-link text-right">
                                            <a href="{{ route('imports.print', $item->id) }}" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-print"></i></a>
                                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="7">Không có phiếu nhập nào.</td></tr>
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
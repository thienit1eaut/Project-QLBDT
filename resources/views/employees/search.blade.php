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
                            <h3 class="card-title float-left m-0 font-weight-bold" style="font-size: 18px;">Danh sách nhân viên</h3>
                            <div class="card-group-button">
                                <a href="#" class="btn btn-primary mr-1" title="Tìm kiếm">Tìm kiếm</a>
                                <a href="{{ route('employee.create') }}" class="btn btn-primary" title="Thêm mới">Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body p-0 table-responsive text-nowrap">
                            <table class="table mb-0 card-table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã nhân viên</th>
                                        <th scope="col">Tên nhân viên</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Chức vụ</th>
                                        <th scope="col" class="text-center">Trạng thái</th>
                                        <th scope="col" class="text-center">Kích hoạt</th>
                                        <th scope="col" width="210"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($listdata as $itememployee)
                                    <tr class="has-link" data-url="{{ route('employee.show', $itememployee->id) }}">
                                        <td style="cursor: pointer;">{{ $itememployee->employee_code }}</td>
                                        <td style="cursor: pointer;">{{ $itememployee->name }}</td>
                                        <td style="cursor: pointer;">{{ $itememployee->sdt }}</td>
                                        <td style="cursor: pointer;">{{ $itememployee->email }}</td>
                                        <td style="cursor: pointer;">{{ $itememployee->address }}</td>
                                        <td style="cursor: pointer;">{{ $itememployee->position }}</td>
                                        <td style="cursor: pointer;" class="text-center">{{ $itememployee->status }}</td>
                                        <td style="cursor: pointer;" class="text-center">{{ $itememployee->act ? '✅' : '❌' }}</td>
                                        <td class="disable-link text-right">
                                            <a href="{{ route('employee.show', $itememployee->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('employee.edit', $itememployee->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('employee.destroy', $itememployee->id) }}" method="POST" style="display:inline">
                                                @csrf 
                                                @method('DELETE')
                                                <button onclick="return confirm('Xoá?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="7">Không có nhân viên nào.</td></tr>
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
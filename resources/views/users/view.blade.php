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
                            <h3 class="card-title float-left m-0 font-weight-bold" style="font-size: 18px;">Quản lý tài khoản</h3>
                            <div class="card-group-button">
                                <a href="#" class="btn btn-primary mr-1" title="Tìm kiếm">Tìm kiếm</a>
                                <a href="{{ route('register') }}" class="btn btn-primary" title="Thêm mới">Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body p-0 table-responsive text-nowrap">
                            <table class="table mb-0 card-table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Tên tài khoản</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Tên đăng nhập</th>
                                        <th scope="col" class="text-center">Quyền</th>
                                        <th scope="col" class="text-center">Ghi chú</th>
                                        <th scope="col" class="text-center">Kích hoạt</th>
                                        <th scope="col" width="210"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $item)
                                    <tr class="has-link">
                                        <td style="cursor: pointer;">{{ $item->name }}</td>
                                        <td style="cursor: pointer;">{{ $item->email }}</td>
                                        <td style="cursor: pointer;" class="text-center">{{ $item->username }}</td>
                                        <td style="cursor: pointer;" class="text-center">{{ $item->role->name }}</td>
                                        <td>{{ $item->note }}</td>
                                        <td style="cursor: pointer;" class="text-center">{{ $item->act ? '✅' : '❌' }}</td>
                                        <td class="disable-link text-right">
                                            <a href="{{ route('user.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('user.destroy', $item->id) }}" method="POST" style="display:inline">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá không?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="7">Không có nhà sản xuất nào.</td></tr>
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
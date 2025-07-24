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
                            <h3 class="card-title float-left m-0 font-weight-bold" style="font-size: 18px;">Danh sách sản phẩm</h3>
                            <div class="card-group-button">
                                <a href="#" class="btn btn-primary mr-1" title="Tìm kiếm">Tìm kiếm</a>
                                <a href="{{ route('product.create') }}" class="btn btn-primary" title="Thêm mới">Thêm mới</a>
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
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Nhà sản xuất</th>
                                        <th scope="col" class="text-center">Giá bán</th>
                                        <th scope="col" class="text-center">Số lượng</th>
                                        <th scope="col" class="text-center">Kích hoạt</th>
                                        <th scope="col" width="210"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($listdata as $itempro)
                                    <tr class="has-link">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input position-static m-0" type="checkbox" value="{{ $loop->index + 1 }}" id="blankCheckbox">
                                            </div>
                                        </td>
                                        <td>{{ $itempro->code }}</td>
                                        <td>{{ $itempro->name }}</td>
                                        <td>{{ $itempro->category->name ?? 'Chưa xác định!' }}</td>
                                        <td>{{ $itempro->supplier->name ?? 'Chưa xác định!' }}</td>
                                        <td class="text-center">{{ format_price($itempro->price) }}</td>
                                        <td class="text-center">{{ $itempro->quantity }}</td>
                                        <td class="text-center">{{ $itempro->act ? '✅' : '❌' }}</td>
                                        <td class="disable-link text-right">
                                            <a href="{{ route('product.show', $itempro->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('product.edit', $itempro->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('product.destroy', $itempro->id) }}" method="POST" style="display:inline">
                                                @csrf 
                                                @method('DELETE')
                                                <button onclick="return confirm('Bạn có chắc muốn xoá không?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="7">Không có sản phẩm nào.</td></tr>
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
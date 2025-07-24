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
                    <div class="row">
                        <div class="col-3 mb-4">
                            <div class="card item-cart-1">
                                <div class="card-header">
                                    <h4 class="card-title float-left m-0">ĐƠN HÀNG</h4>
                                </div>
                                <div class="card-body">
                                    <h2 class="title-body">{{ $totalOrders }}</h2>
                                    <small class="subtitle-body">Tổng số đơn hàng</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card item-cart-1">
                                <div class="card-header">
                                    <h4 class="card-title float-left m-0">SẢN PHẨM</h4>
                                </div>
                                <div class="card-body">
                                    <h2 class="title-body">{{ $totalProducts }}</h2>
                                    <small class="subtitle-body">Tổng số sản phẩm</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card item-cart-1">
                                <div class="card-header">
                                    <h4 class="card-title float-left m-0">NHÂN VIÊN</h4>
                                </div>
                                <div class="card-body">
                                    <h2 class="title-body">{{ $totalEmployees }}</h2>
                                    <small class="subtitle-body">Tổng số nhân viên</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card item-cart-1">
                                <div class="card-header">
                                    <h4 class="card-title float-left m-0">TÀI KHOẢN</h4>
                                </div>
                                <div class="card-body">
                                    <h2 class="title-body">{{ $totalUsers }}</h2>
                                    <small class="subtitle-body">Tổng số tài khoản</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card item-cart-1">
                                <div class="card-header">
                                    <h4 class="card-title float-left m-0">DANH MỤC</h4>
                                </div>
                                <div class="card-body">
                                    <h2 class="title-body">{{ $totalCategories }}</h2>
                                    <small class="subtitle-body">Tổng số danh mục</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card item-cart-1">
                                <div class="card-header">
                                    <h4 class="card-title float-left m-0">NHÀ CUNG CẤP</h4>
                                </div>
                                <div class="card-body">
                                    <h2 class="title-body">{{ $totalSuppliers }}</h2>
                                    <small class="subtitle-body">Tổng số nhà cung cấp</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
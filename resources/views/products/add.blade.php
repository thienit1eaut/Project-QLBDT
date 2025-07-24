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
                    <form id="form-submit-1" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title float-left m-0 font-weight-bold" style="font-size: 18px;">Thêm mới sản phẩm</h3>
                                <span class="float-right"><a type="button" class="btn btn-outline-secondary btn-sm" href="{{ route('product.view') }}"><span class="fa fa-angle-double-left" aria-hidden="true"></span> Quay lại</a></span>
                            </div>
                            <div class="card-body">
                                <div class="content-detail pb-3">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Thông tin</button>
                                        </li>
                                        <li>
                                            <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nội dung</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-sm-7 border-right">
                                                    <div class="form-group">
                                                        <label for="name[]">Tên sản phẩm <span class="required-label"> *</span></label>
                                                        <div class="autocomplete-control">
                                                            <input id="input_name" type="text" name="name" value="" class="form-control ">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="product_category[]">Danh mục sản phẩm</label>
                                                        <select id="select_product_category" name="id_category" class="form-control custom-select">
                                                            <option value="0">-- Chọn danh mục --</option>
                                                            @foreach($parentProducts as $cat)
                                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                            @endforeach    
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="product_category[]">Nhà sản xuất</label>
                                                        <select id="select_product_category" name="id_supplier" class="form-control custom-select">
                                                            <option value="0">-- Chọn nhà sản xuất --</option>
                                                            @foreach($parentSuppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                            @endforeach    
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label for="name[]">Giá bán <span class="required-label"> *</span></label>
                                                        <div class="autocomplete-control">
                                                            <input id="input_name" type="text" name="price" value="" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <label for="description[]">Mô tả ngắn</label>
                                                        <textarea class="form-control " id="textarea_description" name="short_content" rows="5"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description[]">Nội dung</label>
                                                        <textarea class="form-control " id="textarea_description" name="short_content" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('product.create') }}" class="btn btn-outline-secondary">Hủy</a>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
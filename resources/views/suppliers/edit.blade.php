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
                    <form id="form-submit-1" action="{{ route('supplier.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')

                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title float-left m-0">Thêm mới nhà sản xuất</h3>
                                <span class="float-right"><a type="button" class="btn btn-outline-secondary btn-sm" href="{{ route('supplier.view') }}"><span class="fa fa-angle-double-left" aria-hidden="true"></span> Quay lại</a></span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 border-right">
                                        <div class="form-group">
                                            <label for="name[]">Tên nhà sản xuất <span class="required-label"> *</span></label>
                                            <div class="autocomplete-control">
                                                <input id="input_name" type="text" name="name" value="{{ old('name', $supplier->name) }}" class="form-control ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description[]">Mô tả ngắn</label>
                                            <textarea class="form-control " id="textarea_description" name="short_content" rows="5">{{ old('short_content', $supplier->short_content) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-outline-secondary">Hủy</a>
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
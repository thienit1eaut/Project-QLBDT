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
                    <form id="form-submit-1" action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title float-left m-0 font-weight-bold" style="font-size: 18px;">Thêm mới nhân viên</h3>
                                <span class="float-right"><a type="button" class="btn btn-outline-secondary btn-sm" href="{{ route('employee.view') }}"><span class="fa fa-angle-double-left" aria-hidden="true"></span> Quay lại</a></span>
                            </div>
                            <div class="card-body">
                                <div class="content-detail">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Thông tin</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-sm-7 border-right">
                                                    <div class="form-group">
                                                        <label for="name[]">Tên nhân viên <span class="required-label"> *</span></label>
                                                        <div class="autocomplete-control">
                                                            <input id="input_name" type="text" name="name" value="{{ old('name') }}" class="form-control ">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email[]">Email <span class="required-label"> *</span></label>
                                                        <div class="autocomplete-control">
                                                            <input id="input_email" type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sdt[]">Số điện thoại <span class="required-label"> *</span></label>
                                                        <div class="autocomplete-control">
                                                            <input id="input_sdt" type="text" name="sdt" value="{{ old('sdt') }}" class="form-control ">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address[]">Địa chỉ <span class="required-label"> *</span></label>
                                                        <div class="autocomplete-control">
                                                            <input id="input_address" type="text" name="address" value="{{ old('address') }}" class="form-control ">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="position[]">Chức vụ <span class="required-label"> *</span></label>
                                                        <div class="autocomplete-control">
                                                            <input id="input_position" type="text" name="position" value="{{ old('position') }}" class="form-control ">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="hire_date[]">Ngày làm việc <span class="required-label"> *</span></label>
                                                        <div class="autocomplete-control">
                                                            <input id="input_hire_date" type="date" name="hire_date" value="{{ old('hire_date') }}" class="form-control ">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group ">
                                                        <label for="user_id[]">Tài khoản đăng nhập:</label>
                                                        <select id="select_product_category" name="user_id" class="form-control custom-select">
                                                            <option value="0">-- Chọn tài khoản --</option>
                                                            @foreach($listuser as $taikhoan)
                                                                <option value="{{ $taikhoan->id }}">{{ $taikhoan->name .' -- '. $taikhoan->username }}</option>
                                                            @endforeach    
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description[]">Ghi chú</label>
                                                        <textarea class="form-control " id="textarea_description" name="note" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('employee.create') }}" class="btn btn-outline-secondary mr-1">Hủy</a>
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
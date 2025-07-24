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
                    <form id="form-submit-1" action="{{ route('imports.store') }}" method="POST" enctype="multipart/form-data">
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title float-left m-0 font-weight-bold" style="font-size: 18px;">Tạo mới phiếu nhập sản phẩm</h3>
                                <span class="float-right"><a type="button" class="btn btn-outline-secondary btn-sm" href="{{ route('imports.index') }}"><span class="fa fa-angle-double-left" aria-hidden="true"></span> Quay lại</a></span>
                            </div>
                            <div class="card-body">
                                <div class="content-detail pb-3">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Thông tin</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-sm-6 border-right">
                                                    <div class="form-group">
                                                        <label for="name[]">Nhân viên tạo đơn nhập: <span class="required-label"> *</span></label>
                                                        <div class="autocomplete-control">
                                                            <input id="input_name" type="text" name="" value="{{ $employee->name }}" class="form-control" readonly>
                                                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="product_supplier[]">Nhà cung cấp:</label>
                                                        <select id="select_product_supplier" name="supplier_id" class="form-control custom-select">
                                                            @foreach($suppliers as $sup)
                                                                <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                                            @endforeach   
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="product_list[]">Chọn sản phẩm:</label>
                                                        <div class="d-flex align-items-center">
                                                            <select id="select_product_list" name="products[1][product_id]" class="form-control custom-select">
                                                                @foreach($products as $prod)
                                                                    <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                                                                @endforeach   
                                                            </select>
                                                            <button type="button" id="btn-add-product" class="btn btn-primary ml-2">Chọn</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div id="product-list">
                                                        
                                                    </div>
                                                    <div id="product-total-price" class="pt-3 d-flex align-items-center justify-content-start" style="width: 80%;">
                                                        <span class="font-weight-bold" style="font-size: 15px;">Tổng tiền: </span>
                                                        <span id="num-total-price" class="ml-2">0.0 đ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tạo hóa đơn nhập</button>
                                <a href="{{ route('imports.create') }}" class="btn btn-outline-secondary ml-1">Hủy</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('specificpagescripts')

<script type="text/javascript">
$(document).ready(function () {
    let productIndex = 0;
    let productCount = 0;

    // Danh sách sản phẩm đã thêm
    const addedProductIds = new Set();

    // Sự kiện khi bấm nút "Chọn"
    $('#btn-add-product').click(function () {
        const selectedOption = $('#select_product_list option:selected');
        const productId = selectedOption.val();
        const productName = selectedOption.text();

        if (!productId) return;

        // Kiểm tra trùng sản phẩm
        if (addedProductIds.has(productId)) {
            alert("Sản phẩm đã được thêm.");
            return;
        }

        addedProductIds.add(productId);
        productIndex++;
        productCount++;

        const html = `
        <div class="item-product-sl mb-2 mt-3 d-flex align-items-center" data-index="${productIndex}" data-product-id="${productId}">
            <div class="stt-pro-add font-weight-bold" style="width: 10%; font-size: 15px;">SP-${productCount}</div>
            <div class="" style="width: 70%">
                <input type="text" value="${productName}" class="form-control" readonly>
                <input type="hidden" name="products[${productIndex}][product_id]" value="${productId}">
                <div class="d-flex align-items-center my-2">
                    <input type="number" name="products[${productIndex}][quantity]" class="product-quantity form-control mr-2" placeholder="Số lượng" value="1" min="1">
                    <input type="number" step="0.01" name="products[${productIndex}][import_price]" class="product-price form-control" placeholder="Giá nhập" value="0">
                </div>
            </div>
            <div style="width: 20%">
                <button type="button" class="btn btn-danger ml-3 btn-delete-product">Xóa</button>
            </div>
        </div>`;

        $('#product-list').append(html);
        updateTotalPrice();
    });

    // Xử lý khi xóa sản phẩm
    $('#product-list').on('click', '.btn-delete-product', function () {
        const container = $(this).closest('.item-product-sl');
        const productId = container.data('product-id');

        addedProductIds.delete(productId);
        container.remove();
        updateTotalPrice();
    });

    // Cập nhật tổng tiền khi thay đổi số lượng hoặc giá
    $('#product-list').on('input', '.product-quantity, .product-price', function () {
        updateTotalPrice();
    });

    function updateTotalPrice() {
        let total = 0;

        $('#product-list .item-product-sl').each(function () {
            const quantity = parseFloat($(this).find('.product-quantity').val()) || 0;
            const price = parseFloat($(this).find('.product-price').val()) || 0;
            total += quantity * price;
        });

        $('#num-total-price').text(total.toLocaleString('vi-VN') + ' đ');
    }
});
</script>

@endsection
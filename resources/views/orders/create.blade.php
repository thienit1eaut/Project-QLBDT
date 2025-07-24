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
                    <form id="form-submit-1" action="{{ route('orders.store') }}" method="POST">
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Tạo đơn hàng bán</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- Thông tin khách hàng --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tên khách hàng <span class="text-danger">*</span></label>
                                            <input type="text" name="customer_name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input type="text" name="customer_phone" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Địa chỉ</label>
                                            <input type="text" name="customer_address" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Ghi chú</label>
                                            <textarea name="note" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>

                                    {{-- Chọn sản phẩm --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Chọn sản phẩm</label>
                                            <div class="d-flex">
                                                <select id="select-product" class="form-control">
                                                    <option value="">-- Chọn sản phẩm --</option>
                                                    @foreach ($products as $prod)
                                                        <option value="{{ $prod->id }}" data-price="{{ $prod->price }}">{{ $prod->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" id="btn-add-product" class="btn btn-primary ml-2">Thêm</button>
                                            </div>
                                        </div>

                                        <div id="product-list" class="mt-3"></div>

                                        <div class="d-flex justify-content-end mt-3">
                                            <h5>Tổng tiền: <span id="total-price">0 đ</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success">Tạo đơn hàng</button>
                                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Hủy</a>
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
        let index = 0;
        let total = 0;

        function formatPrice(value) {
            return new Intl.NumberFormat('vi-VN').format(value) + ' đ';
        }

        function recalculateTotal() {
            total = 0;
            $('.item-product').each(function () {
                const qty = parseFloat($(this).find('.product-quantity').val()) || 0;
                const price = parseFloat($(this).find('.product-price').val()) || 0;
                total += qty * price;
            });
            $('#total-price').text(formatPrice(total));
        }

        $('#btn-add-product').click(function () {
            const selected = $('#select-product option:selected');
            const productId = selected.val();
            const productName = selected.text();
            const unitPrice = selected.data('price');

            if (!productId) {
                alert('Vui lòng chọn sản phẩm');
                return;
            }

            // Kiểm tra đã chọn chưa
            if ($(`#product-${productId}`).length > 0) {
                alert('Sản phẩm đã được thêm');
                return;
            }

            const html = `
                <div class="item-product mb-2" id="product-${productId}">
                    <input type="hidden" name="products[${index}][product_id]" value="${productId}">
                    <div class="d-flex align-items-center">
                        <div style="width: 40%">${productName}</div>
                        <input type="number" name="products[${index}][quantity]" class="form-control product-quantity mx-2" placeholder="Số lượng" min="1" value="1" style="width: 20%">
                        <input type="number" name="products[${index}][unit_price]" class="form-control product-price mx-2" placeholder="Đơn giá" value="${unitPrice}" style="width: 25%">
                        <button type="button" class="btn btn-danger btn-remove">Xóa</button>
                    </div>
                </div>
            `;

            $('#product-list').append(html);
            index++;
            recalculateTotal();
        });

        $('#product-list').on('input', '.product-quantity, .product-price', function () {
            recalculateTotal();
        });

        $('#product-list').on('click', '.btn-remove', function () {
            $(this).closest('.item-product').remove();
            recalculateTotal();
        });
    });
</script>

@endsection

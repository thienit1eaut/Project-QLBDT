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

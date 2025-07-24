<?php
if (!function_exists('format_price')) {
    /**
     * Định dạng giá sản phẩm: thêm dấu phân cách, bỏ phần thập phân nếu không cần
     *
     * @param float|int|null $price
     * @param string $suffix
     * @return string
     */
    function format_price($price, $suffix = '₫')
    {
        if ($price === null || $price == 0.0) return 'Liên hệ';
        
        return number_format($price, 0, ',', '.') . ' ' . $suffix;
    }
}

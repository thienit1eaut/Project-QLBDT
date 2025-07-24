<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model {

    protected $table = 'order_detail';

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'unit_price', 'into_money', 'note'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = 'orders';

    protected $fillable = [
        'order_code', 'employee_id', 'customer_name', 'customer_phone', 'customer_address', 'total_quantity', 'total_price', 'status', 'act', 'note'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }
}

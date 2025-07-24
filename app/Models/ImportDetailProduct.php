<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportDetailProduct extends Model
{

    protected $table = 'import_detail_product';

    protected $fillable = ['import_id', 'product_id', 'quantity', 'import_price', 'note'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function import()
    {
        return $this->belongsTo(ImportProduct::class, 'import_id');
    }
}

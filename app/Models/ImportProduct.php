<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportProduct extends Model {

    protected $table = 'import_products';

    protected $fillable = [
        'supplier_id', 'employee_id', 'total_quantity', 'total_price', 'status', 'note', 'code'
    ];

    public function importDetails()
    {
        return $this->hasMany(ImportDetailProduct::class, 'import_id');
    }

    public function details()
    {
        return $this->hasMany(ImportDetailProduct::class, 'import_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}

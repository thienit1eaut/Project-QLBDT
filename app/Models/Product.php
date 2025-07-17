<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'img', 'id_category', 'id_supplier', 'price', 'price_sale', 'quantity','status', 'short_content', 'content','parent', 'ord', 'act', 'home', 'code'
    ];
}

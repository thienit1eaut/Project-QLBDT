<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'img', 'short_content', 'content','parent', 'ord', 'act', 'home','code'
    ];
}

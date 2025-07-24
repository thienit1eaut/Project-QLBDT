<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'user_id', 'employee_code', 'name', 'email', 'sdt', 'address', 'position', 'department', 'hire_date', 'act', 'status', 'note', 'img', 'lib_img'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chucvu extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_chuc_vu',
        'hoat_dong',
    ];

}

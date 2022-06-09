<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaichuongtrinh extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_chuong_trinh',
        'hoat_dong',
    ];
}

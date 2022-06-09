<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nguoithuchien extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_nguoi_thuc_hien',
        'hoat_dong'
    ];
}

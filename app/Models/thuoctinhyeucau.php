<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thuoctinhyeucau extends Model
{
    use HasFactory;
    protected $fillable =[
      'ten_thuoc_tinh',
      'kieu_thuoc_tinh',
      'noi_dung_thuoc_tinh',
    ];
}

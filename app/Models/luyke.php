<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class luyke extends Model
{
    use HasFactory;
    protected $fillable = [
      'id_don_vi',
      'luy_ke_hang_tuan',
      'tuan',
      'thang',
      'nam',
    ];
}

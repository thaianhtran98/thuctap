<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaingay extends Model
{
    use HasFactory;

    protected $fillable =[
        'id_yc',
        'ngaytiepnhan',
        'ngaygiaoviec',
        'ngayhoanthanh',
        'ngayhostfix',
        'ngayhoanthanhdukien',
    ];
}

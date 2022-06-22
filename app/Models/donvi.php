<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donvi extends Model
{
    use HasFactory;

    protected $fillable=[
        'ten_don_vi',
        'luy_ke_dau_ky',
        'uu_tien',
        'hoat_dong',
    ];

    public function donvi_kybaocao(){
        return $this->hasMany(kybaocao::class , 'id_don_vi' , 'id');
    }

}

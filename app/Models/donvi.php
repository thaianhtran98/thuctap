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

    public function luyke_donvi(){
        return $this->hasMany(luyke::class, 'id_don_vi', 'id')
            ->orderByDesc('tuan')
            ->orderByDesc('nam');
    }

    public function luyke_donvi_tuan($tuan,$nam){
        return $this->hasMany(luyke::class, 'id_don_vi', 'id')
            ->where('tuan',$tuan)
            ->where('nam',$nam)->first();
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class yeucauton extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_loai_chuong_trinh',
        'id_don_vi',
        'noi_dung_yc',
        'ten_yeu_cau',
        'trang_thai',
    ];

    public function yc_dv()
    {
        return $this->hasOne(donvi::class, 'id', 'id_don_vi');
    }

    public function yc_ct()
    {
        return $this->hasOne(loaichuongtrinh::class, 'id', 'id_loai_chuong_trinh');
    }
}

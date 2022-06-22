<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kybaocao extends Model
{
    use HasFactory;

    protected $fillable = [
        'tuan',
        'id_don_vi',
        'tongyeucautrongtuan',
        'luyke',
        'yeucauconton',
        'yeucaudahoanthanh',
        'yeucaudahostfix',
        'yeucaudangthuchien',
        'nam',
    ];

    public function kybaocao_donvi(){

    }

}

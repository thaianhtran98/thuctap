<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chitietyeucau extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_yc',
        'id_nguoithuchien',
        'id_chucvu',
    ];

    public function ct_nth(){
        return $this->hasOne(nguoithuchien::class, 'id', 'id_nguoithuchien');
    }

    public function ct_chucvu(){
        return $this->hasOne(chucvu::class, 'id', 'id_chucvu');
    }


}

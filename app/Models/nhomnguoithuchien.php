<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhomnguoithuchien extends Model
{
    use HasFactory;

    protected $fillable =[
        'ten_nhom',
        'hoat_dong',
    ];
}

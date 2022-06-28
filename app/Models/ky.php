<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ky extends Model
{
    use HasFactory;

    protected $fillable = [
        'tuan',
        'nam',
        'tungay',
        'denngay',
        'chot',
    ];
}

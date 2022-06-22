<?php

namespace App\Service;

use App\Models\donvi;
use App\Models\kybaocao;
use App\Models\luyke;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BaocaoService
{
    public function baocaoyeucau(){
        return donvi::where('hoat_dong',1)->orderByDesc('uu_tien')->get();
    }

}

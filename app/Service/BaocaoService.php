<?php

namespace App\Service;

use App\Models\donvi;
use App\Models\luyke;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BaocaoService
{


    public function baocaoyeucau(){
        return DB::table('yeucautrongtuan')->orderBy('uu_tien')->get();
    }

}

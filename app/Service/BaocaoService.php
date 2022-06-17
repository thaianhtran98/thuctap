<?php

namespace App\Service;

use App\Models\donvi;
use App\Models\luyke;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BaocaoService
{
//
//    public function gettuantheonamhientai($year){
//        return luyke::DISTINCT()->select('tuan')->orderBy('tuan')->where('nam',$year)->get();
//    }
//    public function getthangtheonamhientai($year){
//        return luyke::DISTINCT()->select('thang')->orderBy('thang')->where('nam',$year)->get();
//    }
//    public function getnam(){
//        return luyke::DISTINCT()->select('nam')->orderBy('nam')->get();
//    }

    public function baocaoyeucau(){
        return DB::table('baocaoyeucaudonvi')->orderBy('uu_tien')->get();
    }

}

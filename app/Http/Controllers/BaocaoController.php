<?php

namespace App\Http\Controllers;

use App\Service\BaocaoService;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class BaocaoController extends Controller
{

    protected $baocaoservice;

    public function __construct(BaocaoService $baocaoService)
    {
        $this->baocaoservice = $baocaoService;
    }

    public function index(){
        $year = date('Y' ,time());
        $month = date('m' ,time());
        $week = date('W' ,time());
        return view('baocao.baocao',[
            'title'=>'Báo Cáo',
            'tuan'=>$week,
            'thang'=>$month,
            'nam'=>$year,
            'donvi'=>$this->baocaoservice->baocaoyeucau(),
        ]);
    }

}

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
        return view('baocao.baocao',[
            'title'=>'Báo Cáo',
            'donvi'=>$this->baocaoservice->baocaoyeucau(),
        ]);
    }

    public function kybaocao(){
        return view('baocao.kybaocao',[
            'title'=>'Kỳ Báo Cáo',
        ]);
    }

}

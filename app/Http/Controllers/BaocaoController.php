<?php

namespace App\Http\Controllers;

use App\Models\ky;
use App\Service\BaocaoService;
use App\Service\DonviService;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class BaocaoController extends Controller
{

    protected $baocaoservice;
    protected $donviservice;

    public function __construct(BaocaoService $baocaoService,DonviService $donviService)
    {
        $this->baocaoservice = $baocaoService;
        $this->donviservice = $donviService;
    }

    public function index(){
        return view('baocao.index_baocao',[
            'title'=>'Báo Cáo',
            'ky'=>$this->baocaoservice->getky(),
        ]);
    }

    public function kybaocao(){
        $date = date('Y');
        $mw = (string)$date.'-12-31';
        $week  = (int)date('W', strtotime($mw));

        return view('baocao.kybaocao',[
            'title'=>'Kỳ Báo Cáo',
            'max_tuan'=>$week,
            'nam_now'=>date('Y'),
            'ky_exist'=>$this->baocaoservice->getky_year($date),
            'ky'=>$this->baocaoservice->getky(),
        ]);
    }

    public function them_kybaocao(Request $request){
        $this->baocaoservice->create($request);
        return redirect()->back();
    }


    public function xembaocao(ky $ky){
        return view('baocao.baocao',[
            'title'=>'Báo Cáo',
            'ky_dang_baocao'=>$ky,
            'nams'=>$this->baocaoservice->getnam(),
            'ky'=>$this->baocaoservice->getky(),
            'yeucau_tiepnhan'=>$this->baocaoservice->get_yc_tiepnhan($ky),
            'yeucau_dangcode'=>$this->baocaoservice->get_yc_dangcode($ky),
            'yeucau_hoanthanh'=>$this->baocaoservice->get_yc_hoanthanh($ky),
            'yeucau_hostfix'=>$this->baocaoservice->get_yc_hostfix($ky),
            'luyke_ky'=>$this->baocaoservice->get_luyke_ky($ky),
            'donvi'=>$this->donviservice->getdonviactive(),
        ]);
    }

    public function load_ky(Request $request){
        $result= $this->baocaoservice->getky_year($request->input('nam'));

        if ($result===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'kys'=>$result
            ]);
    }

    public function chot_ky(ky $ky,Request $request){
        $result= $this->baocaoservice->chot_ky($ky,$request);

        if ($result===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
            ]);
    }

    public function destroy(Request $request){
        return $this->baocaoservice->destroy_ky($request);
    }


}

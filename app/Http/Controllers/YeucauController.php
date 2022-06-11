<?php

namespace App\Http\Controllers;

use App\Models\yeucauton;
use App\Service\DonviService;
use App\Service\LoaichuongtrinhService;
use App\Service\NguoithuchienService;
use App\Service\YeucauService;
use Illuminate\Http\Request;

class YeucauController extends Controller
{
    protected $donviservice;
    protected $chuongtrinhservice;
    protected $yeucauservice;
    protected $nguoithuchienservice;

    public function __construct(NguoithuchienService $nguoithuchienService, DonviService $donviService, LoaichuongtrinhService $loaichuongtrinhService, YeucauService $yeucauService)
    {
        $this->donviservice = $donviService;
        $this->chuongtrinhservice = $loaichuongtrinhService;
        $this->yeucauservice = $yeucauService;
        $this->nguoithuchienservice = $nguoithuchienService;
    }

    public function add_yc(){
        return view('yeucau.themyeucau', [
            'title' => 'Thêm Yêu Cầu',
            'dvs' => $this->donviservice->getdonviactive(),
            'cts' => $this->chuongtrinhservice->getlctactive(),
            'nvs' => $this->nguoithuchienservice->getnhanvienactive(),
        ]);
    }

    public function store_yc(Request $request)
    {
        $result= $this->yeucauservice->create($request);
        if ($result===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'id_yc'=>$result
            ]);
    }

    public function update_pagethem(yeucauton $yeucauton, Request $request)
    {
        $result= $this->yeucauservice->update_yc($yeucauton,$request);
        if ($result==false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
            ]);
    }

    public function store_thuoctinh_yc(Request $request){
        $result= $this->yeucauservice->create_thuoctinh($request);
        if ($result===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'id_yc'=>$result
            ]);
    }

    public function list_yc()
    {
        return view('yeucau.danhsachyeucau', [
            'title' => 'Thêm Yêu Cầu',
            'ycs' => $this->yeucauservice->getyeucau(),
        ]);
    }



}

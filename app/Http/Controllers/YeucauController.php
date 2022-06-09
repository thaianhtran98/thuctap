<?php

namespace App\Http\Controllers;

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
        $this->yeucauservice->create($request);
        return redirect()->back();
    }

    public function list_yc()
    {
        return view('yeucau.danhsachyeucau', [
            'title' => 'Thêm Yêu Cầu',
            'ycs' => $this->yeucauservice->getyeucau(),
        ]);
    }

}

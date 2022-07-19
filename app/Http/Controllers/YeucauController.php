<?php

namespace App\Http\Controllers;

use App\Models\yeucauton;
use App\Service\ChucvuService;
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
    protected $chucvuservice;

    public function __construct(ChucvuService $chucvuService,NguoithuchienService $nguoithuchienService,
                                DonviService $donviService, LoaichuongtrinhService $loaichuongtrinhService,
                                YeucauService $yeucauService)
    {
        $this->donviservice = $donviService;
        $this->chuongtrinhservice = $loaichuongtrinhService;
        $this->yeucauservice = $yeucauService;
        $this->nguoithuchienservice = $nguoithuchienService;
        $this->chucvuservice = $chucvuService;
    }

    public function add_yc(){
        return view('yeucau.themyeucau', [
            'title' => 'Thêm Yêu Cầu',
            'dvs' => $this->donviservice->getdonviactive(),
            'cts' => $this->chuongtrinhservice->getlctactive(),
            'nvs' => $this->nguoithuchienservice->getnhanvienactive(),
            'chucvues'=>$this->chucvuservice->getchucvu_active(),
            'min_ngaytiepnhan'=>$this->yeucauservice->get_min_ngaytiepnhan()
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

    public function store_tam_yc(Request $request)
    {
        $result= $this->yeucauservice->create_tam($request);
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

    public function update_pagethem(Request $request)
    {
        $yeucauton = yeucauton::where('id',$request->input('id_yc'))->first();
        $result= $this->yeucauservice->luu_lai_yc($yeucauton,$request);
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
                'id_thuoctinh'=>$result->id
            ]);
    }

    public function edit_thuoctinh_yc(Request $request){
        $result= $this->yeucauservice->edit_thuoctinh($request);
        if ($result===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'id_thuoctinh'=>$result->id
            ]);
    }

    public function list_yc()
    {
        return view('yeucau.danhsachyeucau', [
            'title' => 'Yêu Cầu',
            'ycs' => $this->yeucauservice->getyeucau(),
            'disable_xoa'=>$this->yeucauservice->get_min_ngaytiepnhan(),
        ]);
    }

    public function destroy(Request $request){
        $result= $this->yeucauservice->destroy($request);
        if ($result===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
            ]);
    }

    public function destroy_yck(Request $request){
        return $this->yeucauservice->destroy_yck($request);
    }

    public function edit_yeucau(Request $request,yeucauton $yeucauton){
        return view('yeucau.edityeucau', [
            'title' => 'Cập Nhật Yêu Cầu'.$yeucauton->ten_yeu_cau,
            'yeucau'=>$yeucauton,
            'dvs' => $this->donviservice->getdonviactive(),
            'cts' => $this->chuongtrinhservice->getlctactive(),
            'nvs' => $this->nguoithuchienservice->getnhanvienactive(),
            'chucvues'=>$this->chucvuservice->getchucvu_active(),
            'chitiet'=>$this->yeucauservice->getchitiet($yeucauton->id),
            'loaingay'=>$this->yeucauservice->getloaingay($yeucauton->id),
            'yeucaukhac'=>$this->yeucauservice->getyeucaukhac($yeucauton->id)
        ]);
    }

    public function store_edit_yeucau(Request $request){
        $yeucauton = yeucauton::where('id',$request->input('id_yc'))->first();

        $result =  $this->yeucauservice->update_yc($yeucauton,$request);
        if ($result==false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
            ]);
    }
//
//    public function search_yc_with_date(Request $request){
//        $result =  $this->yeucauservice->search_yc_with_date($request);
//        if ($result==false)
//            return response()->json([
//                'error'=> true,
//            ]);
//        else
//            return response()->json([
//                'error'=> false,
//                'ycs'=>$result
//            ]);
//    }

}

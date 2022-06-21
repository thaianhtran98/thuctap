<?php

namespace App\Http\Controllers;

use App\Models\donvi;
use App\Service\DonviService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    protected $donviservice;

    public function __construct(DonviService $donviService)
    {
        $this->donviservice = $donviService;
    }

    public function index(){
        $dto = new \DateTime();
        $dto->setISODate(2022, 25);
        $ngaydau = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ngaycuoi = $dto->format('Y-m-d');

        return view('home',[
           'title'=>'HOME',
            's'=>$ngaydau,
            'e'=>$ngaycuoi
        ]);
    }

//    public function list_dv(){
//        return view('donvi.danhsachdonvi',[
//            'title'=>'Danh Sách Đơn Vị',
//            'donvi'=>$this->donviservice->getdonvi(),
//        ]);
//    }

    public function add_dv(){
        return view('donvi.themdonvi',[
            'title'=>'Thêm Đơn Vị',
            'donvi'=>$this->donviservice->getdonvi(),
        ]);
    }

    public function store_dv(Request $request){
        $this->donviservice->create($request);
        return redirect()->back();
    }

    public function store_dv_ajax(Request $request){
        $result = $this->donviservice->create_ajax($request);
        if ($result===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
                'lct'=>$result
            ]);
    }

    public function change_active(donvi $donvi)
    {
        $result = $this->donviservice->change_active($donvi);
        if ($result===false)
            return response()->json([
                'error'=> true,
                'active'=>$donvi->hoat_dong
            ]);
        else
            return response()->json([
                'error'=> false,
                'active'=>$donvi->hoat_dong,
                'id'=>$donvi->id
            ]);
    }

    public function edit_dv(donvi $donvi , Request $request)
    {
        return $this->donviservice->edit($donvi,$request);
    }

    public function destroy(Request $request){
        return $this->donviservice->destroy($request);
    }

}

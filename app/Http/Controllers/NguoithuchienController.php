<?php

namespace App\Http\Controllers;

use App\Models\nguoithuchien;
use App\Service\ChucvuService;
use App\Service\NguoithuchienService;
use Illuminate\Http\Request;

class NguoithuchienController extends Controller
{
    protected $nthservice;
    protected $chucvuservice;

    public function __construct(NguoithuchienService $donviService,ChucvuService $chucvuService)
    {
        $this->nthservice = $donviService;
        $this->chucvuservice = $chucvuService;
    }


//    public function list_nv(){
//        return view('nhanvien.danhsachnhanvien',[
//            'title'=>'Nhân Viên',
//            'nvs'=>$this->nthservice->getnhanvien(),
//        ]);
//    }

    public function add_nv(){
        return view('nhanvien.themnhanvien',[
            'title'=>'Nhân Viên & Chức Vụ',
            'nvs'=>$this->nthservice->getnhanvien(),
            'cvs'=>$this->chucvuservice->getchucvu()
        ]);
    }

    public function store_nv(Request $request){
        $result = $this->nthservice->create($request);
        if ($result===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
            ]);
    }

    public function change_active(nguoithuchien $nguoithuchien)
    {
        $result = $this->nthservice->change_active($nguoithuchien);
        if ($result===false)
            return response()->json([
                'error'=> true,
                'active'=>$nguoithuchien->hoat_dong,
            ]);
        else
            return response()->json([
                'error'=> false,
                'active'=>$nguoithuchien->hoat_dong,
                'id'=>$nguoithuchien->id
            ]);
    }

    public function edit_nv(nguoithuchien $nguoithuchien , Request $request)
    {
        return $this->nthservice->edit($nguoithuchien,$request);
    }

    public function destroy(Request $request){
        return $this->nthservice->destroy($request);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\loaichuongtrinh;
use App\Service\LoaichuongtrinhService;
use Illuminate\Http\Request;

class LoaichuongtrinhController extends Controller
{
    protected $lctservice;

    public function __construct(LoaichuongtrinhService $loaichuongtrinhService)
    {
        $this->lctservice = $loaichuongtrinhService;
    }


    public function list_ct(){
        return view('loaichuongtrinh.danhsachloaichuongtrinh',[
            'title'=>'Loại Chương Trình',
            'cts'=>$this->lctservice->getlct(),
        ]);
    }

    public function add_ct(){
        return view('loaichuongtrinh.themloaichuongtrinh',[
            'title'=>'Loại Chương Trình',
            'cts'=>$this->lctservice->getlct(),
        ]);
    }

    public function store_ct(Request $request){
        $this->lctservice->create($request);
        return redirect()->back();
    }
    public function store_ct_ajax(Request $request){
        $result = $this->lctservice->create_ajax($request);
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

    public function change_active(loaichuongtrinh $loaichuongtrinh)
    {
        $result = $this->lctservice->change_active($loaichuongtrinh);
        if ($result===false)
            return response()->json([
                'error'=> true,
                'active'=>$loaichuongtrinh->hoat_dong
            ]);
        else
            return response()->json([
                'error'=> false,
                'active'=>$loaichuongtrinh->hoat_dong,
                'id'=>$loaichuongtrinh->id
            ]);
    }

    public function edit_ct(loaichuongtrinh $loaichuongtrinh , Request $request)
    {
        return $this->lctservice->edit($loaichuongtrinh,$request);
    }

    public function destroy(Request $request){
        return $this->lctservice->destroy($request);
    }
}

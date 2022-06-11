<?php

namespace App\Http\Controllers;

use App\Models\chucvu;
use App\Service\ChucvuService;
use Illuminate\Http\Request;

class ChucvuController extends Controller
{
    protected $chucvuservice;

    public function __construct(ChucvuService $chucvuService)
    {
        $this->chucvuservice=$chucvuService;
    }

    public function store_cv(Request $request){
        $result = $this->chucvuservice->create($request);
        if ($result===false)
            return response()->json([
                'error'=> true,
            ]);
        else
            return response()->json([
                'error'=> false,
            ]);
    }

    public function change_active(chucvu $chucvu)
    {
        $result = $this->chucvuservice->change_active($chucvu);
        if ($result===false)
            return response()->json([
                'error'=> true,
                'active_cv'=>$chucvu->hoat_dong,
            ]);
        else
            return response()->json([
                'error'=> false,
                'active_cv'=>$chucvu->hoat_dong,
                'id_cv'=>$chucvu->id
            ]);
    }

    public function edit_cv(chucvu $chucvu , Request $request)
    {
        return $this->chucvuservice->edit($chucvu,$request);
    }

    public function destroy(Request $request){
        return $this->chucvuservice->destroy($request);
    }

}

<?php

namespace App\Service;

use App\Models\donvi;
use Illuminate\Support\Facades\Session;

class DonviService
{

    public function create($request){
        try{
            donvi::create([
                'ten_don_vi' => (string)$request->input('name'),
                'luy_ke_dau_ky' => (integer)$request->input('luyke'),
                'uu_tien' => (int)$request->input('uutien'),
                'hoat_dong' => (int)$request->input('active'),
            ]);
            Session::flash('success', 'Thêm  thành công ' . $request->input('name'));
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function getdonvi(){
        return donvi::orderByDesc('uu_tien')->get();
    }

    public function getdonviactive(){
        return donvi::where('hoat_dong',1)->orderByDesc('uu_tien')->get();
    }

    public function change_active($donvi){
        try {
            if ((int)$donvi->hoat_dong == 1){
                $donvi->hoat_dong = 0;
                $donvi->save();
                return true;
            }else{
                $donvi->hoat_dong = 1;
                $donvi->save();
                return true;
            }
        }catch (\Exception $err){
//            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function edit($donvi,$request){
        try {
            $donvi->ten_don_vi = $request->input('ten');
            $donvi->luy_ke_dau_ky = $request->input('luyke');
            $donvi->uu_tien = $request->input('uutien');
            $donvi->save();
        }catch (\Exception $err){
//            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function destroy($request){
        try {
            $id = $request->input('id');
            $name = donvi::where('id', $id)->first();
//            $menutopic= Menu::find($id);
//            $menutopic->menutopic()->detach();
            $menu = donvi::where('id', $id)->first();
            Session::flash('success', 'Xóa thành công ' . $name->ten_don_vi);
            if($menu){
                donvi::where('id',$id)->delete();
            }

            return true;
        }catch (\Exception $err){
            Session::flash('error','Xóa thất bại');
            return false;
        }
    }

}

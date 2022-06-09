<?php

namespace App\Service;

use App\Models\loaichuongtrinh;
use Illuminate\Support\Facades\Session;

class LoaichuongtrinhService
{
    public function create($request)
    {
        try {
            loaichuongtrinh::create([
                'ten_chuong_trinh' => (string)$request->input('name'),
                'hoat_dong' => (int)$request->input('active'),
            ]);
            Session::flash('success', 'Thêm  thành công ' . $request->input('name'));
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function create_ajax($request)
    {
        try {
            if ($request->input('ten')==null){
                return false;
            }
            loaichuongtrinh::create([
                'ten_chuong_trinh' => (string)$request->input('ten'),
                'hoat_dong' => 1,
            ]);
            return loaichuongtrinh::where('ten_chuong_trinh',$request->input('ten'))->first();
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function getlct()
    {
        return loaichuongtrinh::orderBy('id')->get();
    }

    public function getlctactive()
    {
        return loaichuongtrinh::where('hoat_dong',1)->orderBy('id')->get();
    }

    public function change_active($loaichuongtrinh)
    {
        try {
            if ((int)$loaichuongtrinh->hoat_dong == 1) {
                $loaichuongtrinh->hoat_dong = 0;
                $loaichuongtrinh->save();
                return true;
            } else {
                $loaichuongtrinh->hoat_dong = 1;
                $loaichuongtrinh->save();
                return true;
            }
        } catch (\Exception $err) {
//            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function edit($loaichuongtrinh, $request)
    {
        try {
            $loaichuongtrinh->ten_chuong_trinh = $request->input('ten');
            $loaichuongtrinh->save();
        } catch (\Exception $err) {
//            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function destroy($request)
    {
        try {
            $id = $request->input('id');
            $nguoithuchien = loaichuongtrinh::where('id', $id)->first();
            Session::flash('success', 'Xóa thành công ' . $nguoithuchien->ten_chuong_trinh);
            if ($nguoithuchien) {
                loaichuongtrinh::where('id', $id)->delete();
            }

            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa thất bại');
            return false;
        }
    }
}

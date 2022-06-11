<?php

namespace App\Service;

use App\Models\chucvu;
use App\Models\nguoithuchien;
use Illuminate\Support\Facades\Session;

class ChucvuService
{
    public function create($request)
    {
        try {
            chucvu::create([
                'ten_chuc_vu' => (string)$request->input('ten_cv'),
                'hoat_dong' => (int)$request->input('hoat_dong'),
            ]);
            Session::flash('success', 'Thêm  thành công chức vụ ' . $request->input('ten_cv'));
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function getchucvu(){
        return chucvu::orderBy('id')->get();
    }

    public function getnhanvien()
    {
        return chucvu::orderBy('id')->get();
    }

    public function getnhanvienactive()
    {
        return chucvu::where('hoat_dong', 1)->orderBy('id')->get();
    }

    public function change_active($chucvu)
    {
        try {
            if ((int)$chucvu->hoat_dong == 1) {
                $chucvu->hoat_dong = 0;
                $chucvu->save();
                return true;
            } else {
                $chucvu->hoat_dong = 1;
                $chucvu->save();
                return true;
            }
        } catch (\Exception $err) {
//            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function edit($chucvu, $request)
    {
        try {
            $chucvu->ten_chuc_vu = (string)$request->input('ten');
            $chucvu->save();
        } catch (\Exception $err) {
            return false;
        }
    }

    public function destroy($request)
    {
        try {
            $id = $request->input('id');
            $chucvu = chucvu::where('id', $id)->first();
            Session::flash('success', 'Xóa thành công ' . $chucvu->ten_chuc_vu);
            if ($chucvu) {
                chucvu::where('id', $id)->delete();
            }

            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa thất bại');
            return false;
        }
    }

}

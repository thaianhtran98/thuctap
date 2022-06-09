<?php

namespace App\Service;

use App\Models\nguoithuchien;
use Illuminate\Support\Facades\Session;

class NguoithuchienService
{
    public function create($request)
    {
        try {
            nguoithuchien::create([
                'ten_nguoi_thuc_hien' => (string)$request->input('name'),
                'hoat_dong' => (int)$request->input('active'),
            ]);
            Session::flash('success', 'Thêm  thành công ' . $request->input('name'));
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function getnhanvien()
    {
        return nguoithuchien::orderBy('id')->get();
    }

    public function getnhanvienactive()
    {
        return nguoithuchien::where('hoat_dong', 1)->orderBy('id')->get();
    }

    public function change_active($nguoithuchien)
    {
        try {
            if ((int)$nguoithuchien->hoat_dong == 1) {
                $nguoithuchien->hoat_dong = 0;
                $nguoithuchien->save();
                return true;
            } else {
                $nguoithuchien->hoat_dong = 1;
                $nguoithuchien->save();
                return true;
            }
        } catch (\Exception $err) {
//            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function edit($nguoithuchien, $request)
    {
        try {
            $nguoithuchien->ten_nguoi_thuc_hien = $request->input('ten');
            $nguoithuchien->save();
        } catch (\Exception $err) {
//            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function destroy($request)
    {
        try {
            $id = $request->input('id');
            $nguoithuchien = nguoithuchien::where('id', $id)->first();
            Session::flash('success', 'Xóa thành công ' . $nguoithuchien->ten_nguoi_thuc_hien);
            if ($nguoithuchien) {
                nguoithuchien::where('id', $id)->delete();
            }

            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa thất bại');
            return false;
        }
    }
}

<?php

namespace App\Service;

use App\Models\lich_su_thao_tac;
use App\Models\nguoithuchien;
use Illuminate\Support\Facades\Session;

class NguoithuchienService
{
    public function create($request)
    {
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            nguoithuchien::create([
                'ten_nguoi_thuc_hien' => (string)$request->input('ten_nv'),
                'hoat_dong' => (int)$request->input('hoat_dong'),
            ]);
            Session::flash('success', 'Thêm  thành công nhân viên ' . $request->input('ten_nv'));

            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Thêm nhân viên mới',
                'mo_ta'=>'Tên nhân viên: ' . (string)$request->input('ten_nv')
                    . '<br> Hoạt động: '.(integer)$request->input('hoat_dong'),
            ]);

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
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            if ((int)$nguoithuchien->hoat_dong == 1) {
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Chỉnh sửa hoạt động nhân viên ',
                    'mo_ta'=>'Tên nhân viên: ' . $nguoithuchien->ten_nguoi_thuc_hien
                        . '<br> Hoạt động: Ngưng hoạt động',
                ]);
                $nguoithuchien->hoat_dong = 0;
                $nguoithuchien->save();
                return true;
            } else {
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Chỉnh sửa hoạt động nhân viên',
                    'mo_ta'=>'Tên nhân viên: ' . $nguoithuchien->ten_nguoi_thuc_hien
                        . '<br> Hoạt động: Hoạt động',
                ]);
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
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Chỉnh sửa tên nhân viên',
                'mo_ta'=>'Tên nhân viên: ' . $nguoithuchien->ten_nguoi_thuc_hien .' -> '. (string)$request->input('ten'),
            ]);
            $nguoithuchien->ten_nguoi_thuc_hien = (string)$request->input('ten');
            $nguoithuchien->save();
        } catch (\Exception $err) {
            return false;
        }
    }

    public function destroy($request)
    {
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
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

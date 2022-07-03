<?php

namespace App\Service;

use App\Models\chucvu;
use App\Models\lich_su_thao_tac;
use App\Models\nguoithuchien;
use Illuminate\Support\Facades\Session;

class ChucvuService
{

    public function create($request)
    {
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            chucvu::create([
                'ten_chuc_vu' => (string)$request->input('ten_cv'),
                'hoat_dong' => (int)$request->input('hoat_dong'),
            ]);
            Session::flash('success', 'Thêm  thành công chức vụ ' . $request->input('ten_cv'));

            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Thêm chức vụ mới',
                'mo_ta'=>'Tên chức vụ' . (string)$request->input('ten_cv')
                    . '<br> Hoạt động: '.(integer)$request->input('hoat_dong'),
            ]);

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

    public function getchucvu_active()
    {
        return chucvu::where('hoat_dong', 1)->orderBy('id')->get();
    }

    public function change_active($chucvu)
    {
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            if ((int)$chucvu->hoat_dong == 1) {
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Chỉnh sửa hoạt động chức vụ ',
                    'mo_ta'=>'Tên chức vụ' . $chucvu->ten_cv
                        . '<br> Hoạt động: Ngưng hoạt động',
                ]);
                $chucvu->hoat_dong = 0;
                $chucvu->save();
                return true;
            } else {
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Chỉnh sửa hoạt động chức vụ',
                    'mo_ta'=>'Tên chức vụ' . $chucvu->ten_cv
                        . '<br> Hoạt động: Hoạt động',
                ]);
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
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Chỉnh sửa tên chức vụ ',
                'mo_ta'=>'Tên chức vụ: ' . $chucvu->ten_cv .' -> '. (string)$request->input('ten'),
            ]);
            $chucvu->ten_chuc_vu = (string)$request->input('ten');
            $chucvu->save();
        } catch (\Exception $err) {
            return false;
        }
    }

//    public function destroy($request)
//    {
//        try {
//            $id = $request->input('id');
//            $chucvu = chucvu::where('id', $id)->first();
//            Session::flash('success', 'Xóa thành công ' . $chucvu->ten_chuc_vu);
//            if ($chucvu) {
//                lich_su_thao_tac::create([
//                    'id_nv'=>0,
//                    'thao_tac'=>'Chỉnh sửa tên chức vụ ',
//                    'mo_ta'=>'Tên chức vụ: ' . $chucvu->ten_cv .' -> '. (string)$request->input('ten'),
//                ]);
//                chucvu::where('id', $id)->delete();
//            }
//
//            return true;
//        } catch (\Exception $err) {
//            Session::flash('error', 'Xóa thất bại');
//            return false;
//        }
//    }

}

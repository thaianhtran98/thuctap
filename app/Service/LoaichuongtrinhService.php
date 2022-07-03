<?php

namespace App\Service;

use App\Models\lich_su_thao_tac;
use App\Models\loaichuongtrinh;
use Illuminate\Support\Facades\Session;

class LoaichuongtrinhService
{
    public function create($request)
    {
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            loaichuongtrinh::create([
                'ten_chuong_trinh' => (string)$request->input('name'),
                'hoat_dong' => (int)$request->input('active'),
            ]);
            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Thêm chương trình mới',
                'mo_ta'=>'Tên chương trình: ' . $request->input('name')
                    . '<br> Hoạt động: '.$request->input('active'),
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
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            if ($request->input('ten')==null){
                return false;
            }
            loaichuongtrinh::create([
                'ten_chuong_trinh' => (string)$request->input('ten'),
                'hoat_dong' => 1,
            ]);

            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Thêm chương trình mới',
                'mo_ta'=>'Tên chương trình: ' . $request->input('name')
                    . '<br> Hoạt động: 1',
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
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            if ((int)$loaichuongtrinh->hoat_dong == 1) {
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Chỉnh sửa trạng thái loại chương trình ',
                    'mo_ta'=>'Tên đơn vị: ' . $loaichuongtrinh->ten_chuong_trinh
                        . '<br> Hoạt động: Ngưng hoạt động ',
                ]);
                $loaichuongtrinh->hoat_dong = 0;
                $loaichuongtrinh->save();
                return true;
            } else {
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Chỉnh sửa trạng thái loại chương trình',
                    'mo_ta'=>'Tên đơn vị: ' . $loaichuongtrinh->ten_chuong_trinh
                        . '<br> Hoạt động: Hoạt động ',
                ]);
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
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Chỉnh sửa tên chương trình ',
                'mo_ta'=>'Tên chương trình: ' .$loaichuongtrinh->ten_chuong_trinh .' -> ' .  (string)$request->input('ten'),
            ]);
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
            date_default_timezone_set("Asia/Ho_Chi_Minh");
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

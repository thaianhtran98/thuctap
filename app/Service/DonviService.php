<?php

namespace App\Service;

use App\Models\donvi;
use App\Models\lich_su_thao_tac;
use App\Models\luyke;
use Illuminate\Support\Facades\Session;

class DonviService
{

    public function create($request){
        try{
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            donvi::create([
                'ten_don_vi' => (string)$request->input('name'),
                'luy_ke_dau_ky' => (integer)$request->input('luyke'),
                'uu_tien' => (int)$request->input('uutien'),
                'hoat_dong' => (int)$request->input('active'),
            ]);

            $id_don_vi = donvi::where('ten_don_vi',(string)$request->input('name'))->first();

            luyke::create([
                'id_don_vi' => (integer)$id_don_vi->id,
                'luy_ke_hang_tuan' => (integer)$request->input('luyke'),
                'tuan' => 0,
                'nam' => 0,
            ]);

            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Thêm đơn vị mới',
                'mo_ta'=>'Tên đơn vị' . (string)$request->input('name')
                    . '<br> Lũy kế đầu kỳ: '.(integer)$request->input('luyke')
                    . '<br> Ưu tiên: '.(integer)$request->input('uutien')
                    . '<br> Hoạt động: '.(integer)$request->input('active'),
            ]);

            Session::flash('success', 'Thêm  thành công ' . $request->input('name'));

        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }


    public function create_ajax($request){
        try{
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            donvi::create([
                'ten_don_vi' => (string)$request->input('ten'),
                'luy_ke_dau_ky' => (integer)$request->input('luyke'),
                'uu_tien' => (integer)$request->input('uutien'),
                'hoat_dong' => 1,
            ]);

            $id_don_vi = donvi::where('ten_don_vi',(string)$request->input('ten'))->first();

            luyke::create([
                'id_don_vi' => (integer)$id_don_vi->id,
                'luy_ke_hang_tuan' => (integer)$request->input('luyke'),
                'tuan' => 0,
                'nam' => 0,
            ]);

            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Thêm đơn vị mới',
                'mo_ta'=>'Tên đơn vị: ' . (string)$request->input('ten')
                    . '<br> Lũy kế đầu kỳ: '.(integer)$request->input('luyke')
                    . '<br> Ưu tiên: '.(integer)$request->input('uutien')
                    . '<br> Hoạt động: '. 1,
            ]);

            return donvi::where('ten_don_vi',$request->input('ten'))->first();
        }catch (\Exception $err){
            return false;
        }
    }

    public function getdonvi(){
        return donvi::orderBy('uu_tien')->get();
    }

    public function getdonviactive(){
        return donvi::where('hoat_dong',1)->orderBy('uu_tien')->get();
    }

    public function change_active($donvi){
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            if ((int)$donvi->hoat_dong == 1){
                $donvi->hoat_dong = 0;
                $donvi->save();
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Chỉnh sửa trạng thái đơn vị ',
                    'mo_ta'=>'Tên đơn vị: ' . $donvi->ten_don_vi
                        . '<br> Hoạt động: Ngưng hoạt động ',
                ]);
                return true;
            }else{
                $donvi->hoat_dong = 1;
                $donvi->save();
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Chỉnh sửa trạng thái đơn vị ',
                    'mo_ta'=>'Tên đơn vị: ' . $donvi->ten_don_vi
                        . '<br> Hoạt động: Hoạt động',
                ]);
                return true;
            }
        }catch (\Exception $err){
//            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function edit($donvi,$request){
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $luyke = luyke::where('id_don_vi',$donvi->id)
                ->where('tuan',0)
                ->first();
            if ($donvi->ten_don_vi != $request->input('ten')){
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Chỉnh sửa tên đơn vị ',
                    'mo_ta'=>'Tên đơn vị: ' .$donvi->ten_don_vi .' -> ' .  (string)$request->input('ten'),
                ]);
                $donvi->ten_don_vi = $request->input('ten');
            }
            elseif ( $donvi->luy_ke_dau_ky != $request->input('luyke')){
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Chỉnh sửa lũy kế đơn vị ',
                    'mo_ta'=>'Tên đơn vị: ' .$donvi->ten_don_vi .'<br>Lũy kế đầu kỳ: '. $donvi->luy_ke_dau_ky . ' -> '. (integer)$request->input('luyke'),
                ]);
                $donvi->luy_ke_dau_ky = $request->input('luyke');
                $luyke->luy_ke_hang_tuan = $request->input('luyke');
                $luyke->save();
            }
            elseif ($donvi->uu_tien != $request->input('uutien')){
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Chỉnh sửa độ ưu tiên đơn vị ',
                    'mo_ta'=>'Tên đơn vị: ' .$donvi->ten_don_vi .'<br>Ưu tiên: '.$donvi->uu_tien .' -> '. (integer)$request->input('uutien'),
                ]);
                $donvi->uu_tien = $request->input('uutien');
            }

            $donvi->save();

        }catch (\Exception $err){
//            Session::flash('error','Thất bại');
            return false;
        }
    }

    public function destroy($request){
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $id = $request->input('id');
            $name = donvi::where('id', $id)->first();

            $menu = donvi::where('id', $id)->first();
            Session::flash('success', 'Xóa thành công ' . $name->ten_don_vi);
            $name =$name->ten_don_vi;
            if($menu){
                donvi::where('id',$id)->delete();
            }
            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Xóa đơn vị',
                'mo_ta'=>'Tên đơn vị: '.$name,
            ]);
            return true;
        }catch (\Exception $err){
            Session::flash('error','Xóa thất bại');
            return false;
        }
    }

}

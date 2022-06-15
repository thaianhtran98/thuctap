<?php

namespace App\Service;

use App\Models\chitietyeucau;
use App\Models\loaingay;
use App\Models\thuoctinhyeucau;
use App\Models\yeucauton;
use Illuminate\Support\Facades\Session;

class YeucauService
{
    public function create($request)
    {
        try {
            if(yeucauton::where('ten_yeu_cau',$request->input('ten_yeu_cau'))->where('id_loai_chuong_trinh',(integer)$request->input('id_loai_chuong_trinh'))->where('id_don_vi',(integer)$request->input('id_don_vi'))->first()){
                Session::flash('error', 'Đã tồn tại yêu cầu '.$request->input('ten_yeu_cau'));
                return false;
            }else{
                yeucauton::create([
                    'ten_yeu_cau' => (string)$request->input('ten_yeu_cau'),
                    'id_loai_chuong_trinh' => (integer)$request->input('id_loai_chuong_trinh'),
                    'id_don_vi' => (integer)$request->input('id_don_vi'),
                    'trang_thai' => (integer)$request->input('trang_thai'),
                    'noi_dung_yc' => (string)$request->input('noi_dung_yc'),
                ]);
                $yc = yeucauton::where('ten_yeu_cau',$request->input('ten_yeu_cau'))->
                where('id_loai_chuong_trinh',(integer)$request->input('id_loai_chuong_trinh'))->
                where('id_don_vi',(integer)$request->input('id_don_vi'))->first();

                if($request->input('ngayhoanthanhdukien')!='' && $request->input('ngaygiaoviec')==''){
                    $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                    $ngayhoanthanhdukien=explode('/',$request->input('ngayhoanthanhdukien'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                        'ngayhoanthanhdukien' => $ngayhoanthanhdukien[2] . '/' . $ngayhoanthanhdukien[1] . '/' . $ngayhoanthanhdukien[0],
                    ]);
                }elseif ($request->input('ngayhoanthanhdukien')=='' && $request->input('ngaygiaoviec')!=''){
                    $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                    $ngaygiaoviec=explode('/',$request->input('ngaygiaoviec'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                        'ngaygiaoviec' => $ngaygiaoviec[2] . '/' . $ngaygiaoviec[1] . '/' . $ngaygiaoviec[0],
                    ]);
                }elseif ($request->input('ngayhoanthanhdukien')!='' && $request->input('ngaygiaoviec')!=''){
                    $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                    $ngaygiaoviec=explode('/',$request->input('ngaygiaoviec'));
                    $ngayhoanthanhdukien=explode('/',$request->input('ngayhoanthanhdukien'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                        'ngaygiaoviec' => $ngaygiaoviec[2] . '/' . $ngaygiaoviec[1] . '/' . $ngaygiaoviec[0],
                        'ngayhoanthanhdukien' => $ngayhoanthanhdukien[2] . '/' . $ngayhoanthanhdukien[1] . '/' . $ngayhoanthanhdukien[0],
                    ]);
                }
                else{
                    $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                    ]);
                }

                $nv_id = $request->input('nv_id');
                $cv_id = $request->input('cv_id');
                if($nv_id!=null){
                    foreach ($nv_id as $key => $nv_id){
                        chitietyeucau::create([
                            'id_yc'=>(integer)$yc->id,
                            'id_nguoithuchien'=>(integer)$nv_id,
                            'id_chucvu'=>(integer)$cv_id[$key],
                        ]);
                    }

                }

                Session::flash('success', 'Thêm  thành công yêu cầu ' . $request->input('ten_yeu_cau'));
                return $yc;
            }
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }


    public function update_yc($yeucauton,$request){
        try{
            $yeucauton->ten_yeu_cau = (string)$request->input('ten_yeu_cau');
            $yeucauton->id_loai_chuong_trinh = (integer)$request->input('id_loai_chuong_trinh');
            $yeucauton->id_don_vi = (integer)$request->input('id_don_vi');
            $yeucauton->trang_thai = (integer)$request->input('trang_thai');
            $yeucauton->noi_dung_yc = (string)$request->input('noi_dung_yc');
            $yeucauton->save();

            loaingay::where('id_yc',$yeucauton->id)->delete();

            if($request->input('ngayhoanthanhdukien')!='' && $request->input('ngaygiaoviec')==''){
                $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                $ngayhoanthanhdukien=explode('/',$request->input('ngayhoanthanhdukien'));
                loaingay::create([
                    'id_yc' => $yeucauton->id,
                    'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                    'ngayhoanthanhdukien' => $ngayhoanthanhdukien[2] . '/' . $ngayhoanthanhdukien[1] . '/' . $ngayhoanthanhdukien[0],
                ]);
            }elseif ($request->input('ngayhoanthanhdukien')=='' && $request->input('ngaygiaoviec')!=''){
                $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                $ngaygiaoviec=explode('/',$request->input('ngaygiaoviec'));
                loaingay::create([
                    'id_yc' => $yeucauton->id,
                    'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                    'ngaygiaoviec' => $ngaygiaoviec[2] . '/' . $ngaygiaoviec[1] . '/' . $ngaygiaoviec[0],
                ]);
            }elseif ($request->input('ngayhoanthanhdukien')!='' && $request->input('ngaygiaoviec')!=''){
                $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                $ngaygiaoviec=explode('/',$request->input('ngaygiaoviec'));
                $ngayhoanthanhdukien=explode('/',$request->input('ngayhoanthanhdukien'));
                loaingay::create([
                    'id_yc' => $yeucauton->id,
                    'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                    'ngaygiaoviec' => $ngaygiaoviec[2] . '/' . $ngaygiaoviec[1] . '/' . $ngaygiaoviec[0],
                    'ngayhoanthanhdukien' => $ngayhoanthanhdukien[2] . '/' . $ngayhoanthanhdukien[1] . '/' . $ngayhoanthanhdukien[0],
                ]);
            }
            else{
                $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                loaingay::create([
                    'id_yc' => $yeucauton->id,
                    'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                ]);
            }

            $nv_id = $request->input('nv_id');
            $cv_id = $request->input('cv_id');
            if($nv_id!=null){
                foreach ($nv_id as $key => $nv_id){
                    chitietyeucau::create([
                        'id_yc'=>(integer)$yeucauton->id,
                        'id_nguoithuchien'=>(integer)$nv_id,
                        'id_chucvu'=>(integer)$cv_id[$key],
                    ]);
                }

            }

            Session::flash('success', 'Thêm  thành công yêu cầu ' . $request->input('ten_yeu_cau'));
        }catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function create_tam($request){
        try {
            if(yeucauton::where('ten_yeu_cau',$request->input('ten_yeu_cau'))->where('id_loai_chuong_trinh',(integer)$request->input('id_loai_chuong_trinh'))->where('id_don_vi',(integer)$request->input('id_don_vi'))->first()){
                Session::flash('error', 'Đã tồn tại yêu cầu '.$request->input('ten_yeu_cau'));
                return false;
            }else{
                yeucauton::create([
                    'ten_yeu_cau' => (string)$request->input('ten_yeu_cau'),
                    'id_loai_chuong_trinh' => (integer)$request->input('id_loai_chuong_trinh'),
                    'id_don_vi' => (integer)$request->input('id_don_vi'),
                    'trang_thai' => (integer)$request->input('trang_thai'),
                    'noi_dung_yc' => (string)$request->input('noi_dung_yc'),
                ]);
                $yc = yeucauton::where('ten_yeu_cau',$request->input('ten_yeu_cau'))->
                where('id_loai_chuong_trinh',(integer)$request->input('id_loai_chuong_trinh'))->
                where('id_don_vi',(integer)$request->input('id_don_vi'))->first();

                if($request->input('ngayhoanthanhdukien')!='' && $request->input('ngaygiaoviec')==''){
                    $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                    $ngayhoanthanhdukien=explode('/',$request->input('ngayhoanthanhdukien'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                        'ngayhoanthanhdukien' => $ngayhoanthanhdukien[2] . '/' . $ngayhoanthanhdukien[1] . '/' . $ngayhoanthanhdukien[0],
                    ]);
                }elseif ($request->input('ngayhoanthanhdukien')=='' && $request->input('ngaygiaoviec')!=''){
                    $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                    $ngaygiaoviec=explode('/',$request->input('ngaygiaoviec'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                        'ngaygiaoviec' => $ngaygiaoviec[2] . '/' . $ngaygiaoviec[1] . '/' . $ngaygiaoviec[0],
                    ]);
                }elseif ($request->input('ngayhoanthanhdukien')!='' && $request->input('ngaygiaoviec')!=''){
                    $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                    $ngaygiaoviec=explode('/',$request->input('ngaygiaoviec'));
                    $ngayhoanthanhdukien=explode('/',$request->input('ngayhoanthanhdukien'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                        'ngaygiaoviec' => $ngaygiaoviec[2] . '/' . $ngaygiaoviec[1] . '/' . $ngaygiaoviec[0],
                        'ngayhoanthanhdukien' => $ngayhoanthanhdukien[2] . '/' . $ngayhoanthanhdukien[1] . '/' . $ngayhoanthanhdukien[0],
                    ]);
                }
                else{
                    $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                    ]);
                }

//                $nv_id = $request->input('nv_id');
//                $cv_id = $request->input('cv_id');
//                if($nv_id!=null){
//                    foreach ($nv_id as $key => $nv_id){
//                        chitietyeucau::create([
//                            'id_yc'=>(integer)$yc->id,
//                            'id_nguoithuchien'=>(integer)$nv_id,
//                            'id_chucvu'=>(integer)$cv_id[$key],
//                        ]);
//                    }
//
//                }

                Session::flash('success', 'Thêm  thành công yêu cầu ' . $request->input('ten_yeu_cau'));
                return $yc;
            }
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function create_thuoctinh($request){
        try{
            if(thuoctinhyeucau::where('id_yc',$request->input('id_yc'))
                ->where('ten_thuoc_tinh',$request->input('ten_thuoc_tinh'))
                ->first()){
                return false;
            }
            thuoctinhyeucau::create([
                'id_yc' => (integer)$request->input('id_yc'),
                'ten_thuoc_tinh' => (string)$request->input('ten_thuoc_tinh'),
                'kieu_thuoc_tinh' => (string)$request->input('kieu_thuoc_tinh'),
                'noi_dung_thuoc_tinh' => (string)$request->input('noi_dung_thuoc_tinh'),
            ]);
            return thuoctinhyeucau::where('id_yc',$request->input('id_yc'))
                ->where('ten_thuoc_tinh',$request->input('ten_thuoc_tinh'))
                ->first();
        }catch (\Exception $err){
            return false;
        }
    }


    public function getyeucau()
    {
        return yeucauton::orderBy('id')->get();
    }

    public function getchitiet($id_yc){
        return chitietyeucau::where('id_yc',$id_yc)->get();
    }

    public function getloaingay($id_yc){
        return loaingay::where('id_yc',$id_yc)->first();
    }

    public function getyeucaukhac($id_yc){
        return thuoctinhyeucau::where('id_yc',$id_yc)->get();
    }

    public function destroy($request){
        try {
            $id = $request->input('id');
            $yc = yeucauton::where('id', $id)->first();
            Session::flash('success', 'Xóa thành công ' . $yc->ten_yeu_cau);
            if ($yc) {
                yeucauton::where('id', $id)->delete();
                chitietyeucau::where('id_yc',$id)->delete();
                loaingay::where('id_yc',$id)->delete();
                thuoctinhyeucau::where('id_yc',$id)->delete();
            }
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa thất bại');
            return false;
        }
    }
    public function destroy_yck($request){
        try {
            $id = $request->input('id');
            $yc = thuoctinhyeucau::where('id', $id)->first();
            Session::flash('success', 'Xóa thành công ' . $yc->ten_thuoc_tinh);
            if ($yc) {
                thuoctinhyeucau::where('id',$id)->delete();
            }
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa thất bại');
            return false;
        }
    }
}

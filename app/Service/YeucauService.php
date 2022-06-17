<?php

namespace App\Service;

use App\Models\chitietyeucau;
use App\Models\donvi;
use App\Models\loaingay;
use App\Models\luyke;
use App\Models\thuoctinhyeucau;
use App\Models\yeucauton;
use Illuminate\Support\Facades\Session;

class YeucauService
{
    public function create($request)
    {
        try {
            if (yeucauton::where('ten_yeu_cau', $request->input('ten_yeu_cau'))->where('id_loai_chuong_trinh', (integer)$request->input('id_loai_chuong_trinh'))->where('id_don_vi', (integer)$request->input('id_don_vi'))->first()) {
                Session::flash('error', 'Đã tồn tại yêu cầu ' . $request->input('ten_yeu_cau'));
                return false;
            } else {
                yeucauton::create([
                    'ten_yeu_cau' => (string)$request->input('ten_yeu_cau'),
                    'id_loai_chuong_trinh' => (integer)$request->input('id_loai_chuong_trinh'),
                    'id_don_vi' => (integer)$request->input('id_don_vi'),
                    'trang_thai' => (integer)$request->input('trang_thai'),
                    'noi_dung_yc' => (string)$request->input('noi_dung_yc'),
                ]);

//                add ngày
                $yc = yeucauton::where('ten_yeu_cau', $request->input('ten_yeu_cau'))->
                where('id_loai_chuong_trinh', (integer)$request->input('id_loai_chuong_trinh'))->
                where('id_don_vi', (integer)$request->input('id_don_vi'))->first();

                if ($request->input('ngayhoanthanhdukien') != '' && $request->input('ngaygiaoviec') == '') {
                    $ngaytiepnhan = explode('/', $request->input('ngaytiepnhan'));
                    $ngayhoanthanhdukien = explode('/', $request->input('ngayhoanthanhdukien'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                        'ngayhoanthanhdukien' => $ngayhoanthanhdukien[2] . '/' . $ngayhoanthanhdukien[1] . '/' . $ngayhoanthanhdukien[0],
                    ]);
                } elseif ($request->input('ngayhoanthanhdukien') == '' && $request->input('ngaygiaoviec') != '') {
                    $ngaytiepnhan = explode('/', $request->input('ngaytiepnhan'));
                    $ngaygiaoviec = explode('/', $request->input('ngaygiaoviec'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                        'ngaygiaoviec' => $ngaygiaoviec[2] . '/' . $ngaygiaoviec[1] . '/' . $ngaygiaoviec[0],
                    ]);
                } elseif ($request->input('ngayhoanthanhdukien') != '' && $request->input('ngaygiaoviec') != '') {
                    $ngaytiepnhan = explode('/', $request->input('ngaytiepnhan'));
                    $ngaygiaoviec = explode('/', $request->input('ngaygiaoviec'));
                    $ngayhoanthanhdukien = explode('/', $request->input('ngayhoanthanhdukien'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                        'ngaygiaoviec' => $ngaygiaoviec[2] . '/' . $ngaygiaoviec[1] . '/' . $ngaygiaoviec[0],
                        'ngayhoanthanhdukien' => $ngayhoanthanhdukien[2] . '/' . $ngayhoanthanhdukien[1] . '/' . $ngayhoanthanhdukien[0],
                    ]);
                } else {
                    $ngaytiepnhan = explode('/', $request->input('ngaytiepnhan'));
                    loaingay::create([
                        'id_yc' => $yc->id,
                        'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                    ]);
                }


                // add nhân viên
                $nv_id = $request->input('nv_id');
                $cv_id = $request->input('cv_id');
                if ($nv_id != null) {
                    foreach ($nv_id as $key => $nv_id) {
                        chitietyeucau::create([
                            'id_yc' => (integer)$yc->id,
                            'id_nguoithuchien' => (integer)$nv_id,
                            'id_chucvu' => (integer)$cv_id[$key],
                        ]);
                    }
                }

//                add vào lũy kế
                $donvi = $yc->yc_dv->id;
                $luykedauky = $yc->yc_dv->luy_ke_dau_ky;

                $luyke_donvi = luyke::where('id_don_vi', $donvi)->first();

                if ($luyke_donvi) {
                    $luyke = luyke::find($luyke_donvi->id);
                    $luyke->luy_ke_hang_tuan += 1;
                    $luyke->save();
                } else {
                    luyke::create([
                        'id_don_vi' => (integer)$donvi,
                        'luy_ke_hang_tuan' => (integer)$luykedauky + 1,
                    ]);
                }


//                Lấy tuần trong ngày
//                $thang =$ngaytiepnhan[1];
//                $nam = $ngaytiepnhan[2];
//                $ngaytiepnhan =  $ngaytiepnhan[2] . '-' . $ngaytiepnhan[1] . '-' . $ngaytiepnhan[0];
//                $tuan = date('W',strtotime($ngaytiepnhan));
////              $donvi = donvi::where('id',$yc->id_don_vi)->first();
//                $donvi = $yc->yc_dv->id;
//                $luykedauky = $yc->yc_dv->luy_ke_dau_ky;
//                $luyke_donvi = luyke::where('id_don_vi',$donvi)
//                    ->where('tuan',$tuan)
//                    ->where('thang',$thang)
//                    ->where('nam',$nam)->first();
//
//                if($luyke_donvi){
//                    $luyke= luyke::find($luyke_donvi->id);
//                    $luy_ke_hang_tuan = (integer)$luyke->luy_ke_hang_tuan;
//                    $luyke->luy_ke_hang_tuan +=1;
//                    $luyke->save();
//                }else{
//                    $luyke_donvi = luyke::where('id_don_vi',$donvi)
//                        ->where('tuan','<>',$tuan)
//                        ->where('thang',$thang)
//                        ->where('nam',$nam)
//                        ->orderByDesc('id')->first();
//                    if($luyke_donvi){
//                        $max = luyke::orderBy('luy_ke_hang_tuan')->where('id_don_vi',$donvi)->where('thang',$thang)
//                            ->where('nam',$nam)->first();
//                        luyke::create([
//                            'id_don_vi'=>(integer)$donvi,
//                            'luy_ke_hang_tuan' =>(integer)$max->luy_ke_hang_tuan + 1,
//                            'tuan'=>(integer)$tuan,
//                            'thang'=>(integer)$thang,
//                            'nam'=>(integer)$nam,
//                        ]);
//                    }else{
//                        luyke::create([
//                            'id_don_vi'=>(integer)$donvi,
//                            'luy_ke_hang_tuan' =>(integer)$luykedauky + 1,
//                            'tuan'=>(integer)$tuan,
//                            'thang'=>(integer)$thang,
//                            'nam'=>(integer)$nam,
//                        ]);

                Session::flash('success', 'Thêm  thành công yêu cầu ' . $request->input('ten_yeu_cau'));
                return $yc;
            }
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }


    public function luu_lai_yc($yeucauton,$request){
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
            chitietyeucau::where('id_yc',$yeucauton->id)->delete();
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




            if ($request->input('ngaytiepnhan')!=''){
                $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
                loaingay::where('id_yc', $yeucauton->id)
                    ->update(['ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0]]);
            }

            if ($request->input('ngaygiaoviec')!=''){
                $ngaygiaoviec=explode('/',$request->input('ngaygiaoviec'));
                loaingay::where('id_yc', $yeucauton->id)
                    ->update(['ngaygiaoviec' => $ngaygiaoviec[2] . '/' . $ngaygiaoviec[1] . '/' . $ngaygiaoviec[0]]);
            }

            if ($request->input('ngayhoanthanh')!=''){
                $ngayhoanthanh=explode('/',$request->input('ngayhoanthanh'));
                loaingay::where('id_yc', $yeucauton->id)
                    ->update(['ngayhoanthanh' => $ngayhoanthanh[2] . '/' . $ngayhoanthanh[1] . '/' . $ngayhoanthanh[0]]);
            }

            if ($request->input('ngayhostfix')!=''){
                $ngayhostfix=explode('/',$request->input('ngayhostfix'));
                loaingay::where('id_yc', $yeucauton->id)
                    ->update(['ngayhostfix' => $ngayhostfix[2] . '/' . $ngayhostfix[1] . '/' . $ngayhostfix[0]]);
            }

            if ($request->input('ngayhoanthanhdukien')!=''){
                $ngayhoanthanhdukien=explode('/',$request->input('ngayhoanthanhdukien'));
                loaingay::where('id_yc', $yeucauton->id)
                    ->update(['ngayhoanthanhdukien' => $ngayhoanthanhdukien[2] . '/' . $ngayhoanthanhdukien[1] . '/' . $ngayhoanthanhdukien[0]]);
            }

            $nv_id = $request->input('nv_id');
            $cv_id = $request->input('cv_id');
            chitietyeucau::where('id_yc',$yeucauton->id)->delete();
            if($nv_id!=null){
                foreach ($nv_id as $key => $nv_id){
                    chitietyeucau::create([
                        'id_yc'=>(integer)$yeucauton->id,
                        'id_nguoithuchien'=>(integer)$nv_id,
                        'id_chucvu'=>(integer)$cv_id[$key],
                    ]);
                }

            }

            Session::flash('success', 'Cập nhật thành công yêu cầu ' . $request->input('ten_yeu_cau'));
        }catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
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


    public function edit_thuoctinh($request){
        try{
            $thuoctinhyc = thuoctinhyeucau::where('id',$request->input('id_thuoc_tinh'))->first();
            $thuoctinhyc->ten_thuoc_tinh = $request->input('ten_thuoc_tinh');
            $thuoctinhyc->kieu_thuoc_tinh = $request->input('kieu_thuoc_tinh');
            $thuoctinhyc->noi_dung_thuoc_tinh = $request->input('noi_dung_thuoc_tinh');
            $thuoctinhyc->save();
            return $thuoctinhyc;
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
            $loaingay = loaingay::where('id_yc',$id)->first();
            $tuan = date('W',strtotime($loaingay->ngaytiepnhan));
            Session::flash('success', 'Xóa thành công ' . $yc->ten_yeu_cau);

            if ($yc) {
                chitietyeucau::where('id_yc',$id)->delete();
                loaingay::where('id_yc',$id)->delete();
                thuoctinhyeucau::where('id_yc',$id)->delete();
                yeucauton::where('id', $id)->delete();
            }
            return true;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
//            Session::flash('error', 'Xóa thất bại');
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

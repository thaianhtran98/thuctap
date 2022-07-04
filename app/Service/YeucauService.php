<?php

namespace App\Service;

use App\Models\chitietyeucau;
use App\Models\chucvu;
use App\Models\donvi;
use App\Models\ky;
use App\Models\kybaocao;
use App\Models\lich_su_thao_tac;
use App\Models\loaingay;
use App\Models\luyke;
use App\Models\nguoithuchien;
use App\Models\thuoctinhyeucau;
use App\Models\yeucauton;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class YeucauService
{

    public function create($request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
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
                $nv_cv = '';
                if ($nv_id != null) {
                    foreach ($nv_id as $key => $nv_id) {
                        chitietyeucau::create([
                            'id_yc' => (integer)$yc->id,
                            'id_nguoithuchien' => (integer)$nv_id,
                            'id_chucvu' => (integer)$cv_id[$key],
                        ]);
                        $nv = nguoithuchien::where('id',$nv_id)->first();
                        $cv = chucvu::where('id',$cv_id[$key])->first();
                        $nv_cv .= '<br>' . $nv->ten_nguoi_thuc_hien . ' chức vụ ' . $cv->ten_chuc_vu ;
                    }
                }


                if ( (integer)$request->input('trang_thai') ==0){
                    $trangthai ='Tiếp nhận';
                }elseif ((integer)$request->input('trang_thai') ==1){
                    $trangthai ='Giao Việc';
                }

                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Thêm yêu cầu mới',
                    'mo_ta'=>'Tên yêu cầu: ' . (string)$request->input('ten_yeu_cau')
                        . '<br> Thuộc Đơn vị: '. $yc->yc_dv->ten_don_vi
                        . '<br> Thuộc chương trình: '.$yc->yc_ct->ten_chuong_trinh
                        . '<br> Nội dung: '.$request->input('noi_dung_yc')
                        . '<br> Trạng thái: '.$trangthai
                        . '<br> Ngày Tiếp Nhận: '. $request->input('ngaytiepnhan')
                        . '<br> Ngày Giao Việc: '. $request->input('ngaygiaoviec')
                        . '<br> Ngày dự kiến hoàn thành: '. $request->input('ngayhoanthanhdukien')
                        . '<br> Người thực hiện: '.$nv_cv,
                ]);

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
            date_default_timezone_set("Asia/Ho_Chi_Minh");
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

            // add nhân viên
            $nv_id = $request->input('nv_id');
            $cv_id = $request->input('cv_id');
            $nv_cv = '';
            if ($nv_id != null) {
                foreach ($nv_id as $key => $nv_id) {
                    chitietyeucau::create([
                        'id_yc' => (integer)$yeucauton->id,
                        'id_nguoithuchien' => (integer)$nv_id,
                        'id_chucvu' => (integer)$cv_id[$key],
                    ]);
                    $nv = nguoithuchien::where('id',$nv_id)->first();
                    $cv = chucvu::where('id',$cv_id[$key])->first();
                    $nv_cv .= '<br>' . $nv->ten_nguoi_thuc_hien . ' chức vụ ' . $cv->ten_chuc_vu ;
                }
            }


            if ( (integer)$request->input('trang_thai') ==0){
                $trangthai ='Tiếp nhận';
            }elseif ((integer)$request->input('trang_thai') ==1){
                $trangthai ='Giao Việc';
            }

            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Thêm yêu cầu mới',
                'mo_ta'=>'Tên yêu cầu: ' . (string)$request->input('ten_yeu_cau')
                    . '<br> Thuộc Đơn vị: '. $yeucauton->yc_dv->ten_don_vi
                    . '<br> Thuộc chương trình: '.$yeucauton->yc_ct->ten_chuong_trinh
                    . '<br> Nội dung: '.$request->input('noi_dung_yc')
                    . '<br> Trạng thái: '.$trangthai
                    . '<br> Ngày Tiếp Nhận: '. $request->input('ngaytiepnhan')
                    . '<br> Ngày Giao Việc: '. $request->input('ngaygiaoviec')
                    . '<br> Ngày dự kiến hoàn thành: '. $request->input('ngayhoanthanhdukien')
                    . '<br> Người thực hiện: '.$nv_cv,
            ]);

            Session::flash('success', 'Thêm  thành công yêu cầu ' . $request->input('ten_yeu_cau'));
        }catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function create_tam($request){
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
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

//                Session::flash('success', 'Thêm  thành công yêu cầu ' . $request->input('ten_yeu_cau'));
                return $yc;
            }
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function update_yc($yeucauton,$request){
        try{

            if ( $yeucauton->trang_thai ==0){
                $trangthaihientai ='Tiếp Nhận';
            }elseif ($yeucauton->trang_thai ==1){
                $trangthaihientai ='Giao Việc';
            }elseif ($yeucauton->trang_thai ==2){
                $trangthaihientai ='Đang Code';
            }elseif ($yeucauton->trang_thai ==3){
                $trangthaihientai ='Hoàn Thành';
            }elseif ($yeucauton->trang_thai ==4){
                $trangthaihientai ='Hostfix';
            }

            date_default_timezone_set("Asia/Ho_Chi_Minh");
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

            // add nhân viên
            $nv_id = $request->input('nv_id');
            $cv_id = $request->input('cv_id');
            $nv_cv = '';
            if ($nv_id != null) {
                foreach ($nv_id as $key => $nv_id) {
                    chitietyeucau::create([
                        'id_yc' => (integer)$yeucauton->id,
                        'id_nguoithuchien' => (integer)$nv_id,
                        'id_chucvu' => (integer)$cv_id[$key],
                    ]);
                    $nv = nguoithuchien::where('id',$nv_id)->first();
                    $cv = chucvu::where('id',$cv_id[$key])->first();
                    $nv_cv .= '<br>' . $nv->ten_nguoi_thuc_hien . ' chức vụ ' . $cv->ten_chuc_vu ;
                }
            }


            if ( (integer)$request->input('trang_thai') ==0){
                $trangthai ='Tiếp Nhận';
            }elseif ((integer)$request->input('trang_thai') ==1){
                $trangthai ='Giao Việc';
            }elseif ((integer)$request->input('trang_thai') ==2){
                $trangthai ='Đang Code';
            }elseif ((integer)$request->input('trang_thai') ==3){
                $trangthai ='Hoàn Thành';
            }elseif ((integer)$request->input('trang_thai') ==4){
                $trangthai ='Hostfix';
            }

            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Cập nhật yêu cầu',
                'mo_ta'=>'Tên yêu cầu: ' . (string)$request->input('ten_yeu_cau')
                    . '<br> Thuộc Đơn vị: '. $yeucauton->yc_dv->ten_don_vi
                    . '<br> Thuộc chương trình: '.$yeucauton->yc_ct->ten_chuong_trinh
                    . '<br> Nội dung: '.$request->input('noi_dung_yc')
                    . '<br> Trạng thái: từ '.$trangthaihientai . ' -> ' . $trangthai
                    . '<br> Ngày Tiếp Nhận: '. $request->input('ngaytiepnhan')
                    . '<br> Ngày Giao Việc: '. $request->input('ngaygiaoviec')
                    . '<br> Ngày dự hoàn thành: '. $request->input('ngayhoanthanh')
                    . '<br> Ngày dự hostfix: '. $request->input('ngayhostfix')
                    . '<br> Người thực hiện: '.$nv_cv,
            ]);

            Session::flash('success', 'Cập nhật thành công yêu cầu ' . $request->input('ten_yeu_cau'));
        }catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function create_thuoctinh($request){
        try{
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $thuoctinh = thuoctinhyeucau::where('id_yc',$request->input('id_yc'))
                ->where('ten_thuoc_tinh',$request->input('ten_thuoc_tinh'))
                ->first();
            if($thuoctinh){
                if($thuoctinh->noi_dung_thuoc_tinh == (string)$request->input('noi_dung_thuoc_tinh')){
                    return false;
                }
            }
            thuoctinhyeucau::create([
                'id_yc' => (integer)$request->input('id_yc'),
                'ten_thuoc_tinh' => (string)$request->input('ten_thuoc_tinh'),
                'kieu_thuoc_tinh' => (string)$request->input('kieu_thuoc_tinh'),
                'noi_dung_thuoc_tinh' => (string)$request->input('noi_dung_thuoc_tinh'),
            ]);

            $yeucauton = yeucauton::where('id',$request->input('id_yc'))->first();

            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Thêm yêu cầu con cho yêu cầu' ,
                'mo_ta'=>'<br>Tên yêu cầu cha: '. $yeucauton->ten_yeu_cau
                    . '<br> Tên yêu cầu con: '.$request->input('ten_thuoc_tinh')
                    . '<br> Kiểu yêu cầu con: '.$request->input('kieu_thuoc_tinh')
                    . '<br> Nội dung yêu cầu con: '.$request->input('noi_dung_thuoc_tinh'),
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
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $thuoctinhyc = thuoctinhyeucau::where('id',$request->input('id_thuoc_tinh'))->first();
            $thuoctinhyc->ten_thuoc_tinh = $request->input('ten_thuoc_tinh');
            $thuoctinhyc->kieu_thuoc_tinh = $request->input('kieu_thuoc_tinh');
            $thuoctinhyc->noi_dung_thuoc_tinh = $request->input('noi_dung_thuoc_tinh');
            $thuoctinhyc->save();

            $yeucauton = yeucauton::where('id',$thuoctinhyc->id_yc)->first();

            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Cập nhật yêu cầu con cho yêu cầu',
                'mo_ta'=>'<br>Tên yêu cầu cha: '. $yeucauton->ten_yeu_cau
                    . '<br> Tên yêu cầu con: '.$request->input('ten_thuoc_tinh')
                    . '<br> Kiểu yêu cầu con: '.$request->input('kieu_thuoc_tinh')
                    . '<br> Nội dung yêu cầu con: '.$request->input('noi_dung_thuoc_tinh'),
            ]);


            return $thuoctinhyc;
        }catch (\Exception $err){
            return false;
        }
    }

    public function destroy($request){
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $id = $request->input('id');
            $yc = yeucauton::where('id', $id)->first();

            Session::flash('success', 'Xóa thành công ' . $yc->ten_yeu_cau);
            if ($yc) {
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Xóa yêu cầu: ' . $yc->ten_yeu_cau,
                    'mo_ta'=>'Tên yêu cầu: ' .  $yc->ten_yeu_cau,
                ]);

                yeucauton::where('id', $id)->delete();
                chitietyeucau::where('id_yc',$id)->delete();
                loaingay::where('id_yc',$id)->delete();
                thuoctinhyeucau::where('id_yc',$id)->delete();
            }
            return true;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function destroy_yck($request){
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $id = $request->input('id');
            $yccon = thuoctinhyeucau::where('id', $id)->first();
            if ($yccon) {
                $ten_yc_con = $yccon->ten_thuoc_tinh;
                $ten_yc = yeucauton::where('id',$yccon->id)->first();
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Xóa yêu cầu con',
                    'mo_ta'=>'<br>Tên yêu cầu cha: '. $ten_yc->ten_yeu_cau
                        . '<br> Tên yêu cầu con: '. $ten_yc_con
                        . '<br> Nội dung yêu cầu con: '.$yccon->noi_dung_thuoc_tinh,
                ]);
                thuoctinhyeucau::where('id', $id)->delete();
            }
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa thất bại');
            return false;
        }
    }


    public function getyeucau()
    {
        return yeucauton::orderBy('id_don_vi')->orderBy('id')->get();
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

    public function get_min_ngaytiepnhan(){
        return ky::where('chot',1)->orderByDesc('denngay')->first();
    }

}

<?php

namespace App\Service;

use App\Models\donvi;
use App\Models\ky;
use App\Models\kybaocao;
use App\Models\lich_su_thao_tac;
use App\Models\loaingay;
use App\Models\luyke;
use App\Models\yeucauton;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class BaocaoService
{
    public function getky(){
        return ky::get();
    }

    public function getky_year($year){
        return ky::where('nam',$year)->get();
    }

    public function create($request){
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            if ($request->input('chot'))
                $chot = (integer)$request->input('tuan');
            else
                $chot = 0;
            $tungay=explode('/',$request->input('tungay'));
            $denngay=explode('/',$request->input('denngay'));
            ky::create([
                'tuan'=>(integer)$request->input('tuan'),
                'nam'=>(integer)$request->input('nam'),
                'tungay'=>$tungay[2] . '/' . $tungay[1] . '/' . $tungay[0] . ' 00:00:00',
                'denngay'=>$denngay[2] . '/' . $denngay[1] . '/' . $denngay[0] . ' 23:59:59',
                'chot'=>$chot,
                'da_chot'=>0,
            ]);

            lich_su_thao_tac::create([
                'id_nv'=>0,
                'thao_tac'=>'Thêm kỳ báo cáo mới',
                'mo_ta'=>'Tuần : ' . $request->input('tuan')
                    . '<br> Năm: '.$request->input('nam')
                    . '<br> Từ ngày: '.$request->input('tungay')
                    . '<br> Đến ngày: '.$request->input('denngay'),
            ]);


            Session::flash('success', 'Thêm  thành công kỳ: tuần ' . $request->input('tuan') . ' năm ' . $request->input('nam') );
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }


    public function getnam(){
        return ky::DISTINCT()->select('nam')->get();
    }


    public function chot_ky($ky,$request){
        date_default_timezone_set("Asia/Ho_Chi_Minh");
       if($ky->chot==0){
           $id_don_vi = $request->input('id_dv');
           $luy_ke_hang_tuan = $request->input('luyke');
           $tuan = $request->input('tuan');
           $nam = $request->input('nam');
           $luyke_donvi = luyke::where('tuan',$tuan[0])->where('nam',$nam[0])->first();
           if ($luyke_donvi){
               foreach ($id_don_vi as $key => $dv){
                    $luyke_donvi->id_don_vi=(integer)$dv;
                    $luyke_donvi->luy_ke_hang_tuan=(integer)$luy_ke_hang_tuan[$key];
                    $luyke_donvi->tuan=(integer)$tuan[$key];
                    $luyke_donvi->nam=(integer)$nam[$key];
                    $luyke_donvi->save();
               }
           }else{
               foreach ($id_don_vi as $key => $dv){
                   luyke::create([
                       'id_don_vi'=>(integer)$dv,
                       'luy_ke_hang_tuan'=>(integer)$luy_ke_hang_tuan[$key],
                       'tuan'=>(integer)$tuan[$key],
                       'nam'=>(integer)$nam[$key],
                   ]);
               }
           }

           lich_su_thao_tac::create([
               'id_nv'=>0,
               'thao_tac'=>'Chốt kỳ',
               'mo_ta'=>' Chốt kỳ'
                   . '<br>  Tuần : ' . $request->input('tuan')[0]
                   . '<br> Năm: '.$request->input('nam')[0],
           ]);

           if ($ky->da_chot == 0){
               $ky->da_chot = 1;
           }
           $ky->chot = 1;
           $ky->save();
       }else{
           $ky->chot = 0;
           $ky->save();

           lich_su_thao_tac::create([
               'id_nv'=>0,
               'thao_tac'=>'Hủy chốt',
               'mo_ta'=>' Hủy chốt kỳ'
                   . '<br>  Tuần : ' . $request->input('tuan')[0]
                   . '<br> Năm: '.$request->input('nam')[0],
           ]);

       }
       return true;
    }

    public function destroy_ky($request){
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $id = $request->input('id');
            $ky = ky::where('id', $id)->first();

            if (luyke::where('tuan',$ky->tuan)->where('nam',$ky->nam)->first()){
                Session::flash('error', 'Không được xóa kỳ đã chốt');
                return false;
            }

            if ($ky) {
                lich_su_thao_tac::create([
                    'id_nv'=>0,
                    'thao_tac'=>'Xóa kỳ báo cáo',
                    'mo_ta'=>'Xóa kỳ'
                        . '<br>  Tuần : ' . $ky->tuan
                        . '<br> Năm: '. $ky->nam,
                ]);
                ky::where('id',$id)->delete();
            }
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa thất bại');
            return false;
        }
    }

    public function get_yc_tiepnhan($ky){
        $cac_yc_tiepnhan =   DB::table('cac_yc_tiepnhan')->select('id_yc')
            ->where('ngaytiepnhan','>=',$ky->tungay)
            ->where('ngaytiepnhan','<=',$ky->denngay)->get();

        $id_yc = [];

        foreach ($cac_yc_tiepnhan as $id){
            $id_yc[] = $id->id_yc;
        }
        return yeucauton::whereIN('id',$id_yc)->get();
    }

    public function get_yc_hoanthanh($ky){
        $cac_yc_tiepnhan =   DB::table('cac_yc_hoanthanh')->select('id_yc')
            ->where('ngayhoanthanh','>=',$ky->tungay)
            ->where('ngayhoanthanh','<=',$ky->denngay)->get();

        $id_yc = [];

        foreach ($cac_yc_tiepnhan as $id){
            $id_yc[] = $id->id_yc;
        }
        return yeucauton::whereIN('id',$id_yc)->get();
    }

    public function get_yc_dangcode($ky){
        $cac_yc_tiepnhan =   DB::table('cac_yc_dangcode')->select('id_yc')
            ->where('ngaygiaoviec','>=',$ky->tungay)
            ->where('ngaygiaoviec','<=',$ky->denngay)->get();

        $id_yc = [];

        foreach ($cac_yc_tiepnhan as $id){
            $id_yc[] = $id->id_yc;
        }
        return yeucauton::whereIN('id',$id_yc)->get();
    }

    public function get_yc_hostfix($ky){
        $cac_yc_tiepnhan =   DB::table('cac_yc_hostfix')->select('id_yc')
            ->where('ngayhostfix','>=',$ky->tungay)
            ->where('ngayhostfix','<=',$ky->denngay)->get();

        $id_yc = [];

        foreach ($cac_yc_tiepnhan as $id){
            $id_yc[] = $id->id_yc;
        }
        return yeucauton::whereIN('id',$id_yc)->get();
    }


    public function get_luyke_ky($ky){
        $dv = DB::table('luyke_hang_tuan_cac_dv')
            ->where('tuan',$ky->tuan)
            ->where('nam',$ky->nam)
            ->orderByDesc('uu_tien')
            ->get();
        return $dv;
    }


}

<?php

namespace App\Service;

use App\Models\donvi;
use App\Models\ky;
use App\Models\kybaocao;
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
            if ($request->input('chot'))
                $chot = (integer)$request->input('tuan');
            else
                $chot = 0;
            $tungay=explode('/',$request->input('tungay'));
            $denngay=explode('/',$request->input('denngay'));
            ky::create([
                'tuan'=>(integer)$request->input('tuan'),
                'nam'=>(integer)$request->input('nam'),
                'tungay'=>$tungay[2] . '/' . $tungay[1] . '/' . $tungay[0],
                'denngay'=>$denngay[2] . '/' . $denngay[1] . '/' . $denngay[0],
                'chot'=>$chot,
            ]);
            Session::flash('success', 'Thêm  thành công kỳ: tuần ' . $request->input('tuan') . ' năm ' . $request->input('nam') );
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
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


//    public function get_luyke_don_vi(){
//        $donvi = donvi::where('hoat_dong',1)->get();
//        $id_dv = [];
//
//        foreach ($donvi as $dv){
//            $id_dv[] = $dv->id;
//        }
//
//
//        $luyke = luyke::whereIN('id_don_vi',$id_dv)
//            ->orderByDesc('tuan')
//            ->orderByDesc('nam')
//            ->paginate(count($id_dv));
//        return $luyke;
//    }


    public function getnam(){
        return ky::DISTINCT()->select('nam')->get();
    }


    public function chot_ky($ky,$request){
       if($ky->chot==0){
           $id_don_vi = $request->input('id_dv');
           $luy_ke_hang_tuan = $request->input('luyke');
           $tuan = $request->input('tuan');
           $nam = $request->input('nam');
           $luyke_donvi =luyke::where('tuan',$tuan[0])->where('nam',$nam[0])->first();
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

           $ky->chot = 1;
           $ky->save();
       }else{
           $ky->chot = 0;
           $ky->save();

       }
       return true;
    }

    public function destroy_ky($request){
        try {
            $id = $request->input('id');
            $ky = ky::where('id', $id)->first();

            if (luyke::where('tuan',$ky->tuan)->where('nam',$ky->nam)->first()){
                Session::flash('error', 'Không được xóa kỳ đã chốt');
                return false;
            }

            if ($ky) {
                ky::where('id',$id)->delete();
            }
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Xóa thất bại');
            return false;
        }
    }


}

<?php

namespace App\Service;

use App\Models\donvi;
use App\Models\ky;
use App\Models\kybaocao;
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


    public function getnam(){
        return ky::DISTINCT()->select('nam')->get();
    }


    public function chot_ky($ky){
       if($ky->chot==0){
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

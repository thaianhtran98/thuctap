<?php

namespace App\Service;

use App\Models\loaingay;
use App\Models\yeucauton;
use Illuminate\Support\Facades\Session;

class YeucauService
{
    public function create($request)
    {
        try {
            $ngaytiepnhan=explode('/',$request->input('ngaytiepnhan'));
            $ngayhoanthanhdukien=explode('/',$request->input('ngayhoanthanhdukien'));
            yeucauton::create([
                'ten_yeu_cau' => (string)$request->input('ten_yeu_cau'),
                'id_loai_chuong_trinh' => (integer)$request->input('id_loai_chuong_trinh'),
                'id_don_vi' => (integer)$request->input('id_don_vi'),
                'trang_thai' => (integer)$request->input('trang_thai'),
                'noi_dung_yc' => (string)$request->input('noi_dung_yc'),
                'hoat_dong' => (int)$request->input('active'),
            ]);
            $yc = yeucauton::where('ten_yeu_cau',$request->input('ten_yeu_cau'))->
            where('id_loai_chuong_trinh',(integer)$request->input('id_loai_chuong_trinh'))->
            where('id_don_vi',(integer)$request->input('id_don_vi'))->first();

            loaingay::create([
                'id_yc' => $yc->id,
                'ngaytiepnhan' => $ngaytiepnhan[2] . '/' . $ngaytiepnhan[1] . '/' . $ngaytiepnhan[0],
                'ngayhoanthanhdukien' => $ngayhoanthanhdukien[2] . '/' . $ngayhoanthanhdukien[1] . '/' . $ngayhoanthanhdukien[0],
//                'ngayhoanthanhdukien'=> date_format('yyyy/mm/dd', $request->input('ngayhoanthanhdukien')),
            ]);
            Session::flash('success', 'Thêm  thành công ' . $request->input('name'));
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function getyeucau()
    {
        return yeucauton::orderBy('id')->get();
    }
}

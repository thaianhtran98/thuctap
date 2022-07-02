<div class="row">
    <label style="font-size: 20px;color: #007bff">
        Các Yêu Cầu Phát Sinh
    </label>

    <div class="col-md-12">
        <table id="table_tiepnhan" class="table table-bordered" style="width: 100%">
            <thead style="background: #0c84ff;color: white;">
            <tr>
                <th style="text-align: center;width: 1%;">STT</th>
                <th style="text-align: center;width: 20%;">Đơn Vị</th>
                <th style="text-align: center;width: 20%;">Tên Yêu Cầu</th>
                <th style="text-align: center;width: 30%;">Nội Dung Yêu Cầu</th>
                <th style="text-align: center;width: 10%;">Chương Trình</th>
                <th style="text-align: center;width: 10%;;">Ngày Tiếp Nhận</th>
            </tr>
            </thead>
            <tbody>
            @foreach($yeucau_tiepnhan as $key => $yc)
                <tr>
                    <td style="text-align:center;width: 1%;">{{$key+1}}</td>
                    <td style="width: 20%;">{{$yc->yc_dv->ten_don_vi}}</td>
                    @if(strlen($yc->ten_yeu_cau)<50)
                        <td  style="line-height: normal;width: 20%;text-align: left">
                            {{$yc->ten_yeu_cau}}
                        </td>
                    @else
                        <td  style="line-height: normal;width: 20%;text-align: left">
                            {!! substr($yc->ten_yeu_cau,0,50) !!}...
                        </td>
                    @endif

                    @if(strlen($yc->noi_dung_yc)<50)
                        <td style="line-height: normal; width: 30%;text-align: left">
                            {{$yc->noi_dung_yc}}
                        </td>
                    @else
                        <td style="line-height: normal; width: 30%;text-align: left" title="{{$yc->noi_dung_yc}}">
                            {!! substr($yc->noi_dung_yc,0,50) !!}...
                        </td>
                    @endif
                    <td style="text-align: center;width: 10%;">{{$yc->yc_ct->ten_chuong_trinh}}</td>
                    <td  style="text-align: left;width: 10%;">
                        {{DateTime::createFromFormat('Y-m-d',$yc->yc_loaingay->ngaytiepnhan)->format('d/m/Y')}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

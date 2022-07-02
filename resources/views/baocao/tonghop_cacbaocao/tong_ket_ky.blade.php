<div class="row">
    <label style="font-size: 20px;color: #007bff">
        Báo cáo lũy kế của các đơn vị trong kỳ {{$ky_dang_baocao->tuan}} - {{$ky_dang_baocao->nam}}: Từ  {{DateTime::createFromFormat('Y-m-d',$ky_dang_baocao->tungay)->format('d/m/Y')}}  đến {{DateTime::createFromFormat('Y-m-d',$ky_dang_baocao->denngay)->format('d/m/Y')}}
    </label>

    <div class="col-md-12">
        <table id="table_tongket" class="table table-bordered" style="width: 100%">
            <thead style="background: #0c84ff;color: white;">
            <tr>
                <th style="text-align: center;width: 1%;">STT</th>
                <th style="text-align: center;width: 10%;">Đơn Vị</th>
                <th style="text-align: center;width: 10%;">Lũy kế</th>
                <th style="text-align: center;width: 10%;">Tổng SLYC</th>
                <th style="text-align: center;width: 10%;">SLYC Phát Sinh</th>
                <th style="text-align: center;width: 10%;">SLYC Đang Code</th>
                <th style="text-align: center;width: 10%;">SLYC Hoàn Thành Chưa Hostfix</th>
                <th style="text-align: center;width: 10%;">SLYC Hoàn Thành Đã Hostfix</th>
            </tr>
            </thead>
            <tbody>
            @foreach($donvi as $key => $dv)
                @php
                    $have = 0
                @endphp
                <tr>
                    <td style="text-align:center;width: 1%;">{{$key+1}}</td>
                    <td style="width: 20%; text-align: left;">{{$dv->ten_don_vi}}</td>
                    @foreach($luyke_ky as $luyke)
                        @if($dv->id == $luyke->id)
                            @if($dv->luyke_donvi_tuan($ky_dang_baocao->tuan,$ky_dang_baocao->nam))
                            <td style="width: 10%; text-align: right;">
        {{ $dv->luyke_donvi_tuan($ky_dang_baocao->tuan,$ky_dang_baocao->nam)->luy_ke_hang_tuan}}</td>
                            @else
                            <td style="width: 10%; text-align: right;">
        {{$luyke->so_yc_trong_tuan + $dv->luyke_donvi[0]->luy_ke_hang_tuan}}</td>
                            @endif
                            <td style="width: 10%; text-align: right;">{{$luyke->so_yc_trong_tuan}}</td>

                            @php
                                $SLphatsinh = 0
                            @endphp
                            @foreach($yeucau_tiepnhan as $tiepnhan)
                                @if($dv->id == $tiepnhan->id_don_vi)
                                    @php
                                        $SLphatsinh += 1
                                    @endphp
                                @endif
                            @endforeach
                            <td style="width: 10%; text-align: right;">{{$SLphatsinh}}</td>

                            @php
                                $SLdangcode = 0
                            @endphp
                            @foreach($yeucau_dangcode as $dangcode)
                                @if($dv->id == $dangcode->id_don_vi)
                                    @php
                                        $SLdangcode += 1
                                    @endphp
                                @endif
                            @endforeach
                            <td style="width: 10%; text-align: right;">{{$SLdangcode}}</td>

                            @php
                                $SLhoanthanh = 0
                            @endphp
                            @foreach($yeucau_hoanthanh as $hoanthanh)
                                @if($dv->id == $hoanthanh->id_don_vi)
                                    @php
                                        $SLhoanthanh += 1
                                    @endphp
                                @endif
                            @endforeach
                            <td style="width: 10%; text-align: right;">{{$SLhoanthanh}}</td>


                            @php
                                $SLhostfix = 0
                            @endphp
                            @foreach($yeucau_hostfix as $hostfix)
                                @if($dv->id == $hostfix->id_don_vi)
                                    @php
                                        $SLhostfix += 1
                                    @endphp
                                @endif
                            @endforeach
                            <td style="width: 10%; text-align: right;">{{$SLhostfix}}</td>


                            @php
                                $have +=1
                            @endphp

                            <input type="text"  style="display:none;" name="id_don_vi_chotky" value="{{$dv->id}}">
                            <input type="text"  style="display:none;" name="luy_ke_hang_tuan_chotky" value="{{$luyke->so_yc_trong_tuan + $dv->luyke_donvi[0]->luy_ke_hang_tuan}}">
                            <input type="text"  style="display:none;" name="tuan_chotky" value="{{$ky_dang_baocao->tuan}}">
                            <input type="text"  style="display:none;" name="nam_chotky" value="{{$ky_dang_baocao->nam}}">
                            @break
                        @endif
                    @endforeach
                    @if($have==0)
                        <td style="width: 10%; text-align: right;">{{ $dv->luyke_donvi[0]->luy_ke_hang_tuan}}</td>
                        <td style="width: 10%; text-align: right;">0</td>
                        <td style="width: 10%; text-align: right;">0</td>
                        <td style="width: 10%; text-align: right;">0</td>
                        <td style="width: 10%; text-align: right;">0</td>
                        <td style="width: 10%; text-align: right;">0</td>
                        <input type="text"  style="display:none;" name="id_don_vi_chotky" value="{{$dv->id}}">
                        <input type="text"  style="display:none;" name="luy_ke_hang_tuan_chotky" value="{{$dv->luyke_donvi[0]->luy_ke_hang_tuan}}">
                        <input type="text"  style="display:none;" name="tuan_chotky" value="{{$ky_dang_baocao->tuan}}">
                        <input type="text"  style="display:none;" name="nam_chotky" value="{{$ky_dang_baocao->nam}}">
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table_tongket').DataTable( {
            pagingType: 'full_numbers',
            "language": {
                "sProcessing":   "Đang xử lý...",
                "sZeroRecords":  "Không tìm có kết quả",
                "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                "sInfoPostFix":  "",
                "sSearch":       "Tìm:",
                "sUrl":          "",
                "sLengthMenu":   "Xem _MENU_ Mục",
                "oPaginate": {
                    "sFirst":    "Đầu",
                    "sPrevious": "<",
                    "sNext":     ">",
                    "sLast":     "Cuối"
                }
            },
            "processing": true, // tiền xử lý trước
            "aLengthMenu": [[ 10, 20, 50], [10, 20, 50]], // danh sách số trang trên 1 lần hiển thị bảng
            "order": [[ 0, 'asc' ]], //sắp xếp giảm dần theo cột thứ 1
            "scrollY": "515px",
            "scrollCollapse": true,
        } );
    } );
</script>

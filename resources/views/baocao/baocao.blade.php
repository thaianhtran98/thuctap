@extends('main')
@section('content')
    @include('alert')

    <div class="m-t-50 m-r-20 m-l-20">
        <div class="row" >
            <div class="col-md-3" style="margin-left: 2%">
{{--                {{$ky_hientai->nam}}--}}
            </div>
            <div class="col-md-1">
                <label for="menu">Năm</label>
                <select id="nam" name="nam" class="form-control">
                    @foreach($nams as $nam)
                        <option {{$nam->nam ==$ky_dang_baocao->nam ? 'selected':''}} value="{{$nam->nam}}">
                            {{$nam->nam}}
                        </option>
                    @endforeach
                </select>
                <br>
            </div>
            <div class="col-md-3">
                <label for="menu">Kỳ</label>
                <select id="ky" name="ky" class="form-control">
                    @foreach($ky as $k)
                        @if($ky_dang_baocao->nam== DateTime::createFromFormat('Y-m-d',$k->tungay)->format('Y'))
                            <option {{$k->id ==$ky_dang_baocao->id ? 'selected':''}} value="{{$k->id}}">
                                Kỳ {{$k->tuan}}: Từ {{DateTime::createFromFormat('Y-m-d',$k->tungay)->format('d/m/Y')}} đến {{DateTime::createFromFormat('Y-m-d',$k->denngay)->format('d/m/Y')}}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-2" style="line-height: 88px">
                <button class="form-control btn btn-primary" onclick="xembaocao()">
                    Xem báo cáo
                </button>
            </div>

            @if($ky_dang_baocao->chot == 0)
                <button class="form-control btn btn-success" style="float: right;margin-right: 10px;margin-left: auto; width: 100px;margin-top: 1.5%" onclick="chot({{$ky_dang_baocao->id}})">
                    Chốt
                </button>
            @else
                <button class="form-control btn btn-danger" style="float: right;margin-right: 10px;margin-left: auto; width: 100px;margin-top: 1.5%" onclick="chot({{$ky_dang_baocao->id}})">
                    Hủy Chốt
                </button>
            @endif
        </div>
        <hr>

{{--        Các yêu cầu phát sinh--}}
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

        <hr>

{{--Các yêu cầu đang code--}}
        <div class="row">
            <label style="font-size: 20px;color: #007bff">
                Các Yêu Cầu Đang Code
            </label>

            <div class="col-md-12">
                <table id="table_tiepnhan" class="table table-bordered" style="width: 100%">
                    <thead style="background: #0c84ff;color: white">
                    <tr>
                        <th style="text-align: center;width: 1%;">STT</th>
                        <th style="text-align: center;width: 20%;">Đơn Vị</th>
                        <th style="text-align: center;width: 20%;">Tên Yêu Cầu</th>
                        <th style="text-align: center;width: 30%;">Nội Dung Yêu Cầu</th>
                        <th style="text-align: center;width: 10%;">Chương Trình</th>
                        <th style="text-align: center;width: 10%;">Ngày Giao Việc</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($yeucau_dangcode as $key => $yc)
                        <tr>
                            <td style=text-align:center;>{{$key+1}}</td>
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
                            <td style="text-align: center">{{$yc->yc_ct->ten_chuong_trinh}}</td>
                            <td>
                                {{DateTime::createFromFormat('Y-m-d',$yc->yc_loaingay->ngaygiaoviec)->format('d/m/Y')}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
{{--Các yêu cầu đã hoàn thành--}}
        <div class="row">
            <label style="font-size: 20px;color: #007bff">
                Các Yêu Cầu Đã Hoàn Thành
            </label>

            <div class="col-md-12">
                <table id="table_hoanthanh" class="table table-bordered" style="width: 100%">
                    <thead style="background: #0c84ff;color: white">
                        <tr>
                            <th style="text-align: center;width: 1%;">STT</th>
                            <th style="text-align: center;width: 20%;">Đơn Vị</th>
                            <th style="text-align: center;width: 20%;">Tên Yêu Cầu</th>
                            <th style="text-align: center;width: 30%;">Nội Dung Yêu Cầu</th>
                        <th style="text-align: center;width: 10%;">Chương Trình</th>
                            <th style="text-align: center;width: 10%;">Ngày Hoàn Thành</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($yeucau_hoanthanh as $key => $yc)
                        <tr>
                            <td style=text-align:center;>{{$key+1}}</td>
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
                            <td style="text-align: center">{{$yc->yc_ct->ten_chuong_trinh}}</td>
                            <td>
                                {{DateTime::createFromFormat('Y-m-d',$yc->yc_loaingay->ngayhoanthanh)->format('d/m/Y')}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
{{--Các yêu cầu đã hostfixx--}}
        <div class="row">
            <label style="font-size: 20px;color: #007bff">
                Các Yêu Cầu Đã Hostfix/Upcode
            </label>

            <div class="col-md-12">
                <table id="table_hostfix" class="table table-bordered" style="width: 100%">
                    <thead style="background: #0c84ff;color: white">
                    <tr>
                        <th style="text-align: center;width: 1%;">STT</th>
                        <th style="text-align: center;width: 20%;">Đơn Vị</th>
                        <th style="text-align: center;width: 20%;">Tên Yêu Cầu</th>
                        <th style="text-align: center;width: 30%;">Nội Dung Yêu Cầu</th>
                        <th style="text-align: center;width: 10%;">Chương Trình</th>
                        <th style="text-align: center;width: 10%;">Ngày hostfix</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($yeucau_hostfix as $key => $yc)
                        <tr>
                            <td style=text-align:center;>{{$key+1}}</td>
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
                            <td style="text-align: center">{{$yc->yc_ct->ten_chuong_trinh}}</td>
                            <td>
                                {{DateTime::createFromFormat('Y-m-d',$yc->yc_loaingay->ngayhostfix)->format('d/m/Y')}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('#table_tiepnhan').DataTable( {
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
        $(document).ready(function() {
            $('#table_hoanthanh').DataTable( {
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
        $(document).ready(function() {
            $('#table_hostfix').DataTable( {
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
        $(document).ready(function() {
            $('#table_giaoviec').DataTable( {
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
        $(document).ready(function() {
            $('#table_bc').DataTable( {
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

    <script>
        $(document).ready(function() {
            $('#nam').bind('change',
                function change_nam(){
                    var url = '/load_ky/';
                    var nam = document.getElementById('nam').value;
                    $.ajax({
                        // cache: false,
                        type: 'POST',
                        datatype: 'JSON',
                        data: { nam },
                        url: url,
                        success:function (result){
                            if (result.error === true){
                                alert('Hiện không có kỳ này');
                                location.reload();
                            }else {
                                console.log(result.kys);
                                var  html='';
                                $.each(result.kys, function (i,item){
                                    var tungay =  item.tungay.substr(8,2) + '/'+ item.tungay.substr(5,2) + '/' +  item.tungay.substr(0,4);
                                    var denngay =  item.denngay.substr(8,2) + '/'+ item.denngay.substr(5,2) + '/' +  item.denngay.substr(0,4);
                                    html +='<option value="'+ item.id +'">';
                                    html +='Kỳ ' + item.tuan + ': Từ ' + tungay + ' đến ' + denngay ;
                                    html +='</option>';
                                });
                                $('#ky').html(html);
                            }
                        }
                    })
                }
            )});


        function xembaocao(){
            window.location = '/xembaocao/'+document.getElementById('ky').value;
        }

        function chot(id){
            var url = '/chot_ky/'+id;
            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                url: url,
                success:function (result){
                    if (result.error === true){
                        location.reload();
                    }else {
                        location.reload();
                    }
                }
            })
        }
    </script>
@endsection

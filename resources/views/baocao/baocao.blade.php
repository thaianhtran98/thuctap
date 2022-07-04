@extends('main')
@section('content')
    <style>
        div.dataTables_wrapper div.dataTables_filter{
            margin-top: 0px;
        }
    </style>
    @include('alert')
    <div class="m-t-50 m-r-20 m-l-20">
        <div class="row" >
            <div class="col-md-3" style="margin-left: 2%">
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
                        @if($ky_dang_baocao->nam == DateTime::createFromFormat('Y-m-d',$k->tungay)->format('Y') )
                            <option {{$k->id == $ky_dang_baocao->id ? 'selected':''}} value="{{$k->id}}">
                                Kỳ {{$k->tuan}}: Từ {{DateTime::createFromFormat('Y-m-d',$k->tungay)->format('d/m/Y')}}
                                đến {{DateTime::createFromFormat('Y-m-d',$k->denngay)->format('d/m/Y')}}
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

        @include('baocao.tonghop_cacbaocao.tong_ket_ky')

        <hr>

{{--        Các yêu cầu phát sinh--}}
        @include('baocao.tonghop_cacbaocao.cac_yc_phat_sinh')

        <hr>

{{--Các yêu cầu đang code--}}
        @include('baocao.tonghop_cacbaocao.cac_yc_dangcode')

        <hr>
{{--Các yêu cầu đã hoàn thành--}}
        @include('baocao.tonghop_cacbaocao.cac_yc_hoanthanh')

        <hr>
{{--Các yêu cầu đã hostfixx--}}
        @include('baocao.tonghop_cacbaocao.cac_yc_hostfix')

    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            var table_tiepnhan = $('#table_tiepnhan').DataTable( {
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
                lengthChange: true,
                buttons: [ 'excel', 'pdf']
            } );
            table_tiepnhan.buttons().container().appendTo( '#table_tiepnhan_wrapper .col-md-6:eq(0)' );
        } );



        $(document).ready(function() {
            var table_hoanthanh =  $('#table_hoanthanh').DataTable( {
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
                lengthChange: true,
                buttons: [ 'excel', 'pdf']
            } );
            table_hoanthanh.buttons().container().appendTo( '#table_hoanthanh_wrapper .col-md-6:eq(0)' );
        } );
        $(document).ready(function() {
            var table_hostfix = $('#table_hostfix').DataTable( {
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
                lengthChange: true,
                buttons: [ 'excel', 'pdf']
            } );
            table_hostfix.buttons().container().appendTo( '#table_hostfix_wrapper .col-md-6:eq(0)' );
        } );
        $(document).ready(function() {
            var table_giaoviec = $('#table_giaoviec').DataTable( {
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
                lengthChange: true,
                buttons: [ 'excel', 'pdf']
            } );
            table_giaoviec.buttons().container().appendTo( '#table_giaoviec_wrapper .col-md-6:eq(0)' );
        } );


        $(document).ready(function() {
            var table_bc = $('#table_bc').DataTable( {
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
                lengthChange: true,
                buttons: [ 'excel', 'pdf']
            } );
            table_bc.buttons().container().appendTo( '#table_bc_wrapper .col-md-6:eq(0)' );
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
            var id_don_vi = document.getElementsByName('id_don_vi_chotky');
            var luy_ke_hang_tuan = document.getElementsByName('luy_ke_hang_tuan_chotky');
            var t = document.getElementsByName('tuan_chotky');
            var n = document.getElementsByName('nam_chotky');

            var id_dv=[];
            var luyke=[];
            var tuan=[];
            var nam=[];
            for (var i = 0 ; i<id_don_vi.length;i++){
                // console.log(id_don_vi[i].value);
                id_dv.push(id_don_vi[i].value);
                luyke.push(luy_ke_hang_tuan[i].value);
                tuan.push(t[i].value);
                nam.push(n[i].value);
            }

            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: {id_dv,luyke,tuan,nam},
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

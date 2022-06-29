@extends('main')


@section('content')

    <div class="row  m-t--40">
        <div class="col-12">
            <div class="alert alert-success"
                 id="thanhcong"
                 style="z-index: 20000;position: absolute;display: none; right: 0;top: 0px; margin-bottom: 10px; margin-left: auto;margin-right: 50px;width: auto;text-align: center">
                Thành công
            </div>
            <div  class="alert alert-danger"
                  id="thatbai"
                  style="z-index: 20000;position: absolute;display: none; right: 0;top: 0px; margin-bottom: 10px; margin-left: auto;margin-right: 50px;width: auto;text-align: center">
                Thất bại
            </div>
        </div>
    </div>
    @include('alert')

    <div class="m-t-50 m-r-10 m-l-10">

{{--            <div class="col-3"></div>--}}
{{--            <div class="col-3">--}}
{{--                <label>Từ ngày</label>--}}
{{--                <input type="date" class="form-control" >--}}
{{--            </div>--}}
{{--            <div class="col-3" style="display: flex">--}}
{{--                <div style="width: 100%">--}}
{{--                    <label>Từ ngày</label>--}}
{{--                    <input type="date" class="form-control" >--}}
{{--                </div>--}}
{{--                <button style="width: 30px;height: 30px;margin-top: 30px;margin-left: 10px">--}}
{{--                  <span>--}}
{{--                    <i class="fas fa-search"></i>--}}
{{--                  </span>--}}
{{--                </button>--}}
{{--            </div>--}}

{{--            <div class="col-3" >--}}
{{--                <a href="/themyeucau">--}}
{{--                    <button class="btn btn-primary" style="float: right; margin-left: auto;margin-right: 8px;margin-top: 28px;" id="show-add-dv" >--}}
{{--                        Thêm Yêu Cầu--}}
{{--                    </button>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <hr>

        <div class="row">
            <div class="col-md-12">
                <a href="/themyeucau">
                    <button class="btn btn-primary" style="float: left; margin-left: 8px;margin-right: auto;margin-bottom: -50px" id="show-add-dv" >
                        Thêm Yêu Cầu
                    </button>
                </a>
                <table id="table_yc" class="table table-bordered nowrap" style="width:100%;">
                    <thead style="background: #0c84ff;color: white">
                    <tr style="text-align: center">
                        <th style="line-height: normal">
                            <input type="checkbox" name="del_all" onclick="delall()"
                                   style="height: 20px;width: 20px; margin: auto">
                        </th>
                        <th style="line-height: normal;">Đơn Vị Yêu Cầu</th>
                        <th>Loại Chương Trình</th>
                        <th>Tên Yêu Cầu</th>
                        <th>Nội Dung yêu cầu</th>
                        <th>Trạng Thái Yêu Cầu</th>
                        <th>Ngày của trạng thái</th>
                        <th>Cập Nhật</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ycs as $yc)
                        <tr id="yc_{{$yc->id}}" style="text-align: center">
                            <td style="line-height: normal;text-align: center; width: 100px">
                                @if($disable_xoa)
                                <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px;margin: auto"
                                       {{$yc->yc_loaingay->ngaytiepnhan <= $disable_xoa->denngay ? 'disabled':''}}
                                       value="{{$yc->id}}">
                                @else
                                    <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px;margin: auto" value="{{$yc->id}}">
                                @endif
                            </td>
                            <td style="line-height: normal;width: 400px">
                                {{$yc->yc_dv->ten_don_vi}}
                            </td>
                            <td  style="line-height: normal;width: 10%">
                                {{$yc->yc_ct->ten_chuong_trinh}}
                            </td>
                            @if(strlen($yc->ten_yeu_cau)<50)
                                <td style="line-height: normal;width: 300px;text-align: left">
                                    {{$yc->ten_yeu_cau}}
                                </td>
                            @else
                                <td  style="line-height: normal;width: 300px;text-align: left">
                                    {!! substr($yc->ten_yeu_cau,0,50) !!}...
                                </td>
                            @endif

                            @if(strlen($yc->noi_dung_yc)<50)
                                <td style="line-height: normal; width: 500px;text-align: left">
                                    {{$yc->noi_dung_yc}}
                                </td>
                            @else
                                <td style="line-height: normal; width: 500px;text-align: left" title="{{$yc->noi_dung_yc}}">
                                    {!! substr($yc->noi_dung_yc,0,50) !!}...
                                </td>
                            @endif
                            <td style="line-height: normal; width: 200px">
                                @if($yc->trang_thai==0)
                                    Tiếp Nhận
                                @elseif($yc->trang_thai==1 || $yc->trang_thai==2 )
                                    Đang Code
                                @elseif($yc->trang_thai==3)
                                    Đã Hoàn Thành
                                @else
                                    Đã Hostfix/Upcode
                                @endif
                            </td>

                            <td style="line-height: normal; width: 200px">
                                @if($yc->trang_thai==0)
                                    {{DateTime::createFromFormat('Y-m-d',$yc->yc_loaingay->ngaytiepnhan)->format('d/m/Y')}}
                                @elseif($yc->trang_thai==1)
                                    {{DateTime::createFromFormat('Y-m-d',$yc->yc_loaingay->ngaygiaoviec)->format('d/m/Y')}}
                                @elseif($yc->trang_thai==2)
                                    {{DateTime::createFromFormat('Y-m-d',$yc->yc_loaingay->ngaygiaoviec)->format('d/m/Y')}}
                                @elseif($yc->trang_thai==3)
                                    {{DateTime::createFromFormat('Y-m-d',$yc->yc_loaingay->ngayhoanthanh)->format('d/m/Y')}}
                                @else
                                    {{DateTime::createFromFormat('Y-m-d',$yc->yc_loaingay->ngayhostfix)->format('d/m/Y')}}
                                @endif
                            </td>

                            <td style="width: 100px">
                                <a href="/yc/edit/{{$yc->id}}">
                                <span style="color: #0a58ca">
                                    <i class="fas fa-edit"></i>
                                </span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <button class="btn btn-danger" type="button" id="button_del" href="#" onclick="delid()"
                        style="display: none; height: 50px;width: 100px;margin-left: 0;margin-right: auto;margin-top: -35.74px">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>


    </div>

@endsection
@section('footer')
    <script>
        function delall() {
            var $iddel = document.getElementsByName('del_id[]');
            var $delall = document.getElementsByName('del_all');
            if ($delall[0].checked === true) {
                document.getElementById('button_del').style.display = 'block';
                for ($i = 0; $i < $iddel.length; $i++) {
                    $iddel[$i].checked = true;
                }
            } else {
                document.getElementById('button_del').style.display = 'none';
                for ($i = 0; $i < $iddel.length; $i++) {
                    $iddel[$i].checked = false;
                }
            }
        }

        function showbutton() {
            var $iddel = document.getElementsByName('del_id[]');

            for ($i = 0; $i < $iddel.length; $i++) {
                if ($iddel[$i].checked === true) {
                    return document.getElementById('button_del').style.display = 'block';
                } else {
                    document.getElementById('button_del').style.display = 'none';
                }
            }
        }

        function delid() {
            if (confirm('Dữ liệu xóa không thể khôi phục. Bạn có muốn xóa không?')) {
                var $iddel = document.getElementsByName('del_id[]');

                for ($i = 0; $i < $iddel.length; $i++) {
                    if ($iddel[$i].checked === true && $iddel[$i].disabled === false) {
                        removeRow($iddel[$i].value, '/yc/destroy');
                        document.getElementById('thanhcong').innerText = 'Xóa thành công yêu cầu';
                        document.getElementById('yc_'+$iddel[$i].value).remove();
                        document.getElementById('thanhcong').style.display = 'block';
                        setTimeout(function(){
                            document.getElementById('thanhcong').style.display = 'none';
                        }, 1500);
                    }
                }
                document.getElementById('button_del').style.display = 'none';

            }
        }
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#table_yc').DataTable( {
                pagingType: 'full_numbers',
                dom: 'Plfrtip',
                "language": {
                    "sProcessing":   "Đang xử lý...",
                    "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
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
                    },
                    searchPanes: {
                        count: '{total} kết quả',
                        countFiltered: '{shown} / {total}',
                        title: {
                            _:''
                        },
                        collapseMessage: 'Ẩn bảng thống kê',
                        showMessage: 'Hiển thị bảng thống kê',
                        clearMessage: 'Chọn lại'
                        // clearer:'Tìm lại'
                    }
                },
                "processing": true, // tiền xử lý trước
                "aLengthMenu": [[ 10, 20, 50], [ 10, 20, 50]], // danh sách số trang trên 1 lần hiển thị bảng
                "order": [[ 1, 'desc' ]], //sắp xếp giảm dần theo cột thứ 1
                columnDefs: [
                    {
                        searchPanes: {
                            show: true
                        },
                        targets: [ 1, 2, 5, 6],
                    },
                ],

                searchPanes: {
                    // clear: false,
                    cascadePanes: true,
                    // viewTotal: false,
                    orderable: false,
                    viewCount: false,
                    // collapse:false,
                    // title:false
                    initCollapsed: true,
                    dtOpts: {
                        select: {
                            style: 'multi'
                        }
                    }
                },
                "scrollY": "500px",
                "scrollCollapse": true,
            } );
            table.searchPanes.container().prependTo(table.table().container());
            table.searchPanes.resizePanes();
        } );
    </script>

    <script>

    </script>
@endsection

@extends('main')


@section('content')
    <div class="m-t-50 m-r-10 m-l-10">
        <div class="row">
            @include('alert')
            <div class="col-12">
                <a href="/themyeucau"> <button class="btn btn-primary" style="float: right;margin-bottom: 10px; margin-left: auto;margin-right: 8px;" id="show-add-dv" >
                        Thêm Yêu Cầu
                    </button></a>
            </div>
        </div>
        <hr>
{{--        <div class="row" style="width: 100%">--}}
            <table id="table_yc" class="table  table-bordered" style="width:100%">
                <thead style="background: #0c84ff;color: white">
                <tr style="text-align: center">
                    <th style="line-height: normal">
                        <input type="checkbox" name="del_all" onclick="delall()"
                               style="height: 20px;width: 20px; margin: auto">

                    </th>
                    <th>Đơn Vị Yêu Cầu</th>
                    <th>Loại Chương Trình</th>
                    <th>Tên Yêu Cầu</th>
                    <th>Nội Dung yêu cầu</th>
                    <th>Trạng Thái Yêu Cầu</th>
                    <th>Cập Nhật</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ycs as $yc)
                    <tr style="text-align: center">
                        <td style="line-height: normal;text-align: center; width: 100px">
                            <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px;margin: auto"
                                   value="{{$yc->id}}">
                        </td>
                        <td style="line-height: normal;width: 400px">
                            {{$yc->yc_dv->ten_don_vi}}
                        </td>
                        <td  style="line-height: normal;width: 200px"style="line-height: normal">
                            {{$yc->yc_ct->ten_chuong_trinh}}
                        </td>

                        @if(strlen($yc->ten_yeu_cau)<50)
                            <td style="line-height: normal;width: 300px">
                                {{$yc->ten_yeu_cau}}
                            </td>
                        @else
                            <td  style="line-height: normal;width: 300px">
                                {{substr($yc->ten_yeu_cau,0,50)}} ...
                            </td>
                        @endif

                        @if(strlen($yc->noi_dung_yc)<50)
                            <td style="line-height: normal; width: 500px">
                                {{$yc->noi_dung_yc}}
                            </td>
                        @else
                            <td style="line-height: normal; width: 500px" title="{{$yc->noi_dung_yc}}">
                                {{substr($yc->noi_dung_yc,0,50)}} ...
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
{{--        </div>--}}

{{--        <div class="row"style="display: flex;justify-content: center;align-items: center;">--}}
{{--            {!! $ycs->links() !!}--}}
{{--            <select style="margin-bottom: 15px;background: #007bff;color: white; padding: 0.5rem 0.75rem;  margin-left: 10px; line-height: 1.25;">--}}
{{--                <option value="10">--}}
{{--                    10--}}
{{--                </option>--}}
{{--                <option value="20">--}}
{{--                    20--}}
{{--                </option>--}}
{{--                <option value="50">--}}
{{--                    50--}}
{{--                </option>--}}
{{--            </select>--}}
{{--        </div>--}}
        <button class="btn btn-danger btn-sm" type="button" id="button_del" href="#" onclick="delid()"
                style="display: none; height: 50px;width: 100px;margin-left: auto;margin-right: 0px">
            <i class="fas fa-trash"></i>
        </button>
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
                    if ($iddel[$i].checked === true) {
                        removeRow($iddel[$i].value, '/yc/destroy');
                    }
                }
                window.location.reload();
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#table_yc').DataTable( {
                pagingType: 'full_numbers',
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
                    }
                },
                "processing": true, // tiền xử lý trước
                "aLengthMenu": [[ 10, 20, 50], [ 10, 20, 50]], // danh sách số trang trên 1 lần hiển thị bảng
                "order": [[ 1, 'desc' ]] //sắp xếp giảm dần theo cột thứ 1
            } );
        } );
    </script>

@endsection

<div id="vungtrong" style="border: 2px">
    <table id="table_lct" class="table table-bordered" style="width:100%">
        <thead style="background: #0c84ff;color: white">
        <tr style="text-align: center">
{{--            <th style="line-height: normal">--}}
{{--                <input type="checkbox" name="del_all" onclick="delall()" style="height: 20px;width: 20px; float: left">--}}
{{--                Xóa--}}
{{--            </th>--}}
            <th>Chương Trình</th>
            <th>Tình Trạng Hoạt Động</th>
        </tr>
        </thead>
        <tbody style="text-align: center;">
        @foreach($cts as $ct)
            <tr>
{{--                <td style="line-height: normal">--}}
{{--                    <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px"--}}
{{--                           value="{{$ct->id}}">--}}
{{--                </td>--}}
                <td ondblclick="showeditten{{$ct->id}}()">
                    <a id="ten_dv_{{$ct->id}}" style="display: block">{{$ct->ten_chuong_trinh}}</a>
                    <input id="edit_ten_dv_{{$ct->id}}" style="display: none;border: 1px solid rgba(4,4,19,0.93);"
                           value="{{$ct->ten_chuong_trinh}}">
                </td>
                <td style="text-align: center">
                    <div id="parent_active_{{$ct->id}}">
                    </div>
                    {!!  \App\Http\Helper\Helper::active($ct->hoat_dong,$ct->id,"/ct/change/".$ct->id) !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="btn btn-danger btn-sm" type="button" id="button_del" href="#"
            onclick="delid()" style="display: none; height: 50px;width: 100px">
        <i class="fas fa-trash"></i>
    </button>
</div>

@section('footer')
    <script>
        $(document).ready(function() {
            $('#table_lct').DataTable( {
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
                "order": [[ 1, 'desc' ]], //sắp xếp giảm dần theo cột thứ 1
                "scrollY": "500px",
                "scrollCollapse": true,
            } );
        } );
    </script>
    <script>
        $(document).keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                @foreach($cts as $ct)
                document.getElementById('ten_dv_{{$ct->id}}').style.display = 'block';
                document.getElementById('edit_ten_dv_{{$ct->id}}').style.display = 'none';
                @endforeach
            }
        });

        @foreach($cts as $ct)
        function showeditten{{$ct->id}}() {
            document.getElementById('edit_ten_dv_{{$ct->id}}').style.display = 'block';
            document.getElementById('ten_dv_{{$ct->id}}').style.display = 'none';
        }

        $(document).ready(function () {
            $('#edit_ten_dv_{{$ct->id}}').bind('change',
                function store_ten() {
                    edit_ten = document.getElementById('edit_ten_dv_{{$ct->id}}');
                    ten_dv = document.getElementById('ten_dv_{{$ct->id}}');
                    edit_ten.style.display = 'none';
                    ten_dv.style.display = 'block';
                    ten_dv.innerHTML = edit_ten.value;
                    ten_change = edit_ten.value;
                    edit_ten_dv('/ct/edit_ct/{{$ct->id}}', ten_change);
                }
            );
        });

        @endforeach


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
                        removeRow($iddel[$i].value, '/ct/destroy');
                    }
                }
                location.reload();
            }
        }

        function edit_ten_dv(url, ten = '') {
            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: {ten},
                url: url,
            })
        }
    </script>
@endsection

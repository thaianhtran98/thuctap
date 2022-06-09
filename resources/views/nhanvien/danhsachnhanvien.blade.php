<div id="vungtrong" style="border: 2px">
    <table class="table">
        <thead style="background: #0c84ff;color: white">
        <tr style="text-align: center">
            <th style="line-height: normal">
                <input type="checkbox" name="del_all" onclick="delall()" style="height: 20px;width: 20px; float: left">
                Xóa
            </th>
            <th>Tên Nhân Viên</th>
            <th>Tình Trạng Hoạt Động</th>
        </tr>
        </thead>
        <tbody>
        @foreach($nvs as $nv)
            <tr>
                <td style="line-height: normal">
                    <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px"
                           value="{{$nv->id}}">
                </td>
                {{--                <td ondblclick="showedituutien{{$nv->id}}()">--}}
                {{--                    <a id="dv_uu_tien_{{$nv->id}}" style="display: block">{{$nv->uu_tien}}</a>--}}
                {{--                    <input id="edit_dv_uu_tien_{{$nv->id}}" style="display: none;border: 1px solid rgba(4,4,19,0.93);"--}}
                {{--                           value="{{$nv->uu_tien}}">--}}
                {{--                </td>--}}
                <td ondblclick="showeditten{{$nv->id}}()">
                    <a id="ten_dv_{{$nv->id}}" style="display: block">{{$nv->ten_nguoi_thuc_hien}}</a>
                    <input id="edit_ten_dv_{{$nv->id}}" style="display: none;border: 1px solid rgba(4,4,19,0.93);"
                           value="{{$nv->ten_nguoi_thuc_hien}}">
                </td>
                {{--                <td style="text-align: center" ondblclick="showeditluyke{{$nv->id}}()" id="luyke_dv">--}}
                {{--                    <a id="luyke_dv_{{$nv->id}}" style="display: block">{{$nv->luy_ke_dau_ky}}</a>--}}
                {{--                    <input id="edit_luyke_dv_{{$nv->id}}" style="display: none;border: 1px solid rgba(4,4,19,0.93);"--}}
                {{--                           value="{{$nv->luy_ke_dau_ky}}">--}}
                {{--                </td>--}}
                <td style="text-align: center">
                    <div id="parent_active_{{$nv->id}}">
                    </div>
                    {!!  \App\Http\Helper\Helper::active($nv->hoat_dong,$nv->id,"/nv/change/".$nv->id) !!}
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
        $(document).keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                @foreach($nvs as $nv)
                document.getElementById('ten_dv_{{$nv->id}}').style.display = 'block';
                document.getElementById('edit_ten_dv_{{$nv->id}}').style.display = 'none';
                @endforeach
            }
        });

        @foreach($nvs as $nv)
        function showeditten{{$nv->id}}() {
            document.getElementById('edit_ten_dv_{{$nv->id}}').style.display = 'block';
            document.getElementById('ten_dv_{{$nv->id}}').style.display = 'none';
        }

        $(document).ready(function () {
            $('#edit_ten_dv_{{$nv->id}}').bind('change',
                function store_ten() {
                    edit_ten = document.getElementById('edit_ten_dv_{{$nv->id}}');
                    ten_dv = document.getElementById('ten_dv_{{$nv->id}}');
                    edit_ten.style.display = 'none';
                    ten_dv.style.display = 'block';
                    ten_dv.innerHTML = edit_ten.value;
                    ten_change = edit_ten.value;
                    edit_ten_dv('/nv/edit_nv/{{$nv->id}}', ten_change);
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
                        removeRow($iddel[$i].value, '/nv/destroy');
                    }
                }
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

<div style="border: 2px">
    <table class="table"  style="text-align: center">
        <thead style="background: #0c84ff;color: white">
        <tr style="text-align: center">
{{--            <th style="line-height: normal">--}}
{{--                <input type="checkbox" name="del_all" onclick="delall()" style="height: 20px;width: 20px; float: left">--}}
{{--                Xóa--}}
{{--            </th>--}}
            <th>Tên Nhân Viên</th>
            <th>Tình Trạng Hoạt Động</th>
        </tr>
        </thead>
        <tbody id="list_nv">
        @foreach($nvs as $nv)
            <tr>
{{--                <td style="line-height: normal">--}}
{{--                    <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px"--}}
{{--                           value="{{$nv->id}}">--}}
{{--                </td>--}}
                <td ondblclick="showeditten{{$nv->id}}()">
                    <a id="ten_dv_{{$nv->id}}" style="display: block">{{$nv->ten_nguoi_thuc_hien}}</a>
                    <input id="edit_ten_dv_{{$nv->id}}" style="display: none;border: 1px solid rgba(4,4,19,0.93);"
                           value="{{$nv->ten_nguoi_thuc_hien}}">
                </td>
                <td style="text-align: center">
                    <div id="parent_active_{{$nv->id}}">
                    </div>
                    {!!  \App\Http\Helper\Helper::active($nv->hoat_dong,$nv->id,"/nv/change/".$nv->id) !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="btn btn-danger btn-sm" type="button" id="button_del_nv" href="#"
            onclick="delid()" style="display: none; height: 50px;width: 100px">
        <i class="fas fa-trash"></i>
    </button>
</div>

<script>
    $(document).keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            @foreach($nvs as $dv)
            document.getElementById('ten_dv_{{$dv->id}}').style.display = 'block';
            document.getElementById('edit_ten_dv_{{$dv->id}}').style.display = 'none';
            @endforeach
        }
    });
</script>

@section('footer')

    <script>
        function show_add_nv() {
            document.getElementById('form-add').style.display = 'block';
            // document.getElementById('form-add').style.display = 'absolute';
            document.getElementById('form-add').style.background = 'white';
            document.getElementById('body').style.display = 'block';
            document.getElementById('header').style.position = '';
        }

        function show_add_nhom_nv() {
            document.getElementById('form_add_nhom').style.display = 'block';
            document.getElementById('form_add_nhom').style.background = 'white';
            document.getElementById('body').style.display = 'block';
            document.getElementById('header').style.position = '';
        }

        function page_normal() {
            document.getElementById('body').style.display = 'none';
            document.getElementById('form-add').style.display = 'none';
            document.getElementById('form_add_nhom').style.display = 'none';
            document.getElementById('header').style.position = 'fixed';
        }
    </script>

    <script>


        $('#ten_nv').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#active').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });
        $('#active').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#no_active').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });

        $('#no_active').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#add_nv').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });



        function add_nv(){
            console.log(document.getElementById('ten_nv').value)
            let tennv =document.getElementById('ten_nv').value;
            if (document.getElementById('active').checked===true)
                add_nv_post(tennv,1);
            else
                add_nv_post(tennv,0);
        }

        function add_nv_post( ten_nv = '',hoat_dong = '') {
            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: {ten_nv, hoat_dong},
                url: '/themnhanvien',
                success:function (result){
                    if(result.error === false){
                        location.reload();
                    }else {
                        alert('Tên đơn vị đã tồn tại hoặc không phù hợp')
                    }
                }
            })
        }

    </script>

    <script>

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
                    console.log(ten_change)
                    edit_ten_dv('/nv/edit_nv/{{$nv->id}}', ten_change);
                    // location.reload();
                }
            );
        });
    @endforeach

    function edit_ten_dv(url, ten = '') {
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: {ten},
            url: url,
        })
    }

    function delall() {
        var $iddel = document.getElementsByName('del_id[]');
        var $delall = document.getElementsByName('del_all');
        if ($delall[0].checked === true) {
            document.getElementById('button_del_nv').style.display = 'block';
            for ($i = 0; $i < $iddel.length; $i++) {
                $iddel[$i].checked = true;
            }
        } else {
            document.getElementById('button_del_nv').style.display = 'none';
            for ($i = 0; $i < $iddel.length; $i++) {
                $iddel[$i].checked = false;
            }
        }
    }

    function showbutton() {
        var $iddel = document.getElementsByName('del_id[]');

        for ($i = 0; $i < $iddel.length; $i++) {
            if ($iddel[$i].checked === true) {
                return document.getElementById('button_del_nv').style.display = 'block';
            } else {
                document.getElementById('button_del_nv').style.display = 'none';
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
            location.reload();
        }
    }
</script>
@endsection

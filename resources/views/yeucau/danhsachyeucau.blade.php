@extends('main')
@section('content')
    <div class="container-xl m-t-50">
        <table class="table">
            <thead style="background: #0c84ff;color: white">
            <tr style="text-align: center">
                <th style="line-height: normal">
                    <input type="checkbox" name="del_all" onclick="delall()"
                           style="height: 20px;width: 20px; float: left">
                    Xóa
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
                    <td style="line-height: normal">
                        <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px"
                               value="{{$yc->id}}">
                    </td>
                    <td style="line-height: normal">
                        {{$yc->yc_dv->ten_don_vi}}
                    </td>
                    <td style="line-height: normal">
                        {{$yc->yc_ct->ten_chuong_trinh}}
                    </td>
                    <td style="line-height: normal">
                        {{$yc->ten_yeu_cau}}
                    </td>
                    <td style="line-height: normal">
                        {{$yc->noi_dung_yc}}
                    </td>
                    <td style="line-height: normal">
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
                    <td>
                        <span style="color: #0a58ca">
                            <i class="fas fa-edit"></i>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
                        removeRow($iddel[$i].value, '/nv/destroy');
                    }
                }
            }
        }

    </script>
@endsection
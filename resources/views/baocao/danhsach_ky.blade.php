<div class="row">
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
<label style="font-size: 20px;color: #007bff">
    Danh Sách Kỳ Báo Cáo
</label>
<table id="table_ky" class="table table-bordered" style="width:100%">
    <thead style="background: #0c84ff;color: white;width: 100%">
    <tr style="text-align: center">
        <th style="line-height: normal">
            <input type="checkbox" name="del_all" onclick="delall()"
                   style="height: 20px;width: 20px; margin: auto">
        </th>
        <th>STT</th>
        <th>Năm</th>
        <th>Tuần</th>
        <th>Từ Ngày</th>
        <th>Đến Ngày</th>
        <th>Chốt</th>
        <th>Xem Báo Cáo</th>
    </tr>
    </thead>
    <tbody style="text-align: center">
    @foreach($ky as $key => $k)
        <tr id="ky_{{$k->id}}">
            <td style="line-height: normal;text-align: center; width: 100px">
                <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px;margin: auto"
                    {{$k->chot==1 ? 'disabled':''}}   value="{{$k->id}}">
            </td>
            <td>
                {{$key+1}}
            </td>
            <td>
                {{$k->nam}}
            </td>
            <td>
                {{$k->tuan}}
            </td>
            <td>
                {{DateTime::createFromFormat('Y-m-d H:i:s',$k->tungay)->format('d/m/Y')}}
            </td>
            <td>
                {{DateTime::createFromFormat('Y-m-d H:i:s',$k->denngay)->format('d/m/Y')}}
            </td>
            @if($k->chot == 0)
                <td>
                    <span class="btn btn-danger btn-xs" >Chưa Chốt</span>
                </td>
            @else
                <td>
                    <span class="btn btn-success btn-xs" >Chốt</span>
                </td>
            @endif
            <td>
                <a href="{{route('xembaocao_ky',$k->id)}}">
                    <button class="btn btn-primary">
                        Xem báo cáo
                    </button>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<button class="btn btn-danger" type="button" id="button_del" href="#" onclick="delid()"
        style="display: none; height: 50px;width: 100px;margin-left: 0;margin-right: auto">
    <i class="fas fa-trash"></i>
</button>

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
                    if(removeRow($iddel[$i].value, '{{route('destroy_ky')}}')){
                        document.getElementById('ky_'+$iddel[$i].value).remove();
                    }
                }
            }
            setTimeout(function(){
                location.reload();
            }, 500);
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#table_ky').DataTable( {
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
            "aLengthMenu": [[ 10, 20, 50], [10, 20, 50]], // danh sách số trang trên 1 lần hiển thị bảng
            // "order": [[ 0, 'a' ]], //sắp xếp giảm dần theo cột thứ 1
            "scrollY": "500px",
            'scrollX': true,
            "scrollCollapse": true,
        } );
    } );
</script>

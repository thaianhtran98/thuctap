
<label style="font-size: 20px;color: #007bff">
    Danh Sách Kỳ Báo Cáo
</label>
<table id="table_ky" class="table table-bordered" style="width:100%">
    <thead style="background: #0c84ff;color: white;width: 100%">
    <tr style="text-align: center">
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
        <tr>
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
                {{DateTime::createFromFormat('Y-m-d',$k->tungay)->format('d/m/Y')}}
            </td>
            <td>
                {{DateTime::createFromFormat('Y-m-d',$k->denngay)->format('d/m/Y')}}
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
                <a href="/xembaocao/{{$k->id}}">
                    <button class="btn btn-primary">
                        Xem báo cáo
                    </button>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

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
            "scrollCollapse": true,
        } );
    } );
</script>
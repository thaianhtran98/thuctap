
<div class="row">
    <label style="font-size: 20px;color: #007bff">
        Các Yêu Cầu Đang Code
    </label>

    <div class="col-md-12">
        <table id="table_dangcode" class="table table-bordered" style="width: 100%">
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
{{--                    @if(strlen($yc->ten_yeu_cau)<50)--}}
                        <td  style="line-height: normal;width: 20%;text-align: left">
                            {{$yc->ten_yeu_cau}}
                        </td>
{{--                    @else--}}
{{--                        <td  style="line-height: normal;width: 20%;text-align: left">--}}
{{--                            {!! substr($yc->ten_yeu_cau,0,50) !!}...--}}
{{--                        </td>--}}
{{--                    @endif--}}

{{--                    @if(strlen($yc->noi_dung_yc)<50)--}}
                        <td style="line-height: normal; width: 30%;text-align: left">
                            {{$yc->noi_dung_yc}}
                        </td>
{{--                    @else--}}
{{--                        <td style="line-height: normal; width: 30%;text-align: left" title="{{$yc->noi_dung_yc}}">--}}
{{--                            {!! substr($yc->noi_dung_yc,0,50) !!}...--}}
{{--                        </td>--}}
{{--                    @endif--}}
                    <td style="text-align: center">{{$yc->yc_ct->ten_chuong_trinh}}</td>
                    <td>
                        {{DateTime::createFromFormat('Y-m-d H:i:s',$yc->yc_loaingay->ngaygiaoviec)->format('d/m/Y H:i:s')}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function() {
        var table_dangcode = $('#table_dangcode').DataTable( {
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
            'scrollX': true,
            "scrollCollapse": true,
            lengthChange: true,
            buttons: [ 'excel', 'pdf' ]
        } );
        table_dangcode.buttons().container().appendTo( '#table_dangcode_wrapper .col-md-6:eq(0)' );
    } );
</script>

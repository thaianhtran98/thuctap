@extends('main')
@section('content')
    @include('alert')
    <div class="m-t-50 m-r-10 m-l-10">
        <table id="table_bc" class="table table-bordered">
            <thead style="background: #0c84ff;color: white">
            <tr style="text-align: center">
                <th>STT</th>
                <th>Đơn Vị Yêu Cầu</th>
                <th>Lũy Kế Đầu Kỳ</th>
                <th>Tổng Yêu Cầu</th>
                <th>Tổng Yêu Cầu Trong Tuần</th>
                <th>SL Yêu Cầu Đã Xong</th>
                <th>SL Yêu Cầu Tồn</th>
                <th>SL Yêu Cầu Đang Thực Hiện</th>
                <th>SL Hostfix</th>
            </tr>
            </thead>
            <tbody>
                @foreach($donvi as $key => $dv)
                    <tr>
                        <td style="text-align: center;">{{$key+1}}</td>
                        <td>{{$dv->ten_don_vi}}</td>
                        <td style="text-align: center;">{{$dv->luy_ke_dau_ky}}</td>

                        @if(count($dv->donvi_kybaocao)==1)
                            @foreach($dv->donvi_kybaocao as $baocao)
                                <td  style="text-align: center;">{{$baocao->luyke}}</td>
                                <td  style="text-align: center;">{{$baocao->tongyeucautrongtuan}}</td>
                                <td  style="text-align: center;">{{$baocao->yeucaudahoanthanh}}</td>
                                <td  style="text-align: center;">{{$baocao->yeucauconton}}</td>
                                <td  style="text-align: center;">{{$baocao->yeucaudangthuchien}}</td>
                                <td  style="text-align: center;">{{$baocao->yeucaudahostfix}}</td>
                            @endforeach
                        @else
                            <td  style="text-align: center;">{{$dv->luy_ke_dau_ky}}</td>
                            <td  style="text-align: center;">0</td>
                            <td  style="text-align: center;">0</td>
                            <td  style="text-align: center;">0</td>
                            <td  style="text-align: center;">0</td>
                            <td  style="text-align: center;">0</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('#table_bc').DataTable( {
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
                "order": [[ 0, 'asc' ]], //sắp xếp giảm dần theo cột thứ 1
                "scrollY": "500px",
                "scrollCollapse": true,
            } );
        } );
    </script>
@endsection

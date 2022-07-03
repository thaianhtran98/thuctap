@extends('main')
@section('head')
    <script type="text/javascript" src="/template/admin/Inputmask/dist/jquery.inputmask.js"></script>
    <script type="text/javascript" src="/template/admin/jquery-ui-1.13.1.custom/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="/template/admin/ui/jquery-ui.css"/>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
@endsection

@section('content')
{{--    @php--}}
{{--        date_default_timezone_set('Asia/Ho_Chi_Minh');--}}
{{--        if (date_default_timezone_get()) {--}}
{{--            echo 'date_default_timezone_set: ' . date_default_timezone_get() ;--}}
{{--        }--}}
{{--        echo date('d/m/Y H:i:s');--}}
{{--    @endphp--}}
    <div class="m-t-50 m-r-10 m-l-10">
        <table id="table_lichsu" class="table table-bordered nowrap hover" style="width:100%;">
            <thead style="background: #0c84ff;color: white">
            <tr >
                <th style="text-align: center">Nhân Viên Thao Tác</th>
                <th style="text-align: center">Thơi Điểm Thao Tác</th>
                <th style="text-align: center;display: none">Thơi Điểm Thao Tác origin</th>
                <th style="text-align: center">Thao Tác</th>
                <th style="text-align: center">Mô Tả</th>
            </tr>
            </thead>
            <tbody id="tbody">
            @foreach($lstc as $ls)
                <tr>
                    <td>
                        {{$ls->id_nv}}
                    </td>
                    <td style="text-align: center">
                        {{DateTime::createFromFormat('Y-m-d H:i:s',$ls->created_at)->format('d/m/Y H:i:s')}}
                    </td>
                    <td style="text-align: center; display: none">
                        {{$ls->created_at}}
                    </td>
                    <td>
                        {{$ls->thao_tac}}
                    </td>
                    <td >
                        <div style="height: 150px;overflow-y: scroll;scrollbar-color: #656262;scrollbar-color:  thin;">
                            {!! $ls->mo_ta !!}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection

@section('footer')

    <script>
        $(document).ready(function() {
            $('#table_lichsu').DataTable( {
                pagingType: 'full_numbers',
                dom: 'Plfrtip',
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
                    },
                    searchPanes: {
                        title: {
                            _:''
                        },
                        collapseMessage: 'Ẩn bảng thống kê',
                        showMessage: 'Hiển thị bảng thống kê',
                        clearMessage: 'Chọn lại'
                    }
                },
                "processing": true, // tiền xử lý trước
                "aLengthMenu": [[ 10, 20, 50], [10, 20, 50]], // danh sách số trang trên 1 lần hiển thị bảng
                "order": [[ 0, 'asc' ]], //sắp xếp giảm dần theo cột thứ 1
                "scrollY": "515px",
                "scrollCollapse": true,
                columnDefs: [
                    {
                        searchPanes: {
                            show: true
                        },
                        targets: [ 0, 1,3]
                    },
                ],
                searchPanes: {
                    cascadePanes: true,
                    orderable: false,
                    viewCount: false,
                    initCollapsed: true,
                    panes: [
                        {
                            header: 'Từ Thời Điểm',
                            options: [
                                @foreach($lstc as $ls)
                                {
                                    label: '{{DateTime::createFromFormat('Y-m-d H:i:s',$ls->created_at)->format('d/m/Y H:i:s')}}',
                                    value: function(rowData, rowIdx) {
                                            ngay = '{{$ls->created_at}}';
                                            return new Date ( rowData[2] ) >= new Date (ngay);
                                    },
                                },
                                @endforeach

                            ]
                        },
                        {
                            header: 'Đến Thời Điểm',
                            options: [
                                    @foreach($lstc as $ls)
                                {
                                    label: '{{DateTime::createFromFormat('Y-m-d H:i:s',$ls->created_at)->format('d/m/Y H:i:s')}}',
                                    value: function(rowData, rowIdx) {
                                        ngay = '{{$ls->created_at}}';
                                        return new Date ( rowData[2] ) <= new Date (ngay);
                                    },
                                },
                                @endforeach

                            ]
                        },
                    ],
                    dtOpts: {
                        select: {
                            style: 'multi'
                        }
                    }
                },
            });
        } );
    </script>

@endsection
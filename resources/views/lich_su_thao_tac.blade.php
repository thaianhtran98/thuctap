@extends('main')
@section('head')
    <script type="text/javascript" src="/template/admin/Inputmask/dist/jquery.inputmask.js"></script>
    <script type="text/javascript" src="/template/admin/jquery-ui-1.13.1.custom/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="/template/admin/ui/jquery-ui.css"/>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

{{--    <style>--}}
{{--        div.dataTables_wrapper div.dataTables_filter{--}}
{{--            margin-top: 0px;--}}
{{--        }--}}
{{--    </style>--}}
@endsection

@section('content')

    <div class="m-t--50 m-r-10 m-l-10">
        <div class="row">
            <div class="col-md-12">
                <table id="table_lichsu" class="table table-bordered nowrap hover" style="width:100%;">
                    <thead style="background: #0c84ff;color: white;margin-top: 100px">
                    <tr>
                        <td style="text-align: center;width: 50px">STT</td>
                        <th style="text-align: center">Nhân Viên Thao Tác</th>
                        <th style="text-align: center">Thơi Điểm Thao Tác</th>
                        <th style="text-align: center;display: none">Thơi Điểm Thao Tác origin</th>
                        <th style="text-align: center">Thao Tác</th>
                        <th style="text-align: center">Mô Tả</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @foreach($lstc as $key => $ls)
                        <tr>
                            <td style="text-align: center;width: 50px;line-height: 150px;">
                                {{$key+1}}
                            </td>
                            <td  style="line-height: 150px;" >
                                {{$ls->id_nv}}
                            </td>
                            <td style="text-align: center;line-height: 150px;">
                                {{DateTime::createFromFormat('Y-m-d H:i:s',$ls->created_at)->format('d/m/Y H:i:s')}}
                            </td>
                            <td style="text-align: center; display: none">
                                {{$ls->created_at}}
                            </td>
                            <td  style="line-height: 150px;" >
                                {{$ls->thao_tac}}
                            </td>
                            <td >
                                <div style="max-height: 150px;overflow-y: scroll;scrollbar-color: #656262;scrollbar-color:  thin;">
                                    {!! $ls->mo_ta !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

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
                        targets: [ 1,2,4]
                    },{
                        searchPanes: {
                            show: false
                        },
                        targets: [ 0,3,5]
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
                                            return new Date ( rowData[3] ) >= new Date (ngay);
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
                                        return new Date ( rowData[3] ) <= new Date (ngay);
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
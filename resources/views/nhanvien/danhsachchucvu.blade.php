<div style="border: 2px">
    <table id="table_cv" class="table table-bordered" style="width:100%">
        <thead style="background: #0c84ff;color: white">
        <tr style="text-align: center">
{{--            <th style="line-height: normal">--}}
{{--                <input type="checkbox" name="del_all_cv" onclick="delall_cv()" style="height: 20px;width: 20px; float: left">--}}
{{--                Xóa--}}
{{--            </th>--}}
            <th>Tên Chức Vụ</th>
            <th>Tình Trạng Hoạt Động</th>
        </tr>
        </thead>
        <tbody id="list_cv">
        @foreach($cvs as $cv)
            <tr>
{{--                <td style="line-height: normal">--}}
{{--                    <input type="checkbox" name="del_id_cv[]" onclick="showbutton_cv()" style="height: 20px;width: 20px"--}}
{{--                           value="{{$cv->id}}">--}}
{{--                </td>--}}
                <td ondblclick="showedit_cv{{$cv->id}}()">
                    <a id="ten_cv_{{$cv->id}}" style="display: block">{{$cv->ten_chuc_vu}}</a>
                    <input id="edit_ten_cv_{{$cv->id}}" style="display: none;border: 1px solid rgba(4,4,19,0.93);"
                           value="{{$cv->ten_chuc_vu}}">
                </td>
                <td style="text-align: center">
                    <div id="parent_active_cv_{{$cv->id}}">
                        @if($cv->hoat_dong==1)
                            <span id="cv-yes-{{$cv->id}}" class="btn btn-success btn-xs" onclick="change_active_cv(1, '{{route('change_active_cv',$cv->id)}}')">Yes</span>
                        @else
                            <span id="cv-no-{{$cv->id}}" class="btn btn-danger btn-xs" onclick="change_active_cv(0, '{{route('change_active_cv',$cv->id)}}')">No</span>
                        @endif
                    </div>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        $(document).keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                @foreach($cvs as $cv)
                document.getElementById('ten_cv_{{$cv->id}}').style.display = 'block';
                document.getElementById('edit_ten_cv_{{$cv->id}}').style.display = 'none';
                @endforeach
            }
        });


        function change_active_cv(active,url){
            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: { active },
                url: url,
                success:function (result){
                    if(result.error === true){
                    }else {
                        if(result.active_cv==1){
                            var parent_id= 'parent_active_cv_'+result.id_cv;
                            var id='cv-no-'+result.id_cv;
                            var child = document.getElementById(id);
                            child.parentNode.removeChild(child);
                            var replace="<span id='cv-yes-"+result.id_cv+"' class='btn btn-success btn-xs' onclick=change_active_cv("+ result.active_cv +",'"+url+"')>Yes</span>";
                            document.getElementById(parent_id).innerHTML=replace;
                        }else {
                            var id='cv-yes-'+result.id_cv;
                            var parent_id= 'parent_active_cv_'+result.id_cv;
                            var parent= document.getElementById(parent_id);
                            var child = document.getElementById(id);
                            child.parentNode.removeChild(child);
                            var replace="<span id='cv-no-"+result.id_cv + "' class='btn btn-danger btn-xs' onclick=change_active_cv("+ result.active_cv +",'"+ url +"')>No</span>";
                            parent.innerHTML=replace;
                        }
                    }
                }
            })
        }
    </script>
</div>


<script>
    $(document).ready(function() {
        $('#table_cv').DataTable( {
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
            "aLengthMenu": [[10, 20, 50], [10, 20, 50]], // danh sách số trang trên 1 lần hiển thị bảng
            "order": [[ 1, 'desc' ]], //sắp xếp giảm dần theo cột thứ 1
            "scrollY": "500px",
            'scrollX': true,
            "scrollCollapse": true,
        } );
    } );
</script>

<script>
    @foreach($cvs as $cv)
        function showedit_cv{{$cv->id}}() {
            document.getElementById('edit_ten_cv_{{$cv->id}}').style.display = 'block';
            document.getElementById('ten_cv_{{$cv->id}}').style.display = 'none';
        }

        $(document).ready(function () {
        $('#edit_ten_cv_{{$cv->id}}').bind('change',
            function store_ten() {
                edit_ten = document.getElementById('edit_ten_cv_{{$cv->id}}');
                ten_dv = document.getElementById('ten_cv_{{$cv->id}}');
                edit_ten.style.display = 'none';
                ten_dv.style.display = 'block';
                ten_dv.innerHTML = edit_ten.value;
                ten_change = edit_ten.value;
                console.log(ten_change)
                edit_ten_cv('{{route('edit_cv',$cv->id)}}', ten_change);
            }
        );
    });
    @endforeach

    function edit_ten_cv(url, ten = '') {
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: {ten},
            url: url,
        })
    }

</script>

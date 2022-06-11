<div style="border: 2px">
    <table class="table" style="text-align: center">
        <thead style="background: #0c84ff;color: white">
        <tr style="text-align: center">
            <th style="line-height: normal">
                <input type="checkbox" name="del_all_cv" onclick="delall_cv()" style="height: 20px;width: 20px; float: left">
                Xóa
            </th>
            <th>Tên Chức Vụ</th>
            <th>Tình Trạng Hoạt Động</th>
        </tr>
        </thead>
        <tbody id="list_cv">
        @foreach($cvs as $cv)
            <tr>
                <td style="line-height: normal">
                    <input type="checkbox" name="del_id_cv[]" onclick="showbutton_cv()" style="height: 20px;width: 20px"
                           value="{{$cv->id}}">
                </td>
                <td ondblclick="showedit_cv{{$cv->id}}()">
                    <a id="ten_cv_{{$cv->id}}" style="display: block">{{$cv->ten_chuc_vu}}</a>
                    <input id="edit_ten_cv_{{$cv->id}}" style="display: none;border: 1px solid rgba(4,4,19,0.93);"
                           value="{{$cv->ten_chuc_vu}}">
                </td>
                <td style="text-align: center">
                    <div id="parent_active_cv_{{$cv->id}}">
                        @if($cv->hoat_dong==1)
                        <span id="cv-yes-{{$cv->id}}" class="btn btn-success btn-xs" onclick="change_active_cv(1, '/cv/change/{{$cv->id}}')">Yes</span>
                        @else
                        <span id="cv-no-{{$cv->id}}" class="btn btn-danger btn-xs" onclick="change_active_cv(0, '/cv/change/{{$cv->id}}')">No</span>
                        @endif
                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

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
                edit_ten_cv('/cv/edit_cv/{{$cv->id}}', ten_change);
                // location.reload();
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

    function delall_cv() {
        var $iddel = document.getElementsByName('del_id_cv[]');
        var $delall = document.getElementsByName('del_all_cv');
        if ($delall[0].checked === true) {
            document.getElementById('button_del_cv').style.display = 'block';
            for ($i = 0; $i < $iddel.length; $i++) {
                $iddel[$i].checked = true;
            }
        } else {
            document.getElementById('button_del_cv').style.display = 'none';
            for ($i = 0; $i < $iddel.length; $i++) {
                $iddel[$i].checked = false;
            }
        }
    }

    function showbutton_cv() {
        var $iddel = document.getElementsByName('del_id_cv[]');

        for ($i = 0; $i < $iddel.length; $i++) {
            if ($iddel[$i].checked === true) {
                return document.getElementById('button_del_cv').style.display = 'block';
            } else {
                document.getElementById('button_del_cv').style.display = 'none';
            }
        }
    }

    function delid_cv() {
        if (confirm('Dữ liệu xóa không thể khôi phục. Bạn có muốn xóa không?')) {
            var $iddel = document.getElementsByName('del_id_cv[]');
            for ($i = 0; $i < $iddel.length; $i++) {
                if ($iddel[$i].checked === true) {
                    removeRow($iddel[$i].value, '/cv/destroy');
                }
            }
        }
    }


    function change_active_cv(active,url){
        // console.log(url);
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: { active },
            url: url,
            success:function (result){
                if(result.error === true){
                    alert('Lỗi');
                }else {
                    if(result.active_cv==1){
                        var parent_id= 'parent_active_cv_'+result.id_cv;
                        var id='cv-no-'+result.id_cv;
                        var child = document.getElementById(id);
                        var url_no = '/cv/change/'+result.id_cv;
                        child.parentNode.removeChild(child);
                        var replace="<span id='cv-yes-"+result.id_cv+"' class='btn btn-success btn-xs' onclick=change_active_cv("+result.active_cv+",'"+url_no+"')>Yes</span>";
                        document.getElementById(parent_id).innerHTML=replace;
                    }else {
                        var id='cv-yes-'+result.id_cv;
                        var parent_id= 'parent_active_cv_'+result.id_cv;
                        var parent= document.getElementById(parent_id);
                        var child = document.getElementById(id);
                        var url_yes = '/cv/change/'+result.id_cv;
                        child.parentNode.removeChild(child);
                        var replace="<span id='cv-no-"+result.id_cv + "' class='btn btn-danger btn-xs' onclick=change_active_cv("+result.active_cv+",'"+url_yes+"')>No</span>";
                        parent.innerHTML=replace;
                    }
                }
            }
        })
    }

</script>

 <div id="vungtrong" onclick="click_vungtrong()" style="border: 2px">
     <table class="table">
         <thead style="background: #0c84ff;color: white">
         <tr style="text-align: center">
             <th style="line-height: normal">
                 <input type="checkbox" name="del_all" onclick="delall()" style="height: 20px;width: 20px; float: left">
                 Xóa
             </th>
             <th>Độ Ưu Tiên</th>
             <th>Tên Đơn Vị</th>
             <th>Lũy Kế Đầu Kỳ</th>
             <th>Tình Trạng Hoạt Động</th>
         </tr>
         </thead>
         <tbody>
         @foreach($donvi as $dv)
             <tr>
                 <td style="line-height: normal">
                     <input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px"
                            value="{{$dv->id}}">
                 </td>
                 <td ondblclick="showedituutien{{$dv->id}}()">
                     <a id="dv_uu_tien_{{$dv->id}}" style="display: block">{{$dv->uu_tien}}</a>
                     <input id="edit_dv_uu_tien_{{$dv->id}}" style="display: none;border: 1px solid rgba(4,4,19,0.93);"
                            value="{{$dv->uu_tien}}">
                 </td>
                 <td ondblclick="showeditten{{$dv->id}}()">
                     <a id="ten_dv_{{$dv->id}}" style="display: block">{{$dv->ten_don_vi}}</a>
                     <input id="edit_ten_dv_{{$dv->id}}" style="display: none;border: 1px solid rgba(4,4,19,0.93);"
                            value="{{$dv->ten_don_vi}}">
                 </td>
                 <td style="text-align: center" ondblclick="showeditluyke{{$dv->id}}()" id="luyke_dv">
                     <a id="luyke_dv_{{$dv->id}}" style="display: block">{{$dv->luy_ke_dau_ky}}</a>
                     <input id="edit_luyke_dv_{{$dv->id}}" style="display: none;border: 1px solid rgba(4,4,19,0.93);"
                            value="{{$dv->luy_ke_dau_ky}}">
                 </td>
                 <td style="text-align: center">
                     <div id="parent_active_{{$dv->id}}">
                     </div>
                     {!!  \App\Http\Helper\Helper::active($dv->hoat_dong,$dv->id,"/dv/change/".$dv->id) !!}
                 </td>
             </tr>
         @endforeach
         </tbody>
     </table>
     <button class="btn btn-danger btn-sm" type="button" id="button_del" href="#"
             onclick="delid()" style="display: none; height: 50px;width: 100px">
         <i class="fas fa-trash"></i>
     </button>
 </div>

 @section('footer')
     <script>
         $(document).keypress(function (event) {
             var keycode = (event.keyCode ? event.keyCode : event.which);
             if (keycode == '13') {
                 @foreach($donvi as $dv)
                 document.getElementById('dv_uu_tien_{{$dv->id}}').style.display = 'block';
                 document.getElementById('edit_dv_uu_tien_{{$dv->id}}').style.display = 'none';
                 document.getElementById('ten_dv_{{$dv->id}}').style.display = 'block';
                 document.getElementById('edit_ten_dv_{{$dv->id}}').style.display = 'none';
                 document.getElementById('edit_luyke_dv_{{$dv->id}}').style.display = 'none';
                 document.getElementById('luyke_dv_{{$dv->id}}').style.display = 'block';
                 @endforeach
             }
         });

         @foreach($donvi as $dv)
         function showedituutien{{$dv->id}}() {
             document.getElementById('dv_uu_tien_{{$dv->id}}').style.display = 'none';
             document.getElementById('edit_dv_uu_tien_{{$dv->id}}').style.display = 'block';
         }

         $(document).ready(function () {
             $('#edit_dv_uu_tien_{{$dv->id}}').bind('change',
                 function store_ten() {
                        dv_uutien =   document.getElementById('dv_uu_tien_{{$dv->id}}');
                        edit_uutien =  document.getElementById('edit_dv_uu_tien_{{$dv->id}}');
                     edit_uutien.style.display = 'none';
                     dv_uutien.style.display = 'block';
                     dv_uutien.innerHTML = edit_uutien.value;
                     ten_change = document.getElementById('ten_dv_{{$dv->id}}').innerText;
                        luyke_change = document.getElementById('luyke_dv_{{$dv->id}}').innerText;
                     uutien_change = edit_uutien.value;
                     edit_ten_dv('/dv/edit_dv/{{$dv->id}}',ten_change,luyke_change,uutien_change);
                        location.reload();
                    }
                );
            });

            function showeditten{{$dv->id}}(){
                document.getElementById('edit_ten_dv_{{$dv->id}}').style.display = 'block';
                document.getElementById('ten_dv_{{$dv->id}}').style.display = 'none';
            }

            $(document).ready(function() {
                $('#edit_ten_dv_{{$dv->id}}').bind('change',
                    function store_ten(){
                        edit_ten = document.getElementById('edit_ten_dv_{{$dv->id}}');
                        ten_dv = document.getElementById('ten_dv_{{$dv->id}}');
                        edit_ten.style.display = 'none';
                        ten_dv.style.display = 'block';
                        ten_dv.innerHTML = edit_ten.value;
                        ten_change = edit_ten.value;
                        edit_ten_dv('/dv/edit_dv/{{$dv->id}}',ten_change);
                    }
                );
            });

            function showeditluyke{{$dv->id}}(){
                document.getElementById('edit_luyke_dv_{{$dv->id}}').style.display = 'block';
                document.getElementById('luyke_dv_{{$dv->id}}').style.display = 'none';
            }

            $(document).ready(function() {
                $('#edit_luyke_dv_{{$dv->id}}').bind('change',
                    function store_ten(){
                        edit_luyke =  document.getElementById('edit_luyke_dv_{{$dv->id}}');
                        luyke_dv =  document.getElementById('luyke_dv_{{$dv->id}}');
                        edit_luyke.style.display = 'none';
                        luyke_dv.style.display = 'block';
                        luyke_dv.innerHTML = edit_luyke.value;
                        ten_change = document.getElementById('ten_dv_{{$dv->id}}').innerText;
                        luyke_change = edit_luyke.value;
                        edit_ten_dv('/dv/edit_dv/{{$dv->id}}',ten_change,luyke_change);
                    }
                );
            });
        @endforeach


        function delall(){
            var $iddel = document.getElementsByName('del_id[]');
            var $delall = document.getElementsByName('del_all');
            if($delall[0].checked===true){
                document.getElementById('button_del').style.display='block';
                for($i=0 ; $i<$iddel.length;$i++){
                    $iddel[$i].checked=true;
                }
            }
            else{
                document.getElementById('button_del').style.display='none';
                for($i=0 ; $i<$iddel.length;$i++){
                    $iddel[$i].checked=false;
                }
            }
        }

        function showbutton(){
            var $iddel = document.getElementsByName('del_id[]');

            for($i=0 ; $i<$iddel.length;$i++){
                if ($iddel[$i].checked===true){
                    return document.getElementById('button_del').style.display='block';
                }else {
                    document.getElementById('button_del').style.display='none';
                }
            }
        }

        function delid(){
            if(confirm('Dữ liệu xóa không thể khôi phục. Bạn có muốn xóa không?')){
                var $iddel = document.getElementsByName('del_id[]');

                for ($i = 0; $i < $iddel.length; $i++) {
                    if ($iddel[$i].checked === true) {
                        removeRow($iddel[$i].value, '/dv/destroy');
                    }
                }
            }
        }

         function edit_ten_dv(url, ten = '', luyke = '', uutien = '') {
             // console.log(ten);
             // console.log(luyke);
             $.ajax({
                 type: 'POST',
                 datatype: 'JSON',
                 data: {ten, luyke, uutien},
                 url: url,
             })
         }
     </script>
@endsection
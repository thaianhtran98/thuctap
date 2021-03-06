{{--@include('alert')--}}
<div id="form_add_new_yc" class="row" style="width: 35%; display: none;background-color: rgba(46,52,57,0.33); position: absolute;z-index: 10003;top: 50px">
    <div class="col-sm-12 m-b--12 m-t-12" style="text-align: center">
        <label style="font-size: 20px;color: #007bff">
            Thêm Yêu Cầu
        </label>
    </div>
    <div class="col-md-12">
        <div class="card-body">
            <div class="form-group">

                <div class="row" id="select_yc_con" style="display: none">
                    <label for="menu">Các yêu cầu con</label><font color="red"> (*)</font>
                    <div class="col-sm-11">
                        <select name="name_tt" class="form-control" id="ten_thuoc_tinh"></select>
                    </div>

                    <div class="col-sm-1">
                        <button onclick="show_them_moi_yc_plus()">
                            <span style="font-size: 25px;color: dodgerblue;">
                                <i class="fas fa-plus-square"></i>
                            </span>
                        </button>
                    </div>
                    <br>
                </div>

                <div class="row" id="them_moi_yc_con">
                    <label for="menu">Tên Yêu Cầu</label><font color="red"> (*)</font>
                    <div class="col-md-12">
                        <input type="text" name="name_tt" class="form-control" id="ten_thuoc_tinh_dau"
                               placeholder="Nhập tên tên yêu cầu" required>
                        <br>
                    </div>
                </div>

                <div class="row" id="them_moi_yeu_cau_plus" style="display: none">
                    <label for="menu">Thêm Tên Yêu Cầu</label><font color="red"> (*)</font>
                    <div class="col-md-11">
                        <input type="text" name="name_tt" class="form-control" id="ten_thuoc_tinh_moi"
                               placeholder="Nhập tên tên yêu cầu" required>
                    </div>
                    <div class="col-md-1">
                        <button onclick="huy_them_moi()">
                            <span style="font-size: 25px;color: #ff0000;margin-left: 10px">
                                <i class="fas fa-times-circle"></i>
                            </span>
                        </button>
                    </div>
                    <br>
                </div>

                <div class="row">
                    <label for="menu">Kiểu dữ liệu</label>
                    <div class="col-md-12">
                        <select class="form-control" id ='kieu_thuoc_tinh'>
                            <option value="0">
                                Varchar
                            </option>
                            <option value="1">
                                Date
                            </option>
                            <option value="2">
                                LongText
                            </option>
                            <option value="3">
                                Integer
                            </option>
                            <option value="4">
                                link
                            </option>
                        </select>
                    </div>
                </div>
                <br>

                <div class="row">
                    <label>Nội Dung Thuộc Tính</label><font color="red"> (*)</font>
                    <div class="col-md-12">
                        <div  class="form-group">
                            <div id="noi_dung_theo_kieu">
                                <input type="text" name="name_tt" class="form-control" id="noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required>
                            </div>
                        </div>
                    </div>
                    <button style="width: 100%;" onclick="add_tt_post()" id="add_tt" class="btn btn-primary">Thêm Yêu Cầu</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('#ten_thuoc_tinh').keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            $('#kieu_thuoc_tinh').focus();
            event.preventDefault(); //preventDefault() Không load lại form
        }
    });

    document.querySelector('#kieu_thuoc_tinh').addEventListener('change', (event) => {
        var kieu = document.getElementById('kieu_thuoc_tinh').value;
        var noidung = document.getElementById('noi_dung_theo_kieu');
        if (kieu == '0'){
            var html = '<input type="text" name="name_tt" class="form-control" id="noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required>';
            noidung.innerHTML=html;

            $('#kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
            $('#noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#add_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

        }
        else if (kieu == '1'){
            var html = '<input type="text"  class="form-control"  id="noi_dung_thuoc_tinh" placeholder="dd/mm/yyyy" required>';
            noidung.innerHTML=html;
            $(document).ready(function () {
                // $("#noi_dung_thuoc_tinh").inputmask("99/99/9999", {
                //     "placeholder": "dd/mm/yyyy",
                //     'alias': 'date',
                // });
                var noi_dung_thuoc_tinh = document.getElementById('noi_dung_thuoc_tinh');
                Inputmask({
                    inputFormat: "dd/mm/yyyy",
                    alias: "datetime",
                    // max:24,
                    min: "01/01/2019",
                    "oncomplete": function () {
                        console.log(document.getElementById('ngaytiepnhan').value);
                        if (document.getElementById('ngayhoanthanhdukien').value < document.getElementById('ngaytiepnhan').value) {
                            document.getElementById('ngayhoanthanhdukien').value = '';
                            alert('Ngày dự kiện hoàn thành phải lớn hơn ngày tiếp nhận');
                        }
                    }
                }).mask(ngayhoanthanhdukien);
            });

            $("#noi_dung_thuoc_tinh").datepicker({
                dateFormat: 'dd/mm/yy 00:00:00',
            });

            $('#kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
            $('#noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#add_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

        }
        else if (kieu == '2'){
            var html = '<textarea  class="form-control" id="noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required></textarea>';
            noidung.innerHTML=html;
            $('#kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

            $('#noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#add_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
        }
        else if (kieu == '3'){
            var html = '<input type="Number" class="form-control" id="noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required>';
            noidung.innerHTML=html;
            $('#kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

            $('#noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#add_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
        }
        else if (kieu == '4'){
            var html = '<input type="text" class="form-control" id="noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required>';
            noidung.innerHTML=html;
            $('#kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

            $('#noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#add_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
        }
    });

</script>

<script>
    function del_yck(id){
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: '{{route('destroy_yck')}}',
            success:function (result){
                if(result.error === true){
                    document.getElementById('thatbai').innerText = 'Xóa thất bại'
                    document.getElementById('thatbai').style.display = 'block';
                    setTimeout(function(){
                        document.getElementById('thatbai').style.display = 'none';
                    }, 1500);
                }else {
                    document.getElementById('thanhcong').innerText = 'Xóa thành công'
                    document.getElementById('thanhcong').style.display = 'block';
                    setTimeout(function(){
                        document.getElementById('thanhcong').style.display = 'none';
                    }, 1500);
                    document.querySelector('#yeucauthem'+id).remove();
                }
            }
        })
    }

    var stt_thuoctinh = 0;

    function add_tt_post(){
        var id_yc = sessionStorage.getItem('yc_id');
        var ten_thuoc_tinh = '';
        if(stt_thuoctinh>0 && document.getElementById('them_moi_yeu_cau_plus').style.display == 'none'){
            ten_thuoc_tinh= document.getElementById('ten_thuoc_tinh').value;
        } else{
            if (document.getElementById('ten_thuoc_tinh_moi').value !=''){
                ten_thuoc_tinh = document.getElementById('ten_thuoc_tinh_moi').value;
            }else{
                ten_thuoc_tinh = document.getElementById('ten_thuoc_tinh_dau').value;
            }
        }
        var kieu_thuoc_tinh = document.getElementById('kieu_thuoc_tinh').value;
        var noi_dung_thuoc_tinh = '';
        if(document.getElementById('noidung_tt')!='')
            noi_dung_thuoc_tinh = document.getElementById('noi_dung_thuoc_tinh').value;
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: {id_yc, ten_thuoc_tinh, kieu_thuoc_tinh, noi_dung_thuoc_tinh},
            url: '{{route('store_thuoctinh_yc')}}',
            success:function (result){
                if(result.error === false){
                    document.getElementById('thanhcong').innerText = 'Thêm thành công yêu cầu ' + ten_thuoc_tinh;
                    document.getElementById('thanhcong').style.display = 'block';
                    setTimeout(function(){
                        document.getElementById('thanhcong').style.display = 'none';
                    }, 1500);
                    document.getElementById('table_yc_plus').style.visibility = 'visible';
                    var tbody = document.getElementById("cac_yeu_cau_them");
                    var tr = document.createElement('tr');
                    var td_ten = document.createElement('td');
                    var td_noidung = document.createElement('td');
                    var td_xoa = document.createElement('td');
                    var td_sua = document.createElement('td');
                    var span_xoa =  document.createElement('span');
                    var span_sua =  document.createElement('span');
                    var i_xoa =  document.createElement('i');
                    var i_sua =  document.createElement('i');
                    tr.setAttribute('id','yeucauthem'+result.id_thuoctinh);
                    td_ten.appendChild(document.createTextNode(ten_thuoc_tinh));
                    td_ten.setAttribute('id','tenthuoctinh'+result.id_thuoctinh);
                    if(kieu_thuoc_tinh==4){
                        var a = document.createElement('a');
                        a.setAttribute('href',noi_dung_thuoc_tinh);
                        a.setAttribute('target','_blank');
                        a.appendChild(document.createTextNode(noi_dung_thuoc_tinh));
                        td_noidung.appendChild(a);
                    }else{
                        td_noidung.appendChild(document.createTextNode(noi_dung_thuoc_tinh));
                    }
                   //xóa thuộc tính yêu cầu
                    i_xoa.setAttribute('class','fas fa-trash');
                    i_xoa.setAttribute('onclick','del_yck('+result.id_thuoctinh+')');
                    span_xoa.appendChild(i_xoa);
                    td_xoa.appendChild(span_xoa);
                    //Sửa thuộc tính yêu cầu
                    i_sua.setAttribute('class','fas fa-edit');
                    i_sua.setAttribute('onclick','show_edit_yck('+result.id_thuoctinh+',"'+ten_thuoc_tinh+'","'+kieu_thuoc_tinh+'","'+noi_dung_thuoc_tinh+'")');
                    span_sua.appendChild(i_sua);
                    td_sua.appendChild(span_sua);
                    tr.appendChild(td_ten);
                    tr.appendChild(td_noidung);
                    tr.appendChild(td_xoa);
                    tr.appendChild(td_sua);
                    tbody.appendChild(tr);
                    page_normal();
                    document.getElementById('ten_thuoc_tinh').value ='';
                    document.getElementById('kieu_thuoc_tinh').value=0;
                    document.getElementById('noi_dung_thuoc_tinh').value ='';
                    document.getElementById('noi_dung_thuoc_tinh').ariaPlaceholder ='Nhập nội dung';
                    stt_thuoctinh+=1;
                    if(stt_thuoctinh>0){
                        if(document.getElementById('select_yc_con').style.display !== 'flex'){
                            document.getElementById('select_yc_con').style.display = 'flex';
                            document.getElementById('kieu_thuoc_tinh').disabled = 'true';
                        }
                        document.getElementById('them_moi_yc_con').style.display = 'none';
                        if(sessionStorage.getItem(ten_thuoc_tinh)){
                            console.log('ok');
                            huy_them_moi();
                        }else {
                            var option = document.createElement('option');
                            option.setAttribute('value',ten_thuoc_tinh);
                            option.appendChild(document.createTextNode(ten_thuoc_tinh));
                            document.getElementById('ten_thuoc_tinh').appendChild(option);
                            sessionStorage.setItem(ten_thuoc_tinh,kieu_thuoc_tinh);
                            huy_them_moi();
                        }

                        // $('#ten_thuoc_tinh').picker({search : true});
                        // kieu = sessionStorage.getItem(document.getElementById(ten_thuoc_tinh).options[0].value);
                    }
                }
                else {
                    document.getElementById('thatbai').innerText = 'Yêu cầu đã tồn tại';
                    document.getElementById('thatbai').style.display = 'block';
                    setTimeout(function(){
                        document.getElementById('thatbai').style.display = 'none';
                    }, 1500);
                }
                let kieu = sessionStorage.getItem(document.getElementById('ten_thuoc_tinh').options[0].text);
                document.getElementById('ten_thuoc_tinh').value = document.getElementById('ten_thuoc_tinh').options[0].text;
                document.getElementById('kieu_thuoc_tinh').value = kieu;
                kieunhapmoi(kieu);
            }
        });
    }

    function luu_tam_yeu_cau(){
        var id_don_vi = document.getElementById('id_don_vi').value;
        var id_loai_chuong_trinh = document.getElementById('id_loai_chuong_trinh').value;
        var ten_yeu_cau = document.getElementById('ten_yeu_cau').value;
        var noi_dung_yc = document.getElementById('noi_dung_yc').value;
        var trang_thai = document.getElementById('trang_thai').value;
        var ngaytiepnhan = document.getElementById('ngaytiepnhan').value;
        var ngayhoanthanhdukien = document.getElementById('ngayhoanthanhdukien').value;
        var ngaygiaoviec = document.getElementById('ngaygiaoviec').value;
        let a = 0;
        if (ten_yeu_cau!=='' && noi_dung_yc!==''){
            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: {id_don_vi, id_loai_chuong_trinh,
                    ngayhoanthanhdukien,ngaygiaoviec,
                    ngaytiepnhan,ten_yeu_cau,noi_dung_yc,trang_thai},
                url: '{{route('store_tam_yc')}}',
                success:function (result){
                    if(result.error == false){
                        document.getElementById('thanhcong').innerText = 'Lưu thành công yêu cầu chính ' + ten_yeu_cau;
                        document.getElementById('thanhcong').style.display = 'block';
                        setTimeout(function(){
                            document.getElementById('thanhcong').style.display = 'none';
                        }, 1500);
                        document.getElementById('them').style.display ='none';
                        document.getElementById('cap_nhat').style.display ='block';
                        sessionStorage.setItem('yc_id',result.id_yc.id);
                        sessionStorage.setItem('ok',1);
                        document.getElementById('form_add_new_yc').style.display = 'block';
                        document.getElementById('form_add_new_yc').style.background = 'white';
                        document.getElementById('body').style.display = 'block';
                        document.getElementById('header').style.position = '';
                    }else {
                        document.getElementById('thatbai').innerText = 'Thêm thất bại';
                        document.getElementById('thatbai').style.display = 'block';
                        setTimeout(function(){
                            document.getElementById('thatbai').style.display = 'none';
                        }, 1500);
                    }
                }
            });
        }else {
            alert('Tên yêu cầu hoặc nội dung yêu cầu không được trống')
        }
    }

    function show_add_new_yc() {
        if(sessionStorage.getItem('ok')!=1){
            if(confirm('Để thêm thuộc tính phải lưu lại yêu cầu này?')){
                luu_tam_yeu_cau();
            }
        }else {
            sessionStorage.setItem('ok',1);
            document.getElementById('form_add_new_yc').style.display = 'block';
            document.getElementById('form_add_new_yc').style.background = 'white';
            document.getElementById('body').style.display = 'block';
            document.getElementById('header').style.position = '';
        }
    }

    function page_normal() {
        document.getElementById('body').style.display = 'none';
        document.getElementById('form_add_new_yc').style.display = 'none';
        document.getElementById('form-add').style.display = 'none';
        document.getElementById('form-add-dv').style.display = 'none';
        document.getElementById('form-add-dv').style.display = 'none';
        document.getElementById('form-add').style.display = 'none';
        document.getElementById('form_edit_yck').style.display = 'none';
        document.getElementById('header').style.position = 'fixed';
    }

    function show_them_moi_yc_plus(){
        document.getElementById('them_moi_yeu_cau_plus').style.display = 'flex';
        document.getElementById('select_yc_con').style.display = 'none';
        document.getElementById('kieu_thuoc_tinh').disabled = false;
    }

    function huy_them_moi(){
        document.getElementById('them_moi_yeu_cau_plus').style.display = 'none';
        document.getElementById('select_yc_con').style.display = 'flex';
        document.getElementById('ten_thuoc_tinh_moi').value = '';
        document.getElementById('kieu_thuoc_tinh').disabled = true;
    }

    function kieunhapmoi(kieu){
        var noidung = document.getElementById('noi_dung_theo_kieu');
        if( kieu== 0){
            document.getElementById('kieu_thuoc_tinh').value = kieu;
            var html = '<input type="text" name="name_tt" class="form-control" id="noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required>';
            noidung.innerHTML=html;

            $('#kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
            $('#noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#add_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
        }else if( kieu== 1){
            document.getElementById('kieu_thuoc_tinh').value = kieu;
            var html = '<input type="text"  class="form-control"  id="noi_dung_thuoc_tinh" placeholder="dd/mm/yyyy" required>';
            noidung.innerHTML=html;


            $(document).ready(function () {
                var noi_dung_thuoc_tinh = document.getElementById('noi_dung_thuoc_tinh');
                Inputmask({
                    inputFormat: "dd/mm/yyyy HH:MM:ss",
                    alias: "datetime",
                    max:24,
                }).mask(noi_dung_thuoc_tinh);
            });

            $("#noi_dung_thuoc_tinh").datepicker({
                dateFormat: 'dd/mm/yy 00:00:00',
            });

            $('#kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
            $('#noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#add_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
        }else if( kieu== 2){
            document.getElementById('kieu_thuoc_tinh').value = kieu;
            var html = '<textarea  class="form-control" id="noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required></textarea>';
            noidung.innerHTML=html;
            $('#kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

            $('#noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#add_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
        }else if( kieu== 3){
            document.getElementById('kieu_thuoc_tinh').value = kieu;
            var html = '<input type="Number" class="form-control" id="noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required>';
            noidung.innerHTML=html;
            $('#kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

            $('#noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#add_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
        }else if( kieu== 4){
            document.getElementById('kieu_thuoc_tinh').value = kieu;
            var html = '<input type="text" class="form-control" id="noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required>';
            noidung.innerHTML=html;
            $('#kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

            $('#noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#add_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
        }
    }

    document.querySelector('#ten_thuoc_tinh').addEventListener('change', (event) => {
        var kieu  =sessionStorage.getItem(document.getElementById('ten_thuoc_tinh').value);
        kieunhapmoi(kieu);
    });

</script>

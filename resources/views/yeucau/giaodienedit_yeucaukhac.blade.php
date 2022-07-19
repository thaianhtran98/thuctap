<div id="form_edit_yck" class="row" style="width: 35%; display: none;background-color: rgba(46,52,57,0.33); position: absolute;z-index: 10003;top: 50px">
    <div class="col-sm-12 m-b--12 m-t-12" style="text-align: center">
        <label style="font-size: 20px;color: #007bff">
            Sửa Yêu Cầu
        </label>
    </div>
    <div class="col-md-12">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="menu">Tên Yêu Cầu</label><font color="red"> (*)</font>
                        <input type="text" name="edit_ten_thuoc_tinh" class="form-control" disabled id="edit_ten_thuoc_tinh"
                               placeholder="Nhập tên đơn vị" required>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="menu">Kiểu dữ liệu</label>
                        <select class="form-control" id ='edit_kieu_thuoc_tinh' disabled>
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
                <div class="row">
                    <div class="col-md-12">
                        <div  class="form-group">
                            <label>Nội Dung Thuộc Tính</label><font color="red"> (*)</font>
                            <div id="edit_noi_dung_theo_kieu">
                                <input type="text" name="name_tt" class="form-control" id="edit_edit_noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required>
                            </div>
                        </div>
                    </div>
                    <button style="width: 100%;" onclick="edit_tt_post()" id="edit_tt" class="btn btn-primary">Sửa Yêu Cầu</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function edit_tt_post(){
        var id_yc = sessionStorage.getItem('yc_id');
        var id_thuoc_tinh = id_thuoc_tinh_edit;
        var ten_thuoc_tinh = document.getElementById('edit_ten_thuoc_tinh').value;
        var kieu_thuoc_tinh = document.getElementById('edit_kieu_thuoc_tinh').value;
        var noi_dung_thuoc_tinh = document.getElementById('edit_noi_dung_thuoc_tinh').value;
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: {id_yc,id_thuoc_tinh, ten_thuoc_tinh, kieu_thuoc_tinh, noi_dung_thuoc_tinh},
            url: '{{route('edit_thuoctinh_yc')}}',
            success:function (result){
                if(result.error === false){
                    document.getElementById('thanhcong').innerText = 'Sửa thành công yêu cầu ' + ten_thuoc_tinh;
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
                    document.querySelector('#yeucauthem'+result.id_thuoctinh).remove();
                    tr.setAttribute('id','yeucauthem'+result.id_thuoctinh);
                    td_ten.appendChild(document.createTextNode(ten_thuoc_tinh));
                    td_ten.setAttribute('id','tenthuoctinh'+result.id_thuoctinh);
                    td_noidung.appendChild(document.createTextNode(noi_dung_thuoc_tinh));
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
                }
                else {
                    document.getElementById('thatbai').innerText = 'Sửa thất bại';
                    document.getElementById('thatbai').style.display = 'block';
                    setTimeout(function(){
                        document.getElementById('thatbai').style.display = 'none';
                    }, 1500);
                }
            }
        });
    }


    var id_thuoc_tinh_edit = 0;

    function show_edit_yck(id,tenthuoctinh,kieuthuoctinh,noidungthuoctinh) {
        // if(sessionStorage.getItem('ok')!=1){
        //     if(confirm('Để thêm thuộc tính phải lưu lại yêu cầu này?')){
        //         add_yeu_cau();
        //     }
        // }else {
            id_thuoc_tinh_edit = id;
            // console.log(id_thuoc_tinh_edit);
            sessionStorage.setItem('ok',1);
            document.getElementById('edit_ten_thuoc_tinh').value = tenthuoctinh;
            document.getElementById('edit_kieu_thuoc_tinh').value = kieuthuoctinh;
            var noidung = document.getElementById('edit_noi_dung_theo_kieu');
            // console.log(noidungthuoctinh)
            kieunhap(kieuthuoctinh,noidung,noidungthuoctinh);
            document.getElementById('form_edit_yck').style.display = 'block';
            document.getElementById('form_edit_yck').style.background = 'white';
            document.getElementById('body').style.display = 'block';
            document.getElementById('header').style.position = '';
        // }
    }
</script>

<script>
    $('#edit_ten_thuoc_tinh').keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            $('#edit_kieu_thuoc_tinh').focus();
            event.preventDefault(); //preventDefault() Không load lại form
        }
    });

    document.querySelector('#edit_kieu_thuoc_tinh').addEventListener('change', (event) => {
        var kieu = document.getElementById('edit_kieu_thuoc_tinh').value;
        var noidung = document.getElementById('edit_noi_dung_theo_kieu');
        kieunhap(kieu,noidung);
    });

    function kieunhap(kieu,noidung,dulieu=''){
        if (kieu == '0'){
            var html = '<input type="text" name="name_tt" class="form-control" id="edit_noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required>';
            noidung.innerHTML=html;
            document.getElementById('edit_noi_dung_thuoc_tinh').value = dulieu;

            $('#edit_kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#edit_noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
            $('#edit_noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#edit_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

        }
        else if (kieu == '1'){
            var html = '<input type="text"  class="form-control"  id="edit_noi_dung_thuoc_tinh" required>';
            noidung.innerHTML=html;
            document.getElementById('edit_noi_dung_thuoc_tinh').value = dulieu;

            $(document).ready(function () {
                var edit_noi_dung_thuoc_tinh = document.getElementById('edit_noi_dung_thuoc_tinh');
                Inputmask({
                    inputFormat: "dd/mm/yyyy HH:MM:ss",
                    alias: "datetime",
                    max:24,
                }).mask(edit_noi_dung_thuoc_tinh);
            });

            $("#edit_noi_dung_thuoc_tinh").datepicker({
                dateFormat: 'dd/mm/yy 00:00:00',
            });

            $('#edit_kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#edit_noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
            $('#edit_noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#edit_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

        }
        else if (kieu == '2'){
            var html = '<textarea  class="form-control" id="edit_noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required></textarea>';
            noidung.innerHTML=html;
            document.getElementById('edit_noi_dung_thuoc_tinh').value = dulieu;

            $('#edit_kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#edit_noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

            $('#edit_noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#edit_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
        }
        else if (kieu == '3'){
            var html = '<input type="Number" class="form-control" id="edit_noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required>';
            noidung.innerHTML=html;
            document.getElementById('edit_noi_dung_thuoc_tinh').value = dulieu;

            $('#edit_kieu_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#edit_noi_dung_thuoc_tinh').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });

            $('#edit_noi_dung_thuoc_tinh').keypress(function (event) {
                if (event.keyCode == 13 || event.which == 13) {
                    $('#edit_tt').focus();
                    event.preventDefault(); //preventDefault() Không load lại form
                }
            });
        }
    }
</script>

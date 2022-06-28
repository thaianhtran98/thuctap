@extends('main')
@section('head')
    <script type="text/javascript" src="/template/admin/Inputmask/dist/jquery.inputmask.js"></script>
    <script type="text/javascript" src="/template/admin/jquery-ui-1.13.1.custom/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="/template/admin/ui/jquery-ui.css"/>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
        var donvi = sessionStorage.getItem('donvi');
        var ct = sessionStorage.getItem('ct');
        sessionStorage.clear();
        sessionStorage.setItem('ok',0);
    </script>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success"
                 id="thanhcong"
                 style="z-index: 20000;position: absolute;display: none; right: 0;top: 0px; margin-bottom: 10px; margin-left: auto;margin-right: 50px;width: auto;text-align: center">
                Thành công
            </div>
            <div  class="alert alert-danger"
                 id="thatbai"
                 style="z-index: 20000;position: absolute;display: none; right: 0;top: 0px; margin-bottom: 10px; margin-left: auto;margin-right: 50px;width: auto;text-align: center">
                Thất bại
            </div>
        </div>
    </div>

    <div class=" m-r-10 m-l-10">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            @include('yeucau.giaodienthemdv')
            @include('yeucau.giaodienthemlct')
            @include('yeucau.giaodienaddyc')
            @include('yeucau.giaodienedit_yeucaukhac')
        </div>
        @include('alert')
        <label style="font-size: 20px;color: #007bff;margin-bottom: 10px">
            Thêm Yêu Cầu
        </label>
{{--        <form action="" method="POST">--}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Đơn Vị</label><font color="red"> (*)</font>
                        <div class="row" style="line-height: 25px;" >
                            <div class="col-md-10">
                                <select class="form-control" name="id_don_vi" id="id_don_vi" >
                                    @foreach($dvs as $dv)
                                        <option value="{{$dv->id}}">{{$dv->ten_don_vi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" onclick="show_add_dv()">
                                <span style="font-size: 25px;color: dodgerblue;">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                </button>
                            </div>
                            <div class="col-md-1">
                                <button type="button" onclick="neo_donvi()">
                                <span id="neo_donvi" style="font-size: 20px;color: black;">
                                    <i class="fas fa-anchor"></i>
                                </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="menu">Chương Trình</label><font color="red"> (*)</font>
                        <div class="row" style="line-height: 25px;">
                            <div class="col-md-10">
                                <select class="form-control" name="id_loai_chuong_trinh" id="id_loai_chuong_trinh" >
                                    @foreach($cts as $ct)
                                        <option value="{{$ct->id}}">{{$ct->ten_chuong_trinh}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" onclick="show_add_lct()">
                                <span style="font-size: 25px;color: dodgerblue;">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                </button>
                            </div>
                            <div class="col-md-1">
                                <button type="button" onclick="neo_ct()">
                                <span id="neo_ct" style="font-size: 20px;color: black;">
                                    <i class="fas fa-anchor"></i>
                                </span>
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="menu">Tên Yêu Cầu</label><font color="red"> (*)</font>
                        <input type="text" name="ten_yeu_cau" class="form-control" id="ten_yeu_cau"
                               placeholder="Nhập tên yêu cầu" required>
                    </div>

                    <div class="form-group">
                        <label for="menu">Nội Dung Yêu Cầu</label><font color="red"> (*)</font>
                        <textarea class="form-control" id="noi_dung_yc" name="noi_dung_yc" placeholder="Nhập nội dung" ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="menu">Trạng Thái</label><font color="red"> (*)</font>
                        <select class="form-control" name="trang_thai" id="trang_thai">
                            <option value="0">Tiếp Nhận</option>
                            <option value="1">Giao Việc</option>
                        </select>
                    </div>

                    <div class="form-group" id="addnv" style="display: none">
                        <div class="form-inline">
                            <label for="exampleInputPassword1">Danh Sách Nhân Viên</label>
                        </div>

                        <div class="form-control pl-4 " style="   height: 200px;
                                                              overflow-y: scroll;
                                                              scrollbar-color: #656262;
                                                              scrollbar-width: thin;">
                            <ul id="danhsachbaihat">
                                @foreach($nvs as $nv)
                                    <li style="display:flex">
                                        <input type="checkbox"
                                               onclick=taoluutru('nv_{{$nv->id}}',{{$nv->id}})
                                               style="width: 20px;height: 20px" id="{{$nv->id}}" value="{{$nv->ten_nguoi_thuc_hien}}">
                                        <label class='form-check-label m-l-10'
                                               for='{{$nv->id}}'>{{$nv->ten_nguoi_thuc_hien}}
                                        </label>
                                    </li>
                                    <br>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                    <div class="form-group" id="nv_selected" style="display: none">
                        <div class="form-group">
                            <div class="form-inline">
                                <label for="exampleInputPassword1">Nhân Viên Thực Hiện</label>
                            </div>
                        </div>
                        <div class="form-control pl-4 " style=" width: 100%;min-height: 50px;height: auto">
                            <div class="row" style="text-align: left">
                                <div class="col-md-6">Tên</div>
                                <div class="col-md-4">Chức vụ</div>
                                <div class="col-md-2"style="text-align: center">Xóa</div>
                            </div>
                            <hr>
                            <ul id="danhsachchon">

                            </ul>
                        </div>
                    </div>

                </div>

                <div style="border-left: thin solid rgba(87,87,87,0.55);width:4.33333333%;margin-left: 4%"></div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="menu">Ngày Tiếp Nhận</label><font color="red"> (*)</font>
                        <input type="text" name="ngaytiepnhan" id="ngaytiepnhan" autocomplete="off"
                               class="form-control" placeholder="dd/mm/yyyy">
                    </div>

                    <div class="form-group" id="form_ngaygiaoviec" style="display: none">
                        <label for="menu">Ngày Giao Việc</label>
                        <input type="text" id="ngaygiaoviec" data-inputmask="'alias': 'date'" autocomplete="off"
                               name="ngaygiaoviec" class="form-control" placeholder="dd/mm/yyyy">
                    </div>

                    <div class="form-group">
                        <label for="menu">Ngày Hoàn Thành Dự Kiến</label>
                        <input type="text" id="ngayhoanthanhdukien" data-inputmask="'alias': 'date'" autocomplete="off"
                               name="ngayhoanthanhdukien" class="form-control" placeholder="dd/mm/yyyy">
                    </div>

                    <div class="form-group">
                        <label for="menu">Yêu Cầu Khác</label>
                        <table style="text-align: center;width: 100%;visibility: hidden" id="table_yc_plus" class="table" >
                            <thead style="background: #0c84ff;color: white">
                                <tr>
                                    <th>
                                        Tên Yêu Cầu
                                    </th>
                                    <th>
                                        Nội Dung Yêu Cầu
                                    </th>
                                    <th>
                                        Xóa
                                    </th>
                                    <th>
                                        Sửa
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="cac_yeu_cau_them">

                            </tbody>
                        </table>
                        <button type="button" onclick="show_add_new_yc()">
                                <span style="font-size: 25px;color: dodgerblue;">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                        </button>
                    </div>


                    <div>
                        <button onclick="them_yeu_cau()" id="them" class="btn btn-primary m-t-50 m-l-10" style="float: right">Thêm Yêu Cầu</button>
                    </div>
                    <div>
                        <button onclick="luu_lai_yeu_cau()" id="cap_nhat" class="btn btn-primary m-t-50 m-l-10" style="float: right ; display: none">Thêm Yêu Cầu</button>
                    </div>
                    <div>
                        <a href="/danhsachyeucau">
                            <button class="btn btn-primary m-t-50 m-l-10" style="float: right">Quay Về Danh Sách Yêu Cầu</button>
                        </a>
                    </div>
                </div>
            </div>
            @csrf
    </div>

<script>
    function them_yeu_cau(){
        console.log($('#noi_dung_yc').val());
        var id_don_vi = document.getElementById('id_don_vi').value;
        var id_loai_chuong_trinh = document.getElementById('id_loai_chuong_trinh').value;
        var ten_yeu_cau = document.getElementById('ten_yeu_cau').value;
        var noi_dung_yc = document.getElementById('noi_dung_yc').value;
        var trang_thai = document.getElementById('trang_thai').value;
        console.log(trang_thai);
        var ngaytiepnhan = document.getElementById('ngaytiepnhan').value;
        var ngayhoanthanhdukien = document.getElementById('ngayhoanthanhdukien').value;
        var ngaygiaoviec = document.getElementById('ngaygiaoviec').value;
        var nv_id = [];
        var cv_id = [];
        @foreach($nvs as $nv)
            if(sessionStorage.getItem('nv_{{$nv->id}}')){
                nv_id.push(sessionStorage.getItem('nv_{{$nv->id}}'));
            }
            if(sessionStorage.getItem('chucvu_{{$nv->id}}')){
                cv_id.push(sessionStorage.getItem('chucvu_{{$nv->id}}'))
            }
        @endforeach
        if (ten_yeu_cau!=='' && noi_dung_yc!==''){
            if(trang_thai!=0 && nv_id.length !=0){
                $.ajax({
                    type: 'POST',
                    datatype: 'JSON',
                    data: {id_don_vi, id_loai_chuong_trinh,
                        ngayhoanthanhdukien,ngaygiaoviec,
                        ngaytiepnhan,ten_yeu_cau,noi_dung_yc,trang_thai,nv_id,cv_id},
                    url: '/themyeucau',
                    success:function (result){
                        if(result.error === false){
                            location.reload();
                        }else {
                            location.reload();
                        }
                    }
                })
            }else if(trang_thai==0){
                $.ajax({
                    type: 'POST',
                    datatype: 'JSON',
                    data: {id_don_vi, id_loai_chuong_trinh,
                        ngayhoanthanhdukien,ngaygiaoviec,
                        ngaytiepnhan,ten_yeu_cau,noi_dung_yc,trang_thai,nv_id,cv_id},
                    url: '/themyeucau',
                    success:function (result){
                        if(result.error === false){
                            location.reload();
                        }else {
                            location.reload();
                        }
                    }
                })
            }
            else {
                alert('Vui lòng chọn nhân viên thực hiện yêu cầu')
            }
        }else {
            alert('Tên yêu cầu hoặc nội dung yêu cầu không được trống')
        }
    }



    function luu_lai_yeu_cau(){
        var id_don_vi = document.getElementById('id_don_vi').value;
        var id_loai_chuong_trinh = document.getElementById('id_loai_chuong_trinh').value;
        var ten_yeu_cau = document.getElementById('ten_yeu_cau').value;
        var noi_dung_yc = document.getElementById('noi_dung_yc').value;
        var trang_thai = document.getElementById('trang_thai').value;
        var ngaytiepnhan = document.getElementById('ngaytiepnhan').value;
        var ngayhoanthanhdukien = document.getElementById('ngayhoanthanhdukien').value;
        var ngaygiaoviec = document.getElementById('ngaygiaoviec').value;
        var id_yc = sessionStorage.getItem('yc_id');
        var nv_id = [];
        var cv_id = [];
        @foreach($nvs as $nv)
        if(sessionStorage.getItem('nv_{{$nv->id}}')){
            nv_id.push(sessionStorage.getItem('nv_{{$nv->id}}'));
        }
        if(sessionStorage.getItem('chucvu_{{$nv->id}}')){
            cv_id.push(sessionStorage.getItem('chucvu_{{$nv->id}}'))
        }
        @endforeach
        if (ten_yeu_cau!='' && noi_dung_yc!=''){
            $.ajax({
                type: 'POST',
                datatype: 'JSON',
                data: {id_don_vi, id_loai_chuong_trinh,
                    ngayhoanthanhdukien,ngaygiaoviec,
                    ngaytiepnhan,ten_yeu_cau,noi_dung_yc,trang_thai,nv_id,cv_id},
                url: '/capnhat_pagethem/'+id_yc,
                success:function (result){
                    if(result.error === false){
                        location.reload();
                    }else {
                        location.reload();
                    }
                }
            })
        }else {
            alert('Tên yêu cầu hoặc nội dung yêu cầu không được trống')
        }
    }

</script>

{{--    Xử lý ngày tháng năm và bấm enter--}}
    <script>
        let d = new Date();
        let year = d.getFullYear();
        let month = d.getMonth() + 1;
        let day = d.getDate();
        if (Number(day) < 10) {
            day = '0' + day;
        }
        if (Number(month) < 10) {
            month = '0' + month;
        }

        $("#ngaytiepnhan").datepicker({
            dateFormat: 'dd/mm/yy',
        });

        $(document).ready(function () {
            document.getElementById('ngaytiepnhan').value = day + '/' + month + '/' + year;
            $("#ngaytiepnhan").inputmask("99/99/9999", {
                "placeholder": "dd/mm/yyyy",
                'alias': 'date',
                "oncomplete": function () {
                    let elementrm = document.getElementById('ngayhoanthanhdukien');
                    elementrm.classList.remove("hasDatepicker");

                    $("#ngayhoanthanhdukien").datepicker({
                        dateFormat: 'dd/mm/yy', minDate: new Date(
                            document.getElementById('ngaytiepnhan').value.substr(6, 4),
                            document.getElementById('ngaytiepnhan').value.substr(3, 2)-1,
                            Number(document.getElementById('ngaytiepnhan').value.substr(0, 2)) + 1)
                    });
                }
            });
        });

        $("#ngayhoanthanhdukien").datepicker({
            dateFormat: 'dd/mm/yy', minDate: new Date(
                document.getElementById('ngaytiepnhan').value.substr(6, 4),
                document.getElementById('ngaytiepnhan').value.substr(3, 2)-1,
                Number(document.getElementById('ngaytiepnhan').value.substr(0, 2)) + 1)
        });


        $(document).ready(function () {
            $("#ngaytiepnhan_test").inputmask("99/99/9999", {
                "placeholder": "dd/mm/yyyy",
                'alias': 'date',
                "oncomplete": function () {
                    let elementrm = document.getElementById('ngayhoanthanhdukien');
                    elementrm.classList.remove("hasDatepicker");

                    $("#ngayhoanthanhdukien").datepicker({
                        dateFormat: 'dd/mm/yy', minDate: new Date(
                            document.getElementById('ngaytiepnhan').value.substr(6, 4),
                            document.getElementById('ngaytiepnhan').value.substr(3, 2)-1,
                            Number(document.getElementById('ngaytiepnhan').value.substr(0, 2)) + 1)
                    });
                }
            });
        });

        $("#ngaygiaoviec").datepicker({
            dateFormat: 'dd/mm/yy', minDate: new Date(
                document.getElementById('ngaytiepnhan').value.substr(6, 4),
                document.getElementById('ngaytiepnhan').value.substr(3, 2)-1,
                Number(document.getElementById('ngaytiepnhan').value.substr(0, 2)))
        });

        document.querySelector('#ngayhoanthanhdukien').addEventListener('mouseover', (event) => {
            let ngaydukien = document.getElementById('ngayhoanthanhdukien');
            let ngaygiaoviec = document.getElementById('ngaygiaoviec');
            ngaydukien.classList.remove("hasDatepicker");
            ngaygiaoviec.classList.remove('hasDatepicker')

            $("#ngayhoanthanhdukien").datepicker({
                dateFormat: 'dd/mm/yy', minDate: new Date(
                    document.getElementById('ngaytiepnhan').value.substr(6, 4),
                    document.getElementById('ngaytiepnhan').value.substr(3, 2)-1,
                    Number(document.getElementById('ngaytiepnhan').value.substr(0, 2)) + 1)
            });
            $("#ngaygiaoviec").datepicker({
                dateFormat: 'dd/mm/yy', minDate: new Date(
                    document.getElementById('ngaytiepnhan').value.substr(6, 4),
                    document.getElementById('ngaytiepnhan').value.substr(3, 2)-1,
                    Number(document.getElementById('ngaytiepnhan').value.substr(0, 2))),
                maxDate: new Date(
                    document.getElementById('ngayhoanthanhdukien').value.substr(6, 4),
                    document.getElementById('ngayhoanthanhdukien').value.substr(3, 2)-1,
                    Number(document.getElementById('ngayhoanthanhdukien').value.substr(0, 2))),
            });
        })

        document.querySelector('#ngaygiaoviec').addEventListener('mouseover', (event) => {
            let ngaydukien = document.getElementById('ngayhoanthanhdukien');
            let ngaygiaoviec = document.getElementById('ngaygiaoviec');
            ngaydukien.classList.remove("hasDatepicker");
            ngaygiaoviec.classList.remove('hasDatepicker')
            $("#ngayhoanthanhdukien").datepicker({
                dateFormat: 'dd/mm/yy', minDate: new Date(
                    document.getElementById('ngaytiepnhan').value.substr(6, 4),
                    document.getElementById('ngaytiepnhan').value.substr(3, 2)-1,
                    Number(document.getElementById('ngaytiepnhan').value.substr(0, 2)) + 1)
            });
            if(ngaydukien.value==='') {
                $("#ngaygiaoviec").datepicker({
                    dateFormat: 'dd/mm/yy', minDate: new Date(
                        document.getElementById('ngaytiepnhan').value.substr(6, 4),
                        document.getElementById('ngaytiepnhan').value.substr(3, 2)-1,
                        Number(document.getElementById('ngaytiepnhan').value.substr(0, 2))),
                });
            }else {
                $("#ngaygiaoviec").datepicker({
                    dateFormat: 'dd/mm/yy', minDate: new Date(
                        document.getElementById('ngaytiepnhan').value.substr(6, 4),
                        document.getElementById('ngaytiepnhan').value.substr(3, 2)-1,
                        Number(document.getElementById('ngaytiepnhan').value.substr(0, 2))),
                    maxDate: new Date(
                        document.getElementById('ngayhoanthanhdukien').value.substr(6, 4),
                        document.getElementById('ngayhoanthanhdukien').value.substr(3, 2)-1,
                        Number(document.getElementById('ngayhoanthanhdukien').value.substr(0, 2))),
                });
            }
        })

        $(document).ready(function () {
            $("#ngaygiaoviec").inputmask("99/99/9999", {
                "placeholder": "dd/mm/yyyy",
                'alias': 'date',
                "oncomplete": function () {
                    if (document.getElementById('ngaytiepnhan').value > document.getElementById('ngaygiaoviec').value ||
                        document.getElementById('ngayhoanthanhdukien').value < document.getElementById('ngaygiaoviec').value) {
                        document.getElementById('ngaygiaoviec').value = '';
                        alert('Ngày dự kiện hoàn thành phải lớn hơn ngày tiếp nhận');
                    }
                }
            });
        });

        document.querySelector('#trang_thai').addEventListener('change', (event) => {
            if (document.getElementById('trang_thai').value > 0) {
                document.getElementById('form_ngaygiaoviec').style.display = 'block';
                document.getElementById('addnv').style.display = 'block';
                document.getElementById('nv_selected').style.display = 'block';
                let d = new Date();
                let year = d.getFullYear();
                let month = d.getMonth() + 1;
                let day = d.getDate();
                if (Number(day) < 10) {
                    day = '0' + day;
                }
                if (Number(month) < 10) {
                    month = '0' + month;
                }
                document.getElementById('ngaygiaoviec').value = day + '/' + month + '/' + year;
            } else {
                var id_yc = sessionStorage.getItem('yc_id');
                document.getElementById('ngaygiaoviec').value = '';
                sessionStorage.clear();
                sessionStorage.setItem('ok',1);
                sessionStorage.setItem('yc_id',id_yc);
                document.getElementById('form_ngaygiaoviec').style.display = 'none';
                document.getElementById('addnv').style.display = 'none';
                document.getElementById('nv_selected').style.display = 'none';
            }
        })

        //
        $(document).ready(function () {
            $("#ngayhoanthanhdukien").inputmask("99/99/9999", {
                "placeholder": "dd/mm/yyyy",
                "oncomplete": function () {
                    console.log(document.getElementById('ngaytiepnhan').value);
                    if (document.getElementById('ngayhoanthanhdukien').value < document.getElementById('ngaytiepnhan').value) {
                        document.getElementById('ngayhoanthanhdukien').value = '';
                        alert('Ngày dự kiện hoàn thành phải lớn hơn ngày tiếp nhận');
                    }
                }
            });
        });
        // $("#timeStartPicker").mask("99:99:99");

        $('#id_don_vi').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#id_loai_chuong_trinh').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });
        $('#id_loai_chuong_trinh').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#ten_yeu_cau').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });
        $('#ten_yeu_cau').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#noi_dung_yc').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });
        $('#noi_dung_yc').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#trang_thai').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });
        $('#trang_thai').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#ngaytiepnhan').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });
        $('#ngaytiepnhan').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#ngayhoanthanhdukien').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });

    </script>

{{--  Add thành viên vào dự án  --}}
    <script>
        let i = 0;
        function taoluutru(name, id) {
            if (document.getElementById(id).checked === true) {
                sessionStorage.setItem(name, id)
                var ul = document.getElementById("danhsachchon");
                var li = document.createElement("li");
                var btn = document.createElement("button");
                var input = document.createElement('input');
                var select = document.createElement('select');
                var row = document.createElement('div');
                var col1 = document.createElement('div');
                var col2 = document.createElement('div');
                var col3 = document.createElement('div');
                var hr = document.createElement('hr');
                li.setAttribute("id", 'nv_id' + sessionStorage.getItem(name));
                row.setAttribute('class','row');
                row.setAttribute('style','vertical-align: middle; height:40px;line-height:40px');
                col1.setAttribute('style','vertical-align: middle;text-align:left');
                col2.setAttribute('style','vertical-align: middle;text-align:left ');
                col3.setAttribute('style','vertical-align: middle;text-align:center ');
                col1.setAttribute('class','col-md-6');
                col2.setAttribute('class','col-md-4');
                col3.setAttribute('class','col-md-2');
                col1.appendChild(document.createTextNode(document.getElementById(sessionStorage.getItem(name)).value));
                btn.setAttribute("id", 'del_nv_id' + sessionStorage.getItem(name));
                btn.setAttribute("class", 'btn btn-danger');
                btn.appendChild(document.createTextNode('X'));
                select.setAttribute('id',sessionStorage.getItem(name)+'_id_nhom');
                // select.setAttribute('onchange',change_chuc_vu());
                input.setAttribute("name", 'nv_id[]');
                input.setAttribute("id", 'nv_input' + sessionStorage.getItem(name));
                li.appendChild(row)
                row.appendChild(col1)
                row.appendChild(col2)
                row.appendChild(col3)
                col3.appendChild(btn);
                li.appendChild(input);
                col2.appendChild(select);
                @foreach($chucvues as $cv)
                    var option{{$cv->id}} = document.createElement('option');
                    option{{$cv->id}}.setAttribute('value','{{$cv->id}}');
                    option{{$cv->id}}.appendChild(document.createTextNode('{{$cv->ten_chuc_vu}}'));
                    select.appendChild(option{{$cv->id}});
                @endforeach
                li.appendChild(hr);
                ul.appendChild(li);
                document.getElementById('nv_input' + sessionStorage.getItem(name)).style.display = 'none';
                document.getElementById('nv_input' + sessionStorage.getItem(name)).value = sessionStorage.getItem(name);
                // document.getElementById('del_nv_id' + sessionStorage.getItem(name)).style.right = 0;
                // document.getElementById('del_nv_id' + sessionStorage.getItem(name)).style.float = 'right';
                // document.getElementById('del_nv_id' + sessionStorage.getItem(name)).style.textAlign = 'center';
                document.getElementById('del_nv_id' + sessionStorage.getItem(name)).onclick = function () {
                    removeli(sessionStorage.getItem(name))
                };
                document.getElementById(sessionStorage.getItem(name)+'_id_nhom').onchange = function () {
                    sessionStorage.setItem('chucvu_'+sessionStorage.getItem(name),document.getElementById(sessionStorage.getItem(name)+'_id_nhom').value);
                };
                sessionStorage.setItem('chucvu_'+sessionStorage.getItem(name),{{$chucvues[0]->id}});
            } else {
                let li_rm = document.querySelector('#nv_id' + sessionStorage.getItem(name))
                li_rm.remove();
                sessionStorage.removeItem('chucvu_'+sessionStorage.getItem(name));
                sessionStorage.removeItem(name);
            }
        };

        function removeli(song_id) {
            let btn_rm = document.querySelector('#del_nv_id' + song_id);
            let li_rm = document.querySelector('#nv_id' + song_id);
            btn_rm.remove();
            li_rm.remove();
            sessionStorage.removeItem('nv_'+song_id);
            sessionStorage.removeItem('chucvu_'+song_id);
            document.getElementById(song_id).checked = false;
        }
    </script>

    <script>
        if(donvi){
            sessionStorage.setItem('donvi',donvi);
            document.getElementById('neo_donvi').style.color = 'dodgerblue';
            document.getElementById('id_don_vi').value = donvi;
        }if(ct){
            document.getElementById('neo_ct').style.color = 'dodgerblue';
            sessionStorage.setItem('ct',ct);
            document.getElementById('id_loai_chuong_trinh').value = ct;
        }
        function neo_donvi(){
            var donvi = document.getElementById('neo_donvi');
            if(donvi.style.color === 'dodgerblue'){
                sessionStorage.removeItem('donvi');
                donvi.style.color = 'black';
            }else{
                sessionStorage.setItem('donvi',document.getElementById('id_don_vi').value);
                donvi.style.color = 'dodgerblue';
            }
        }
        function neo_ct(){
            var ct = document.getElementById('neo_ct');
            if(ct.style.color === 'dodgerblue'){
                sessionStorage.removeItem('ct');
                ct.style.color = 'black';
            }else{
                sessionStorage.setItem('ct',document.getElementById('id_loai_chuong_trinh').value);
                ct.style.color = 'dodgerblue';
            }
        }

        document.querySelector('#id_don_vi').addEventListener('change', (event) => {
            if(sessionStorage.getItem('donvi')){
                sessionStorage.setItem('donvi',document.getElementById('id_don_vi').value);
            }
        })
        document.querySelector('#id_loai_chuong_trinh').addEventListener('change', (event) => {
            if(sessionStorage.getItem('ct')){
                sessionStorage.setItem('ct',document.getElementById('id_loai_chuong_trinh').value);
            }
        })
    </script>
@endsection

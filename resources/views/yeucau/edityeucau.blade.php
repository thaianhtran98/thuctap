@extends('main')
@section('head')
    <script type="text/javascript" src="/template/admin/Inputmask/dist/jquery.inputmask.js"></script>
    <script type="text/javascript" src="/template/admin/jquery-ui-1.13.1.custom/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript" src="/template/admin/Inputmask/dist/inputmask.js"></script>
    <script type="text/javascript" src="/template/admin/jquery-ui-1.13.1.custom/jquery-ui.min.js"></script>
    {{--    <script type="text/javascript" src="/template/admin/js/jquery.inputmask.bundle.min.js"></script>--}}
    {{--    <script type="text/javascript" src="/template/js/"></script>--}}
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
        sessionStorage.clear();
        sessionStorage.setItem('ok',1);
        sessionStorage.setItem('yc_id',{{$yeucau->id}});
        @foreach($chitiet as $ctyc)
        sessionStorage.setItem('nv_{{$ctyc->id_nguoithuchien}}',{{$ctyc->id_nguoithuchien}})
        sessionStorage.setItem('chucvu_{{$ctyc->id_nguoithuchien}}',{{$ctyc->id_chucvu}})
        @endforeach

    </script>
@endsection
@section('content')
    <div class="container-xl m-t-50">
        @include('yeucau.giaodienthemdv')
        @include('yeucau.giaodienthemlct')
        @include('yeucau.giaodienaddyc')
        @include('alert')
        <label style="font-size: 20px;color: #007bff;margin-bottom: 10px">
            Cập Nhật Yêu Cầu: {{$yeucau->ten_yeu_cau}}
        </label>
        {{--        <form action="" method="POST">--}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Đơn Vị</label><font color="red"> (*)</font>
                    <div class="row">
                        <div class="col-md-11">
                            <select class="form-control" name="id_don_vi" id="id_don_vi" >
                                @foreach($dvs as $dv)
                                    <option value="{{$dv->id}}" {{$yeucau->id_don_vi == $dv->id ? 'selected' : ''}}>{{$dv->ten_don_vi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="button" onclick="show_add_dv()">
                                <span style="font-size: 25px;color: #007bff;">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="menu">Chương Trình</label><font color="red"> (*)</font>
                    <div class="row">
                        <div class="col-md-11">
                            <select class="form-control" name="id_loai_chuong_trinh" id="id_loai_chuong_trinh" >
                                @foreach($cts as $ct)
                                    <option value="{{$ct->id}}" {{$yeucau->id_loai_chuong_trinh == $ct->id ? 'selected' : ''}}>{{$ct->ten_chuong_trinh}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="button" onclick="show_add_lct()">
                                <span style="font-size: 25px;color: #007bff;">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="menu">Tên Yêu Cầu</label><font color="red"> (*)</font>
                    <input type="text" name="ten_yeu_cau" class="form-control" id="ten_yeu_cau" value="{{$yeucau->ten_yeu_cau}}"
                           placeholder="Enter tên yêu cầu" required>
                </div>

                <div class="form-group">
                    <label for="menu">Nội Dung Yêu Cầu</label><font color="red"> (*)</font>
                    <textarea class="form-control" id="noi_dung_yc" name="noi_dung_yc"
                              placeholder="Nhập nội dung yêu cầu" required>{{$yeucau->noi_dung_yeu_cau}} </textarea>
                </div>

                <div class="form-group">
                    <label for="menu">Trạng Thái</label><font color="red"> (*)</font>
                    <select class="form-control" name="trang_thai" id="trang_thai">
                        <option {{$yeucau->trang_thai == 0 ? 'selected' : ''}} value="0">Tiếp Nhận</option>
                        <option {{$yeucau->trang_thai == 1 ? 'selected' : ''}} value="1">Giao Việc</option>
                        <option {{$yeucau->trang_thai == 2 ? 'selected' : ''}} value="2">Đang Code</option>
                        <option {{$yeucau->trang_thai == 3 ? 'selected' : ''}} value="3">Đã Hoàn Thành</option>
                        <option {{$yeucau->trang_thai == 4 ? 'selected' : ''}} value="4">Đã Hostfix/Upcode</option>
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
                                    @foreach($chitiet as $ctyc)
                                    <input type="checkbox" {{$nv->id == $ctyc->id_nguoithuchien ? 'checked':''}}
                                           onclick=taoluutru('nv_{{$nv->id}}',{{$nv->id}})
                                           style="width: 20px;height: 20px" id="{{$nv->id}}" value="{{$nv->ten_nguoi_thuc_hien}}"
                                        @endforeach>
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
                            @foreach($chitiet as $ctyc)
                            <li id="nv_id{{$ctyc->id_nguoithuchien}}">
                                <div class="row" style="vertical-align: middle; height:40px;line-height:40px">
                                    <div style="vertical-align: middle;text-align:left" class="col-md-6">{{$ctyc->ct_nth->ten_nguoi_thuc_hien}}</div>
                                    <div style="vertical-align: middle;text-align:left " class="col-md-4">
                                        <select id="{{$ctyc->id_nguoithuchien}}_id_nhom">
                                            @foreach($chucvues as $cv)
                                                <option value="{{$cv->id}}"
                                                {{$ctyc->id_chucvu == $cv->id ? 'selected':''}}
                                                >{{$cv->ten_chuc_vu}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="vertical-align: middle;text-align:center " class="col-md-2">
                                        <button id="del_nv_id{{$ctyc->id_nguoithuchien}}" onclick="removeli({{$ctyc->id_nguoithuchien}})" class="btn btn-danger">X</button>
                                    </div>
                                </div>
                                <input name="nv_id[]" id="nv_input{{$ctyc->id_nguoithuchien}}"  style="display: none;"><hr></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

            <div style="  border-left: thin solid rgba(87,87,87,0.55);"></div>

            <div class="col-md-5">
                <div class="form-group">
                    <label for="menu">Ngày Tiếp Nhận</label><font color="red"> (*)</font>
                    <input type="text" name="ngaytiepnhan" data-inputmask="'alias': 'date'"
                           value="{{DateTime::createFromFormat('Y-m-d',$loaingay->ngaytiepnhan)->format('d-m-Y')}}"
                           id="ngaytiepnhan"
                           class="form-control" placeholder="dd/mm/yyyy">
                </div>

                <div class="form-group" id="form_ngaygiaoviec" style="display: none">
                    <label for="menu">Ngày Giao Việc</label>
                    <input type="text" id="ngaygiaoviec" data-inputmask="'alias': 'date'"
                           value="{{DateTime::createFromFormat('Y-m-d',$loaingay->ngaygiaoviec)->format('d-m-Y')}}"
                           name="ngaygiaoviec" class="form-control" placeholder="dd/mm/yyyy">
                </div>

                <div class="form-group">
                    <label for="menu">Ngày Hoàn Thành Dự Kiến</label>
                    <input type="text" id="ngayhoanthanhdukien" data-inputmask="'alias': 'date'"
                           value="{{DateTime::createFromFormat('Y-m-d',$loaingay->ngayhoanthanhdukien)->format('d-m-Y')}}"
                           name="ngayhoanthanhdukien" class="form-control" placeholder="dd/mm/yyyy">
                </div>

                <div class="form-group">
                    <label for="menu">Yêu Cầu Khác</label>
                    @if($yeucaukhac!=null)
                        <table style="text-align: center;width: 100%;visibility: visible" id="table_yc_plus" class="table" >
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
                            @foreach($yeucaukhac as $yck)
                                <tr id="yeucauthem{{$yck->id}}">
                                    <td>
                                        {{$yck->ten_thuoc_tinh}}
                                    </td>
                                    <td>
                                        {{$yck->noi_dung_thuoc_tinh}}
                                    </td>
                                    <td>
                                        <span onclick="del_yck({{$yck->id}})">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <span onclick="show_edit_yck({{$yck->id,$yck->ten_thuoc_tinh,$yck->kieu_thuoc_tinh,$yck->noi_dung_thuoc_tinh}})">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                    <button type="button" onclick="show_add_new_yc()">
                                <span style="font-size: 25px;color: #007bff;">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                    </button>
                </div>


                <div>
                    <button onclick="them_yeu_cau()" id="them" class="btn btn-primary m-t-50 m-l-10" style="float: right">Thêm Yêu Cầu</button>
                </div>
                <div>
                    <button onclick="cap_nhat_yeu_cau()" id="cap_nhat" class="btn btn-primary m-t-50 m-l-10" style="float: right ; display: none">Thêm Yêu Cầu</button>
                </div>
            </div>
        </div>
        @csrf
    </div>

    <script>

        function them_yeu_cau(){
            var id_don_vi = document.getElementById('id_don_vi').value;
            var id_loai_chuong_trinh = document.getElementById('id_loai_chuong_trinh').value;
            var ten_yeu_cau = document.getElementById('ten_yeu_cau').value;
            var noi_dung_yc = document.getElementById('noi_dung_yc').value;
            var trang_thai = document.getElementById('trang_thai').value;
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
            if (ten_yeu_cau!='' && noi_dung_yc!=''){
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
            }else {
                alert('Tên yêu cầu hoặc nội dung yêu cầu không được trống')
            }
        }

        function cap_nhat_yeu_cau(){
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

    <script>
        function show_edit_yck(id,tenthuoctinh,kieuthuoctinh,noidungthuoctinh) {
            if(sessionStorage.getItem('ok')!=1){
                if(confirm('Để thêm thuộc tính phải lưu lại yêu cầu này?')){
                    add_yeu_cau();
                }
            }else {
                sessionStorage.setItem('ok',1);
                document.getElementById('form_add_new_yc').style.display = 'block';
                document.getElementById('form_add_new_yc').style.background = 'white';
                document.getElementById('body').style.display = 'block';

            }
        }
    </script>

    {{--    Xử lý ngày tháng năm và bấm enter--}}
    <script>
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
                Number(document.getElementById('ngaytiepnhan').value.substr(0, 2)))
        });

        $(document).ready(function () {
            // $("#ngaytiepnhan").extendAliases();
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

        $("#ngaytiepnhan").datepicker({dateFormat: 'dd/mm/yyyy', minDate: new Date(1999, 10 - 1, 25)});


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

        $(document).ready(function () {
            if (document.getElementById('trang_thai').value == 1) {
                document.getElementById('form_ngaygiaoviec').style.display = 'block';
                document.getElementById('addnv').style.display = 'block';
                document.getElementById('nv_selected').style.display = 'block';
            } else {
                document.getElementById('form_ngaygiaoviec').style.display = 'none';
                document.getElementById('addnv').style.display = 'none';
                document.getElementById('nv_selected').style.display = 'none';
            }
        });

        document.querySelector('#trang_thai').addEventListener('change', (event) => {
            if (document.getElementById('trang_thai').value > 0) {
                document.getElementById('form_ngaygiaoviec').style.display = 'block';
                document.getElementById('addnv').style.display = 'block';
                document.getElementById('nv_selected').style.display = 'block';
            } else {
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
@endsection

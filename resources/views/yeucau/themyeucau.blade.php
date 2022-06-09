@extends('main')
@section('head')
    <script type="text/javascript" src="/template/admin/Inputmask/dist/jquery.inputmask.js"></script>
    <script type="text/javascript" src="/template/admin/jquery-ui-1.13.1.custom/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript" src="/template/admin/Inputmask/dist/inputmask.js"></script>
@endsection
@section('content')
    <div class="container-xl m-t-50">
        @include('yeucau.giaodienthemdv')
        @include('yeucau.giaodienthemlct')
        @include('alert')
        <label style="font-size: 20px;color: #007bff;margin-bottom: 10px">
            Thêm Yêu Cầu
        </label>
        <form action="" method="POST">
            <div class="row">
                {{--                <div class="col-md-1"></div>--}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Đơn Vị</label><font color="red"> (*)</font>
                        <div class="row">
                            <div class="col-md-11">
                                <select class="form-control" name="id_don_vi" id="id_don_vi" >
                                    @foreach($dvs as $dv)
                                        <option value="{{$dv->id}}">{{$dv->ten_don_vi}}</option>
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
                                        <option value="{{$ct->id}}">{{$ct->ten_chuong_trinh}}</option>
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
                        <input type="text" name="ten_yeu_cau" class="form-control" id="ten_yeu_cau"
                               placeholder="Enter tên yêu cầu">
                    </div>

                    <div class="form-group">
                        <label for="menu">Nội Dung Yêu Cầu</label><font color="red"> (*)</font>
                        <textarea class="form-control" id="noi_dung_yc" name="noi_dung_yc"
                                  placeholder="Nhập nội dung yêu cầu"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="menu">Trạng Thái</label><font color="red"> (*)</font>
                        <select class="form-control" name="trang_thai" id="trang_thai">
                            <option value="0">Tiếp Nhận</option>
                            <option value="1">Giao Việc</option>
                            {{--                            <option value="2">Đang Code</option>--}}
                            {{--                            <option value="3">Đã Hoàn Thành</option>--}}
                            {{--                            <option value="5">Đã Hostfix/Upcode</option>--}}
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
                                               onclick=taoluutru({{$nv->id}},{{$nv->id}})
                                               style="width: 20px;height: 20px" id="{{$nv->id}}" value="{{$nv->id}}">
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
                            <ul id="danhsachchon">

                            </ul>
                        </div>
                    </div>

                </div>

                <div style="  border-left: thin solid rgba(87,87,87,0.55);"></div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="menu">Ngày Tiếp Nhận</label><font color="red"> (*)</font>
                        <input type="text" name="ngaytiepnhan" data-inputmask="'alias': 'date'" id="ngaytiepnhan"
                               class="form-control" placeholder="dd/mm/yyyy">
                    </div>

                    <div class="form-group" id="form_ngaygiaoviec" style="display: none">
                        <label for="menu">Ngày Giao Việc</label>
                        <input type="text" id="ngaygiaoviec" data-inputmask="'alias': 'date'"
                               name="ngaygiaoviec" class="form-control" placeholder="dd/mm/yyyy">
                    </div>

                    <div class="form-group">
                        <label for="menu">Ngày Hoàn Thành Dự Kiến</label>
                        <input type="text" id="ngayhoanthanhdukien" data-inputmask="'alias': 'date'"
                               name="ngayhoanthanhdukien" class="form-control" placeholder="dd/mm/yyyy">
                    </div>

                    <div class="form-group">
                        <label for="menu">Yêu Cầu Thêm</label><br>
                        <button type="button" onclick="show_add_lct()">
                                <span style="font-size: 25px;color: #007bff;">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                        </button>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary m-t-50" style="float: right">Thêm Yêu Cầu</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
    <script type="text/javascript" src="/template/admin/jquery-ui-1.13.1.custom/jquery-ui.min.js"></script>
{{--    <script type="text/javascript" src="/template/admin/js/jquery.inputmask.bundle.min.js"></script>--}}
{{--    <script type="text/javascript" src="/template/js/"></script>--}}
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
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
        ngaytiepnhan = document.getElementById('ngaytiepnhan');
        document.getElementById('ngaytiepnhan').value = day + '/' + month + '/' + year;

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

        document.querySelector('#trang_thai').addEventListener('change', (event) => {
            if (document.getElementById('trang_thai').value == 1) {
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
    <script>
        let i = 0;

        function taoluutru(name, id) {
            if (document.getElementById(name).checked === true) {
                sessionStorage.setItem(name, id)
                var ul = document.getElementById("danhsachchon");
                var li = document.createElement("li");
                var btn = document.createElement("button");
                var input = document.createElement('input');
                var hr = document.createElement('hr');
                li.appendChild(document.createTextNode(document.getElementById(sessionStorage.getItem(name)).value));
                li.setAttribute("id", 'nv_id' + sessionStorage.getItem(name));
                btn.setAttribute("id", 'del_nv_id' + sessionStorage.getItem(name));
                btn.setAttribute("class", 'btn btn-danger');
                btn.appendChild(document.createTextNode('Xóa'));
                input.setAttribute("name", 'nv_id[]');
                input.setAttribute("id", 'nv_input' + sessionStorage.getItem(name));
                li.appendChild(btn);
                li.appendChild(input);
                li.appendChild(hr);
                ul.appendChild(li);
                document.getElementById('nv_input' + sessionStorage.getItem(name)).style.display = 'none';
                document.getElementById('nv_input' + sessionStorage.getItem(name)).value = sessionStorage.getItem(name);
                document.getElementById('del_nv_id' + sessionStorage.getItem(name)).style.right = 0;
                document.getElementById('del_nv_id' + sessionStorage.getItem(name)).style.float = 'right';
                document.getElementById('del_nv_id' + sessionStorage.getItem(name)).onclick = function () {
                    removeli(sessionStorage.getItem(name))
                };
            } else {
                let li_rm = document.querySelector('#nv_id' + sessionStorage.getItem(name))
                li_rm.remove();
                sessionStorage.removeItem(name);
            }
        };

        function removeli(song_id) {
            let btn_rm = document.querySelector('#del_nv_id' + song_id);
            let li_rm = document.querySelector('#nv_id' + song_id);
            btn_rm.remove();
            li_rm.remove();
            sessionStorage.removeItem(song_id);
            document.getElementById(song_id).checked = false;
        }
    </script>
@endsection

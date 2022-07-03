@extends('main')
@section('head')
    <script type="text/javascript" src="/template/admin/Inputmask/dist/jquery.inputmask.js"></script>
    <script type="text/javascript" src="/template/admin/jquery-ui-1.13.1.custom/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="/template/admin/ui/jquery-ui.css"/>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
        // var donvi = sessionStorage.getItem('donvi');
        // var ct = sessionStorage.getItem('ct');
        sessionStorage.clear();
        // sessionStorage.setItem('ok',0);
    </script>

@endsection
@section('content')
<div class="m-t-50 m-r-20 m-l-20">
        <div class="row">
            @include('alert')

            <div class="col-md-4">
                <label style="font-size: 20px;color: #007bff">
                    Thêm Kỳ Báo Cáo
                </label>
            <form action="" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="menu">Năm</label>
                                @if(count($ky)==0)
                                    <input type="number" class="form-control" id="nam" name="nam"
                                           placeholder="Nhập năm" min="{{$nam_now}}" value="{{$nam_now}}">
                                    <br>
                                @else
                                    <input type="number" class="form-control" id="nam" name="nam"
                                           placeholder="Nhập năm" min="{{DateTime::createFromFormat('Y-m-d',$ky[count($ky)-1]->denngay)->format('Y')}}"
                                           value="{{DateTime::createFromFormat('Y-m-d',$ky[count($ky)-1]->denngay)->format('Y')}}">
                                    <br>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="menu">Tuần</label>
                                    @if(count($ky)==0)
                                        <input type="number" class="form-control" id="tuan" name="tuan"
                                               placeholder="Nhập năm" min="1"
                                               value="1">
                                        <br>
                                    @else
                                        <input type="number" class="form-control" id="tuan" name="tuan"
                                               placeholder="Nhập năm" min="{{$ky[count($ky)-1]->tuan}}+1" value="{{$ky[count($ky)-1]->tuan+1}}">
                                        <br>
                                    @endif
                                <br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="menu">Từ ngày</label>
                                <input type="text" class="form-control" name="tungay" id="tungay">
                                <br>
                            </div>

                            <div class="col-md-6">
                                <label for="menu">Đến ngày</label>
                                <input type="text" class="form-control" name="denngay" id="denngay">
                                <br>
                            </div>

                            <div class="col-md-8" style="display: flex; line-height: 20px">
                                <label for="menu">Chốt :</label>
                                <input type="checkbox" value="1" name="chot" id="chot" style="width: 20px;height: 20px;margin-left: 10px;size: 40px">
                            </div>
                            <button style="width: auto; float: right; margin-left: auto; margin-right: 0" type="submit" class="btn btn-primary">Thêm Kỳ Báo Cáo</button>
                        </div>
                    </div>
                    @csrf
                </div>
            </form>
        </div>
        <div style="border-left: thin solid rgba(87,87,87,0.55);width:4.33333333%;margin-left: 4%"></div>
        <div class="col-md-7">
            @include('baocao.danhsach_ky')
        </div>
    </div>
</div>
    <script>
        @if(count($ky_exist)!=0)
        sessionStorage.setItem('ngaybatdau_kymoi','{{$ky[count($ky)-1]->denngay}}');
        var ngaybatdau_kymoi = '{{DateTime::createFromFormat('Y-m-d',$ky[count($ky)-1]->denngay)->format('d/m/Y')}}';
        @endif
        var get_day_of_month = (year, month) => {
            return new Date(year, month, 0).getDate();
        };

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

        $("#tungay").datepicker({
            dateFormat: 'dd/mm/yy',
            minDate: new Date(
                document.getElementById('tungay').value.substr(6, 4),
                document.getElementById('tungay').value.substr(3, 2)-1,
                Number(document.getElementById('tungay').value.substr(0, 2)) + 1)
        });

        if(sessionStorage.getItem('ngaybatdau_kymoi')){
            var max_day = get_day_of_month(ngaybatdau_kymoi.substr(6,4),ngaybatdau_kymoi.substr(3,2));
        }


        var ngay_tu_ngay = 0;
        $(document).ready(function () {
            if(sessionStorage.getItem('ngaybatdau_kymoi')){
                var tungay = Number(ngaybatdau_kymoi.substr(0,2)) + 1;
                var tuthang = Number(ngaybatdau_kymoi.substr(3,2));
                if (tungay>max_day){
                    tungay=1;
                    ngay_tu_ngay = tungay;
                    tuthang+=1;
                }
                if (tuthang<10){
                    tuthang = '0' +tuthang;
                }
                if (tungay<10){
                    document.getElementById('tungay').value =  '0' + tungay + '/'+ tuthang + '/' + ngaybatdau_kymoi.substr(6,4);
                }else {
                    document.getElementById('tungay').value =   tungay + '/'+ tuthang + '/' + ngaybatdau_kymoi.substr(6,4);
                }
            }else{
                document.getElementById('tungay').value = day + '/' + month + '/' + year;
            }
            $("#tungay").inputmask("99/99/9999", {
                "placeholder": "dd/mm/yyyy",
                'alias': 'date',
                "oncomplete": function () {
                    let elementrm = document.getElementById('denngay');
                    elementrm.classList.remove("hasDatepicker");

                    $("#denngay").datepicker({
                        dateFormat: 'dd/mm/yy', minDate: new Date(
                            document.getElementById('tungay').value.substr(6, 4),
                            document.getElementById('tungay').value.substr(3, 2)-1,
                            Number(document.getElementById('tungay').value.substr(0, 2)) + 1)
                    });
                }
            });
        });

        $("#denngay").datepicker({
            dateFormat: 'dd/mm/yy',
        });

        $(document).ready(function () {
            if(sessionStorage.getItem('ngaybatdau_kymoi')){
                var ngayden = Number(ngaybatdau_kymoi.substr(0,2)) + 2;
                var tuthang = Number(ngaybatdau_kymoi.substr(3,2));
                if (ngayden>max_day){
                    ngayden=ngay_tu_ngay + 1;
                    tuthang+=1;
                }
                if (tuthang<10){
                    tuthang = '0' + tuthang;
                }
                if (ngayden<10){
                    document.getElementById('denngay').value =  '0' + ngayden + '/'+ tuthang + '/' + ngaybatdau_kymoi.substr(6,4);
                }else {
                    document.getElementById('denngay').value =   ngayden + '/'+ tuthang + '/' + ngaybatdau_kymoi.substr(6,4);
                }
            }else{
                day=Number(day)+1;
                if(day<10){
                    day = '0'+day;
                }
                document.getElementById('denngay').value = day + '/' + month + '/' + year;
            }
            $("#denngay").inputmask("99/99/9999", {
                "placeholder": "dd/mm/yyyy",
                'alias': 'date',
                "oncomplete": function () {
                    if (document.getElementById('denngay').value <= document.getElementById('tungay').value) {
                        document.getElementById('denngay').value = '';
                        alert('Vui lòng nhập lại');
                    }
                }
            });
        });


        document.querySelector('#denngay').addEventListener('mouseover', (event) => {
            let denngay = document.getElementById('denngay');
            denngay.classList.remove("hasDatepicker");

            $("#denngay").datepicker({
                dateFormat: 'dd/mm/yy', minDate: new Date(
                    document.getElementById('tungay').value.substr(6, 4),
                    document.getElementById('tungay').value.substr(3, 2)-1,
                    Number(document.getElementById('tungay').value.substr(0, 2)) + 1)
            });
        })

        document.querySelector('#tungay').addEventListener('mouseover', (event) => {
            let tungay = document.getElementById('tungay');
            tungay.classList.remove("hasDatepicker");

            $("#tungay").datepicker({
                dateFormat: 'dd/mm/yy', maxDate: new Date(
                    document.getElementById('denngay').value.substr(6, 4),
                    document.getElementById('denngay').value.substr(3, 2)-1,
                    Number(document.getElementById('denngay').value.substr(0, 2)) -1)
            });
        })


        $(document).ready(function() {
            if (ngaybatdau_kymoi >= '31/12/{{$nam_now}}') {
                document.getElementById('nam').value = Number(document.getElementById('nam').value) + 1;
                document.getElementById('nam').setAttribute('min', document.getElementById('nam').value);
                document.getElementById('tuan').value = 1;
                document.getElementById('tuan').setAttribute('min', document.getElementById('tuan').value);
                let tungay = document.getElementById('tungay');
                tungay.classList.remove("hasDatepicker");
                let denngay = document.getElementById('denngay');
                denngay.classList.remove("hasDatepicker");
                $("#tungay").datepicker({
                    dateFormat: 'dd/mm/yy', minDate: new Date('01', '01', document.getElementById('nam').value)
                });
                $("#denngay").datepicker({
                    dateFormat: 'dd/mm/yy', minDate: new Date('02', '01', document.getElementById('nam').value)
                });
                document.getElementById('tungay').value = '01' + '/' + '01' + '/' + document.getElementById('nam').value;
                document.getElementById('denngay').value = '02' + '/' + '01' + '/' + document.getElementById('nam').value;
            }
        });

        var nam_hien_hanh = document.getElementById('nam').value;
        var tuan_hien_hanh = document.getElementById('tuan').value;

        $(document).ready(function() {
            $('#nam').bind('change',
                function change_nam(){
                    if (document.getElementById('nam').value===nam_hien_hanh){
                        document.getElementById('tuan').value=tuan_hien_hanh;

                        if(sessionStorage.getItem('ngaybatdau_kymoi')){
                            var ngayden = Number(ngaybatdau_kymoi.substr(0,2)) + 1;
                            if (ngayden<10){
                                document.getElementById('denngay').value =  '0' + ngayden + '/'+ngaybatdau_kymoi.substr(3,2) + '/' + ngaybatdau_kymoi.substr(6,4);
                                document.getElementById('tungay').value = ngaybatdau_kymoi.substr(0,2) + '/'+ngaybatdau_kymoi.substr(3,2) + '/' + ngaybatdau_kymoi.substr(6,4);
                            }else {
                                document.getElementById('denngay').value =   ngayden + '/'+ngaybatdau_kymoi.substr(3,2) + '/' + ngaybatdau_kymoi.substr(6,4);
                                document.getElementById('tungay').value = ngaybatdau_kymoi.substr(0,2) + '/'+ngaybatdau_kymoi.substr(3,2) + '/' + ngaybatdau_kymoi.substr(6,4);
                            }
                        }else{
                            document.getElementById('tungay').value = day + '/' + month + '/' + year;
                            document.getElementById('denngay').value = day+1 + '/' + month + '/' + year;
                        }
                    }else {
                        document.getElementById('tuan').value= 1;
                        let tungay = document.getElementById('tungay');
                        tungay.classList.remove("hasDatepicker");
                        let denngay = document.getElementById('denngay');
                        denngay.classList.remove("hasDatepicker");
                        $("#tungay").datepicker({
                            dateFormat: 'dd/mm/yy', minDate: new Date('01','01',document.getElementById('nam').value)
                        });
                        $("#denngay").datepicker({
                            dateFormat: 'dd/mm/yy', minDate: new Date('02','01',document.getElementById('nam').value)
                        });
                        document.getElementById('tungay').value = '01' + '/' +'01' + '/' + document.getElementById('nam').value;
                        document.getElementById('denngay').value = '02' + '/' +'01' + '/' + document.getElementById('nam').value;
                    }
                }
            )}
        );

    </script>


@endsection

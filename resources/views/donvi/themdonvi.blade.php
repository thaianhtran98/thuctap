@extends('main')

@section('content')
    <div class="container m-t-50">
        @include('alert')
        <div id="form-add" class="row"
             style="display: none;background-color: rgba(46,52,57,0.33);left: 25%; position: absolute;z-index: 10000">
            <div class="col-sm-12 m-b--12 m-t-12" style="text-align: center">
                <label style="font-size: 20px;color: #007bff">
                    Thêm Đơn Vị
                </label>
            </div>
            <div class="col-md-12">
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="menu">Tên Đơn Vị</label><font color="red"> (*)</font>
                                    <input type="text" name="name" class="form-control" id="ten_dv"
                                           placeholder="Nhập tên đơn vị" required>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="menu">Lũy Kế Đầu Kỳ</label>
                                    <input type="number" name="luyke" class="form-control" id="luyke_dv"
                                           placeholder="Nhập lũy kế đầu kỳ">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Ưu tiên</label><font color="red"> (*)</font>
                                        <input type="number" class="form-control" name="uutien" id="uutien_dv"
                                               placeholder="Nhập độ ưu tiên">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kích hoạt</label> <br>
                                        <div style="display: flex; margin-top: 10px">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" value="1" type="radio" name="active"
                                                       checked id="active">
                                                <label for="active" class="custom-control-label">Có</label>
                                            </div>
                                            <div class="custom-control custom-radio m-l-10">
                                                <input class="custom-control-input" value="0" type="radio" name="active"
                                                       id="no_active">
                                                <label for="no_active" class="custom-control-label">Không</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button style="width: 100%;" type="submit" class="btn btn-primary">Thêm Đơn Vị</button>

                            </div>
                        </div>
                        @csrf
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row" style="display: flex">
            <label style="font-size: 20px;color: #007bff">
                Danh Sách Đơn Vị
            </label>
            <button class="btn btn-primary" style="float: right;
             margin-left: auto;margin-right: 8px;font-size: 20px" id="show-add-dv" onclick="show_add_dv()">
                Thêm đơn vị
            </button>
            <script>
                function show_add_dv() {
                    document.getElementById('form-add').style.display = 'block';
                    // document.getElementById('form-add').style.display = 'absolute';
                    document.getElementById('form-add').style.background = 'white';
                    document.getElementById('body').style.display = 'block';
                }

                function page_normal() {
                    document.getElementById('body').style.display = 'none';
                    document.getElementById('form-add').style.display = 'none';
                }
            </script>
            <div class="col-md-12">
                @include('donvi.danhsachdonvi')
            </div>
        </div>
    </div>

    <script>

        $('#ten_dv').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#luyke_dv').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });
        $('#luyke_dv').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#uutien_dv').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });
        $('#uutien_dv').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#active').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });
        $('#active').keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) {
                $('#no_active').focus();
                event.preventDefault(); //preventDefault() Không load lại form
            }
        });
    </script>
@endsection



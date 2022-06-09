@extends('main')

@section('content')
    <div class="container-xl m-t-50" style="align-content: center">
        @include('alert')
        <div id="form-add" class="row"
             style="display: none;background-color: rgba(46,52,57,0.33); position: absolute;z-index: 10000;left: 32%">
            <div class="col-sm-12 m-b--12 m-t-12" style="text-align: center">
                <label style="font-size: 20px;color: #007bff">
                    Thêm Nhân Viên
                </label>
            </div>
            <div class="col-md-12">
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="menu">Tên Nhân Viên</label><font color="red"> (*)</font>
                                    <input type="text" name="name" class="form-control" id="ten_nv"
                                           placeholder="Nhập tên đơn vị" required>
                                    <br>
                                </div>

                                <div class="col-md-12">
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
                                <button style="width: 100%;" type="submit" class="btn btn-primary">Thêm Nhân Viên
                                </button>
                            </div>
                            @csrf
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row" style="display: flex">
            <label style="font-size: 20px;color: #007bff;margin-top: 50px">
                Danh Sách Nhân Viên
            </label>
            <button class="btn btn-primary" style="float: right; margin-left: auto;margin-right: 8px;font-size: 20px;margin-bottom: 50px" id="show-add-dv" onclick="show_add_dv()">
                Thêm Nhân Viên
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
                @include('nhanvien.danhsachnhanvien')
            </div>
        </div>
    </div>

    <script>

        $('#ten_nv').keypress(function (event) {
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



@extends('main')

@section('content')
    <div class="container-xl m-t-50" style="align-content: center">
        @include('loaichuongtrinh.giaodienthem')
        <hr>
        <div class="row" style="display: flex">
            <label style="font-size: 20px;color: #007bff;margin-top: 50px">
                Danh Sách Chương Trình
            </label>
            <button class="btn btn-primary" style="float: right; margin-left: auto;margin-right: 8px;font-size: 20px;margin-bottom: 50px" id="show-add-dv" onclick="show_add_dv()">
                Thêm Chương Trình
            </button>
            <div class="col-md-12">
                @include('loaichuongtrinh.danhsachloaichuongtrinh')
            </div>
        </div>
    </div>

    <script>
        $('#ten_ct').keypress(function (event) {
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



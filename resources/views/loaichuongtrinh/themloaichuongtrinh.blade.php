@extends('main')

@section('content')
    <div class="container-xl m-t-50" style="align-content: center">
        <div class="row">
            <div class="col-md-5">
                @include('loaichuongtrinh.giaodienthem')
            </div>
            <div style=" border-left: thin solid rgba(87,87,87,0.55);"></div>
            <div class="col-md-6">
                <label style="font-size: 20px;color: #007bff;margin-top: 50px">
                    Danh Sách Chương Trình
                </label>
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



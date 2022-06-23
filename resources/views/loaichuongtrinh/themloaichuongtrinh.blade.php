@extends('main')

@section('content')
    <div class="m-t-50 m-l-10 m-r-10" >
        @include('alert')
        <div class="row">
            <div class="col-md-4">
                @include('loaichuongtrinh.giaodienthem')
            </div>
            <div style="border-left: thin solid rgba(87,87,87,0.55);width:4.33333333%;margin-left: 4%"></div>
            <div class="col-md-7">
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



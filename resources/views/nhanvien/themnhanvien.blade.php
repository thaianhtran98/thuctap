@extends('main')
@section('content')
    <div class="m-r-10 m-l-10 m-t-50" style="align-content: center">
        @include('alert')
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            @include('nhanvien.giaodienthemcv')
            @include('nhanvien.giaodienthemnv')
        </div>
{{--        <label style="font-size: 20px;color: #007bff;">Danh Mục Quản Lý > Nhân Viên</label>--}}
        <div class="row" style="display: flex">
            <div style="display: flex;float: right; margin-left: auto;margin-right: 8px;font-size: 20px;">
                <button class="btn btn-primary" id="show-add-dv" onclick="show_add_nv()">
                    Thêm Nhân Viên
                </button>
                <br>
                <button class="btn btn-primary m-l-10" id="show-add-dv" onclick="show_add_nhom_nv()">
                    Thêm Chức Vụ
                </button>
            </div>
        </div>
        <hr>
        <div class="row " >
            <div class="col-md-6">
                <label style="font-size: 20px;color: #007bff;">
                    Danh Sách Nhân Viên
                </label>
                @include('nhanvien.danhsachnhanvien')
            </div>
            <div style=" border-left: thin solid rgba(87,87,87,0.55);width:4.33333333%;margin-left: 4%  "></div>
            <div class="col-md-5">
                <label style="font-size: 20px;color: #007bff;">
                    Danh Sách Chức Vụ
                </label>
                @include('nhanvien.danhsachchucvu')
                <button class="btn btn-danger btn-sm" type="button" id="button_del_cv" href="#"
                        onclick="delid_cv()" style="display: none; height: 50px;width: 100px">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>

@endsection



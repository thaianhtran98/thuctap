@extends('main')
@section('content')
    @include('alert')
    <div class="container-xl m-t-50">
{{--        <div class="row">--}}
{{--            <div class="form-group col-md-4">--}}
{{--                <label>Năm: </label>--}}
{{--                <select class="form-control">--}}
{{--                    @foreach($nam as $nam)--}}
{{--                        <option {{date('Y' ,time()) == $nam->nam ? 'selected':'' }} value="{{$nam->nam}}">--}}
{{--                            {{ $nam->nam}}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                <label>Tháng: </label>--}}
{{--                <select class="form-control">--}}
{{--                    @foreach($thang as $thang)--}}
{{--                        <option {{date('m' ,time()) == $thang->thang ? 'selected':'' }} value="{{$nam->nam}}">--}}
{{--                            {{$thang->thang}}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                <label>Tuần: </label>--}}
{{--                <select class="form-control">--}}
{{--                    @foreach($tuan as $tuan)--}}
{{--                        <option>--}}
{{--                            {{$tuan->tuan}}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
        <table class="table">
            <thead style="background: #0c84ff;color: white">
            <tr style="text-align: center">
                <th>STT</th>
                <th>Đơn Vị Yêu Cầu</th>
                <th>Lũy Kế Đầu Kỳ</th>
                <th>Tổng Yêu Cầu</th>
                <th>SL Yêu Cầu Đã Xong</th>
                <th>SL Yêu Cầu Tồn</th>
                <th>SL Hostfix</th>
            </tr>
            </thead>
            <tbody>
                @foreach($donvi as $key => $dv)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$dv->ten_don_vi}}</td>
                        <td>{{$dv->luy_ke_dau_ky}}</td>
{{--                        <td>{{$dv->luy_ke_hang_tuan}}</td>--}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('footer')
@endsection

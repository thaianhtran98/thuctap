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
                <th>Tổng Yêu Cầu Trong Tuần</th>
                <th>SL Yêu Cầu Đã Xong</th>
                <th>SL Yêu Cầu Tồn</th>
                <th>SL Yêu Cầu Đang Thực Hiện</th>
                <th>SL Hostfix</th>
            </tr>
            </thead>
            <tbody>
                @foreach($donvi as $key => $dv)
                    <tr>
                        <td style="text-align: center;">{{$key+1}}</td>
                        <td>{{$dv->ten_don_vi}}</td>
                        <td style="text-align: center;">{{$dv->luy_ke_dau_ky}}</td>

                        @if(count($dv->donvi_kybaocao)==1)
                            @foreach($dv->donvi_kybaocao as $baocao)
                                <td  style="text-align: center;">{{$baocao->luyke}}</td>
                                <td  style="text-align: center;">{{$baocao->tongyeucautrongtuan}}</td>
                                <td  style="text-align: center;">{{$baocao->yeucaudahoanthanh}}</td>
                                <td  style="text-align: center;">{{$baocao->yeucauconton}}</td>
                                <td  style="text-align: center;">{{$baocao->yeucaudangthuchien}}</td>
                                <td  style="text-align: center;">{{$baocao->yeucaudahostfix}}</td>
                            @endforeach
                        @else
                            <td  style="text-align: center;">{{$dv->luy_ke_dau_ky}}</td>
                            <td  style="text-align: center;">0</td>
                            <td  style="text-align: center;">0</td>
                            <td  style="text-align: center;">0</td>
                            <td  style="text-align: center;">0</td>
                            <td  style="text-align: center;">0</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('footer')
@endsection

@extends('main')
@section('content')
    @include('alert')

    <div class="m-t-50 m-r-10 m-l-10">
        <div class="row" >
            <div class="col-md-3" style="margin-left: 2%">

            </div>
            <div class="col-md-1">
                <label for="menu">Năm</label>
                <select id="nam" name="nam" class="form-control">
                    @if(count($ky)!=0)
                    @php
                        $nam = $ky[0]->nam;
                    @endphp
                    <option value="{{ $ky[0]->nam}}">
                        {{ $ky[0]->nam}}
                    </option>
                    @endif
                    @foreach($ky as $k)
                        @if($k->nam != $nam)
                            <option value="{{ $k->nam}}">
                                {{ $k->nam}}
                            </option>
                            @php
                                $nam = $k->nam;
                            @endphp
                        @else
                            @continue
                        @endif
                    @endforeach
                </select>
                <br>
            </div>
            <div class="col-md-3">
                <label for="menu">Kỳ</label>
                <select id="ky" name="ky" class="form-control">
                    @foreach($ky as $k)
                        @if($ky[0]->nam == DateTime::createFromFormat('Y-m-d',$k->tungay)->format('Y'))
                        <option value="{{$k->id}}">
                            Kỳ {{$k->tuan}}: Từ {{DateTime::createFromFormat('Y-m-d',$k->tungay)->format('d/m/Y')}} đến {{DateTime::createFromFormat('Y-m-d',$k->denngay)->format('d/m/Y')}}
                        </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-2" style="line-height: 88px">
                <button class="form-control btn btn-primary" onclick="xembaocao()">
                    Xem báo cáo
                </button>
            </div>
        </div>
    <hr>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $('#nam').bind('change',
                function change_nam(){
                    var url = '/load_ky/';
                    var nam = document.getElementById('nam').value;
                    $.ajax({
                        // cache: false,
                        type: 'POST',
                        datatype: 'JSON',
                        data: { nam },
                        url: url,
                        success:function (result){
                            if (result.error === true){
                                alert('Hiện không có kỳ này');
                                location.reload();
                            }else {
                                console.log(result.kys);
                                var  html='';
                                $.each(result.kys, function (i,item){
                                    var tungay =  item.tungay.substr(8,2) + '/'+ item.tungay.substr(5,2) + '/' +  item.tungay.substr(0,4);
                                    var denngay =  item.denngay.substr(8,2) + '/'+ item.denngay.substr(5,2) + '/' +  item.denngay.substr(0,4);
                                    html +='<option value="'+ item.id +'">';
                                    html +='Kỳ ' + item.tuan + ': Từ ' + tungay + ' đến ' + denngay ;
                                    html +='</option>';
                                });
                                $('#ky').html(html);
                            }
                        }
                    })
                }
        )});


        function xembaocao(){
            window.location = '/xembaocao/'+document.getElementById('ky').value;
        }
    </script>
@endsection

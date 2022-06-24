@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if( Session::has('error'))
    <div id="thongbaothatbai" class="alert alert-danger" style="position: absolute;top: 63px;left: 10px">
        {{Session::get('error')}}
    </div>
    <script>
        $(document).ready(function () {
            document.getElementById('thongbaothatbai').style.visibility = 'visible';
            setTimeout(function(){
                document.getElementById('thongbaothatbai').style.visibility = 'hidden';
            }, 5000);
        })
    </script>
@endif

@if(Session::has('success'))
    <div id="thongbaothanhcong" class="alert alert-success" style="position: absolute;top: 63px;left: 10px">
        {{Session::get('success')}}
    </div>
    <script>
        $(document).ready(function () {
            document.getElementById('thongbaothanhcong').style.visibility = 'visible';
            setTimeout(function(){
                document.getElementById('thongbaothanhcong').style.visibility = 'hidden';
            }, 5000);
        })
    </script>
@endif



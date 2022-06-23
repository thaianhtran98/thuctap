@extends('main')
@section('content')
    @include('alert')
<div class="m-t-50 m-r-10 m-l-10">
        <div class="row">
            <div class="col-md-8">
            <form action="" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="menu">Tuần</label>
                            <input type="number" class="form-control" id="ten_dv"
                                   placeholder="Nhập năm" min="2021" max="2033">
                            <br>
                        </div>

                        <div class="col-md-6">
                            <label for="menu">Tuần</label>
                            <input type="number" class="form-control" id="ten_dv"
                                   placeholder="Nhập tuần" min="1" max="52">
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="menu">Từ ngày</label>
                            <input type="text" class="form-control" id="tungay">
                            <br>
                        </div>

                        <div class="col-md-6">
                            <label for="menu">Đến ngày</label>
                            <input type="text" class="form-control" id="denngay">
                            <br>
                        </div>

                        <button style="width: 100%;" type="submit" class="btn btn-primary">Thêm Kỳ Báo Cáo</button>
                    </div>
                </div>
                @csrf
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
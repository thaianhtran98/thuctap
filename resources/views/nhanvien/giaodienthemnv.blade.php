<div id="form-add" class="row"
     style="display: none;background-color: rgba(46,52,57,0.33); position: absolute;z-index: 10000;top: 50px">
    <div class="col-sm-12 m-b--12 m-t-12" style="text-align: center">
        <label style="font-size: 20px;color: #007bff">
            Thêm Nhân Viên
        </label>
    </div>
    <div class="col-md-12">
{{--        <form action="" method="POST">--}}
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="menu">Tên Nhân Viên</label><font color="red"> (*)</font>
                            <input type="text" name="ten_nv" class="form-control" id="ten_nv"
                                   placeholder="Nhập tên nhân viên" required>
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
                        <button id="add_nv" style="width: 100%;" onclick="add_nv()" class="btn btn-primary">Thêm Nhân Viên
                        </button>
                    </div>
                    @csrf
                </div>
            </div>
{{--        </form>--}}
    </div>
</div>


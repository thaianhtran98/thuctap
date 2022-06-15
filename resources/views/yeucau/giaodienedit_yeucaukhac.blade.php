<div id="form_add_new_yc" class="row" style="width: 35%; display: none;background-color: rgba(46,52,57,0.33);margin-left: 15%; position: absolute;z-index: 10003;">
    <div class="col-sm-12 m-b--12 m-t-12" style="text-align: center">
        <label style="font-size: 20px;color: #007bff">
            Thêm Yêu Cầu
        </label>
    </div>
    <div class="col-md-12">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="menu">Tên Yêu Cầu</label><font color="red"> (*)</font>
                        <input type="text" name="edit_ten_thuoc_tinh" class="form-control" id="edit_ten_thuoc_tinh"
                               placeholder="Nhập tên đơn vị" required>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="menu">Kiểu dữ liệu</label>
                        <select class="form-control" id ='edit_kieu_thuoc_tinh'>
                            <option value="0">
                                Varchar
                            </option>
                            <option value="1">
                                Date
                            </option>
                            <option value="2">
                                LongText
                            </option>
                            <option value="3">
                                Integer
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div  class="form-group">
                            <label>Nội Dung Thuộc Tính</label><font color="red"> (*)</font>
                            <div id="edit_noi_dung_theo_kieu">
                                <input type="text" name="name_tt" class="form-control" id="edit_noi_dung_thuoc_tinh" placeholder="Nhập nội dung" required>
                            </div>
                        </div>
                    </div>
                    <button style="width: 100%;" onclick="edit_tt_post()" id="edit_tt" class="btn btn-primary">Thêm Yêu Cầu</button>
                </div>
            </div>
        </div>
    </div>
</div>


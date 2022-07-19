{{-- <div class="container-xl m-t-50" style="align-content: center">--}}
    <div id="form_add_nhom" class="row"
         style="display: none;background-color: rgba(46,52,57,0.33); position: absolute;z-index: 10000;top:50px">
        <div class="col-sm-12 m-b--12 m-t-12" style="text-align: center">
            <label style="font-size: 20px;color: #007bff">
                Thêm Chức Vụ
            </label>
        </div>
        <div class="col-md-12">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="menu">Chức Vụ</label><font color="red"> (*)</font>
                                <input type="text" name="name" class="form-control" id="ten_chucvu"
                                       placeholder="Nhập tên đơn vị" required>
                                <br>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kích hoạt</label> <br>
                                    <div style="display: flex; margin-top: 10px">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" value="1" type="radio"
                                                   checked id="active_cv">
                                            <label for="active_cv" class="custom-control-label">Có</label>
                                        </div>
                                        <div class="custom-control custom-radio m-l-10">
                                            <input class="custom-control-input" value="0" type="radio"
                                                   id="no_active_cv">
                                            <label for="no_active_cv" class="custom-control-label">Không</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button style="width: 100%;" onclick="add_cv()" id="add-cvnv" class="btn btn-primary">Thêm Chức vụ
                            </button>
                        </div>
                        @csrf
                    </div>
                </div>
{{--            </form>--}}
        </div>
    </div>
<script>
    $('#ten_chucvu').keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            $('#active_cv').focus();
            event.preventDefault(); //preventDefault() Không load lại form
        }
    });
    $('#active_cv').keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            $('#no_active_cv').focus();
            event.preventDefault(); //preventDefault() Không load lại form
        }
    });

    $('#no_active_cv').keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            $('#add-cvnv').focus();
            event.preventDefault(); //preventDefault() Không load lại form
        }
    });


    function add_cv(){
        console.log(document.getElementById('ten_nv').value)
        let tencv =document.getElementById('ten_chucvu').value;
        if (document.getElementById('active_cv').checked===true)
            add_cv_post(tencv,1);
        else
            add_cv_post(tencv,0);
    }

    function add_cv_post( ten_cv = '',hoat_dong = '') {
        url = '{{route('store_cv')}}'
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: {ten_cv, hoat_dong},
            url: url,
            success:function (result){
                if(result.error === false){
                    location.reload();
                }else {
                    alert('Tên đơn vị đã tồn tại hoặc không phù hợp')
                }
            }
        })
    }


</script>

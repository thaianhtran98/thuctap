{{--@include('alert')--}}
<div id="form-add-dv" class="row"
     style="display: none;background-color: rgba(46,52,57,0.33);left: 25%; position: absolute;z-index: 10000">
    <div class="col-sm-12 m-b--12 m-t-12" style="text-align: center">
        <label style="font-size: 20px;color: #007bff">
            Thêm Đơn Vị
        </label>
    </div>
    <div class="col-md-12">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="menu">Tên Đơn Vị</label><font color="red"> (*)</font>
                            <input type="text" name="name" class="form-control" id="ten_dv"
                                   placeholder="Nhập tên đơn vị" required>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="menu">Lũy Kế Đầu Kỳ</label>
                            <input type="text" name="luyke" class="form-control" id="luyke_dv"
                                   placeholder="Nhập lũy kế đầu kỳ">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ưu tiên</label><font color="red"> (*)</font>
                                <input type="text" class="form-control" name="uutien" id="uutien_dv"
                                       placeholder="Nhập độ ưu tiên">
                            </div>
                        </div>
                        <button style="width: 100%;" onclick="" id="add_dv" class="btn btn-primary">Thêm Đơn Vị</button>

                    </div>
                </div>
                @csrf
            </div>
    </div>
</div>
<script>
    function show_add_dv() {
        document.getElementById('form-add-dv').style.display = 'block';
        document.getElementById('form-add-dv').style.background = 'white';
        document.getElementById('body').style.display = 'block';
    }

    function page_normal() {
        document.getElementById('body').style.display = 'none';
        document.getElementById('form-add-dv').style.display = 'none';
        document.getElementById('form-add').style.display = 'none';

    }
</script>

<script>
    $('#ten_dv').keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            $('#luyke_dv').focus();
            event.preventDefault(); //preventDefault() Không load lại form
        }
    });
    $('#luyke_dv').keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            $('#uutien_dv').focus();
            event.preventDefault(); //preventDefault() Không load lại form
        }
    });
    $('#uutien_dv').keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            $('#add_dv').focus();
            event.preventDefault(); //preventDefault() Không load lại form
        }
    });

    function add_ct(){
        console.log(document.getElementById('ten_ct').value)
        add(document.getElementById('ten_ct').value);
    }

    function add( ten = '') {
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: {ten},
            url: '/themdv_ajax',
            success:function (result){
                if(result.error === false){
                    $('#id_don_vi').append($('<option>', {
                        value: result.lct.id,
                        text: result.lct.ten_chuong_trinh,
                    }));
                    document.getElementById('body').style.display = 'none';
                    document.getElementById('form-add-dv').style.display = 'none';
                }else {
                    console.log('lỗi')
                }
            }
        })
    }
</script>

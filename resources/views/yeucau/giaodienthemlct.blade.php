{{--@include('alert')--}}
<div id="form-add" class="row"
     style="display: none;background-color: rgba(46,52,57,0.33); position: absolute;z-index: 10000;top: 50px">
    <div class="col-md-12 m-b--12 m-t-12" style="text-align: center">
        <label style="font-size: 20px;color: #007bff">
            Thêm Chương Trình
        </label>
    </div>
    <div class="col-md-12">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="menu">Tên Chương Trình</label><font color="red"> (*)</font>
                        <input type="text" name="name" class="form-control" id="ten_ct"
                               placeholder="Nhập tên chương trình" required>
                        <br>
                    </div>
                    <button style="width: 100%;" id="btn_add_ct" type="submit" onclick="add_ct()" class="btn btn-primary">Thêm Chương Trình
                    </button>
                </div>
                @csrf
            </div>
        </div>
    </div>
</div>

<script>
    function show_add_lct() {
        document.getElementById('form-add').style.display = 'block';
        document.getElementById('form-add').style.background = 'white';
        document.getElementById('body').style.display = 'block';
        document.getElementById('header').style.position = '';

    }

    $('#ten_ct').keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            $('#btn_add_ct').focus();
            event.preventDefault(); //preventDefault() Không load lại form
        }
    });
    //

    function add_ct(){
        console.log(document.getElementById('ten_ct').value)
        add(document.getElementById('ten_ct').value);
    }

    function add( ten = '') {
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: {ten},
            url: '/themloaichuongtrinh_ajax',
            success:function (result){
                if(result.error === false){
                    $('#id_loai_chuong_trinh').append($('<option>', {
                        value: result.lct.id,
                        text: result.lct.ten_chuong_trinh,
                        selected: true
                    }));
                    document.getElementById('body').style.display = 'none';
                    document.getElementById('form-add').style.display = 'none';
                    document.getElementById('thanhcong').innerText = 'Thêm thành công chương trình'+ result.lct.ten_chuong_trinh ;
                    document.getElementById('thanhcong').style.display = 'block';
                    setTimeout(function(){
                        document.getElementById('thanhcong').style.display = 'none';
                    }, 1500);
                }else {
                    document.getElementById('thatbai').innerText = 'Tên chương trình đã tồn tại hoặc không phù hợp';
                    document.getElementById('thatbai').style.display = 'block';
                    setTimeout(function(){
                        document.getElementById('thatbai').style.display = 'none';
                    }, 1500);
                }
            }
        })
    }
</script>

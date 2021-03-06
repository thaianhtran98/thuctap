
<div class="row">
    <div class="col-md-12">
        <label style="font-size: 20px;color: #007bff;margin-top: 50px">
            Thêm Chương Trình
        </label>
        <form action="" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="menu">Tên Chương Trình</label><font color="red"> (*)</font>
                            <input type="text" name="name" class="form-control" id="ten_ct"
                                   placeholder="Nhập tên chương trình" required>
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
                        <button style="width: 100%;" type="submit" class="btn btn-primary">Thêm Chương Trình
                        </button>
                    </div>
                    @csrf
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function show_add_dv() {
        document.getElementById('form-add').style.display = 'block';
        document.getElementById('form-add').style.background = 'white';
        document.getElementById('body').style.display = 'block';
        document.getElementById('header').style.position = '';
    }

    function page_normal() {
        document.getElementById('body').style.display = 'none';
        document.getElementById('form-add').style.display = 'none';
        document.getElementById('header').style.position = 'fixed';
    }

    $('#ten_ct').keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
        $('#active').focus();
        event.preventDefault(); //preventDefault() Không load lại form
        }
    });
    $('#active').keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
        $('#no_active').focus();
        event.preventDefault(); //preventDefault() Không load lại form
        }
    });
</script>

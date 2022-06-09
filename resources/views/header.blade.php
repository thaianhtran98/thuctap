<style>

    /*.main-menu li {*/
    /*    font-weight: bold;*/
    /*}*/

    /*---------------------------------------------*/
    .my-sub-menu {
        list-style-type: none;
        position: absolute;
        top: 0;
        left: 100%;
        min-width: 100%;
        max-width: 500px;
        background-color: rgba(12, 99, 228, 0.91);
        transition: all 0.4s;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        padding: 5px 0;
        box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
        -o-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
        -ms-box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
        visibility: hidden;
        opacity: 0;
    }

    .my-sub-menu li {
        position: relative;
        background-color: transparent;
        transition: all 0.4s;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
    }

    .main-menu > li > .my-sub-menu {
        top: 100%;
        left: 0;
    }

    .my-sub-menu a {
        font-family: Arial, sans-serif, Roboto;
        font-weight: normal;
        text-align: center;
        font-size: 20px;
        line-height: 1.5;
        color: white;
        display: block;
        padding: 8px 20px;
        width: 100%;
        transition: all 0.4s;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
    }

    /*---------------------------------------------*/
    .main-menu > li:hover > a {
        text-decoration: none;
        color: #ff7400;
    }

    .main-menu > li:hover > .my-sub-menu {
        visibility: visible;
        opacity: 1;
    }

    /*.my-sub-menu li:hover > .sub-menu {*/
    /*    visibility: visible;*/
    /*    opacity: 1;*/
    /*}*/

    .my-sub-menu li:hover {
        background-color: transparent;
    }

    .my-sub-menu > li:hover > a {
        /*color: #ff7400;*/
        text-decoration: underline;
    }


    @media (max-width: 1300px) {
        .main-menu > .respon-sub-menu .my-sub-menu {
            right: 100%;
            left: auto;
        }

        .main-menu > .respon-sub-menu > .my-sub-menu {
            right: 0px;
            left: auto;
        }
    }

    .main-menu > li:hover {
        text-decoration: none;
        background: rgba(34, 34, 34, 0.91);
    }
    .main-menu > li {
        text-decoration: none;
        /*background: rgba(34, 34, 34, 0.91);*/
        margin:0px 0px 0px 0px;
    }

</style>
<div class="wrap-menu-desktop"
     style="width: 100% ;background: rgba(2,82,192,0.96);margin-top: -1px;position: relative; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif">
    <nav class="limiter-menu-desktop">
        <!-- Logo desktop -->
        <a href="/" class="logo" style="margin-right: 0px">
            <img style="" src="https://st.quantrimang.com/photos/image/2019/09/19/nha-mang-so-1-viet-nam-640.jpg" alt="IMG-LOGO">
        </a>

        <!-- menu desktop -->
        <div style="width: 100%;font-weight: bold;padding: 0px">
            <ul class="main-menu" style="width: 100%">
                <li class="active-menu" style="display: inline;width: 25%;text-align: center">
                    <a href="/">
                        <button
                            style="width: 100%;height: 100%;size: auto; color: #f8f8f8;font-family: Arial,sans-serif,Roboto; font-size: 20px;">
                            Trang Chủ
                        </button>
                    </a>
                </li>

                <li id="donvi" style="display: inline;width: 25%;text-align: center">
                    <a href="/themdonvi">
                        <button
                            style="width: 100%;height: 100%; color: #f8f8f8;size: auto; font-family: Arial,sans-serif,Roboto; font-size: 20px">
                            Đơn Vị
                        </button>
                    </a>
                </li>


                <li style="display: inline;width: 25%;text-align: center">
                    <a href="/themnhanvien">
                        <button
                            style="width: 100%;height: 100%; color: #f8f8f8;size: auto; font-family: Arial,sans-serif,Roboto; font-size: 20px">
                            Nhân Viên
                        </button>
                    </a>
                </li>

                <li style="display: inline;width: 25%;text-align: center">
                    <a href="/themloaichuongtrinh">
                        <button
                            style="width: 100%;height: 100%; color: #f8f8f8;size: auto; font-family: Arial,sans-serif,Roboto; font-size: 20px">
                            Loại Chương Trình
                        </button>
                    </a>
                </li>


                <li style="display: inline;width: 25%;text-align: center">
                    <button
                        style="width: 100%;height: 100%; color: #f8f8f8;size: auto; font-family: Arial,sans-serif,Roboto; font-size: 20px">
                        Yêu Cầu
                    </button>
                    <ul class="my-sub-menu" id="menu_yeucau">
                        <li>
                            <a href="/themyeucau">
                                Thêm Yêu Cầu
                            </a>
                        </li>
                        <li>
                            <a href="/danhsachyeucau">
                                Danh Sách Yêu Cầu
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</div>




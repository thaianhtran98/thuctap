<style>
    .my-sub-menu {
        list-style-type: none;
        position: absolute;
        top: 0;
        left: 100%;
        min-width: 100%;
        max-width: 500px;
        background: #0266c7;
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
        text-align: left;
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
        /*text-decoration: none;*/
        background:#004f9d;
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
        background: #004f9d;
    }

    .main-menu > li {
        text-decoration: none;
        /*background: rgba(34, 34, 34, 0.91);*/
        margin:0px 0px 0px 0px;
    }
    .limiter-menu-desktop {
        height: 100%;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        align-items: center;
        background-color: transparent;
    }

    .wrap-menu-desktop {
        position: fixed;
        z-index: 1100;
        background-color: transparent;
        width: 100%;
        height: auto;
        top: 0px;
        left: 0px;
        -webkit-transition: height 0.3s, background-color 0.3s;
        -o-transition: height 0.3s, background-color 0.3s;
        -moz-transition: height 0.3s, background-color 0.3s;
        transition: height 0.3s, background-color 0.3s;
    }

    .button_header{
        border: none;
        color: white;
        /*text-align: center;*/
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        position: relative;
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        margin-top: -20px;
        margin-bottom: -20px;
        width: 100%;
        height: 60px;
    }

</style>
<div class="container">
    <div class="wrap-menu-desktop"
         style="width: 100% ;background: #0266c7;margin-top: -1px;position: relative; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;top:0;">
        <nav class="limiter-menu-desktop">
            <div style="width: 100%;font-weight: bold;padding: 0px;">
                <ul class="main-menu" style="width: 100%">
                    <li id="header_danhmuc" style="display: inline;width: 33%;text-align: center">
                        <button class="button_header">
                            Danh M???c Qu???n L??
                        </button>
                        <ul class="my-sub-menu" id="menu_yeucau" style="text-align: left">
                            <li id="donvi" style="display: inline;width: 25%;text-align: left">
                                <a href="{{route('themdonvi')}}">
                                    <button class="button_header">
                                        ????n V???
                                    </button>
                                </a>
                            </li>

                            <li style="display: inline;width: 25%;text-align: left">
                                <a href="{{route('themnhanvien')}}">
                                    <button class="button_header">
                                        Nh??n Vi??n & Ch???c V???
                                    </button>
                                </a>
                            </li>

                            <li style="display: inline;width: 25%;text-align: left">
                                <a href="{{route('themloaichuongtrinh')}}">
                                    <button class="button_header">
                                        Lo???i Ch????ng Tr??nh
                                    </button>
                                </a>
                            </li>

                            <li style="display: inline;width: 25%;text-align: left">
{{--                                <a href="/lich_su_thao_tac">--}}
                                <a href="{{route('lich_su_thao_tac')}}">
                                    <button class="button_header">
                                        L???ch S??? Thao T??c
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li id="header_baocao" style="display: inline-block;width: 33%;text-align: center">
                        <button class="button_header">
                            B??o C??o
                        </button>
                        <ul class="my-sub-menu" id="menu_yeucau">
                            <li id="donvi" style="display: inline;width: 25%;text-align: left">
                                <a href="{{route('baocao')}}">
                                    <button class="button_header">
                                        B??o c??o
                                    </button>
                                </a>
                            </li>
                            <li id="donvi" style="display: inline;width: 25%;text-align: left">
                                <a href="{{route('kybaocao')}}">
                                    <button class="button_header">
                                        K??? B??o C??o
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li id="header_yeucau" style="display: inline;width: 33%;text-align: center">
                        <a href="{{route('danhsachyeucau')}}">
                            <button class="button_header">
                                Y??u C???u
                            </button>
                        </a>
                    </li>
                </ul>

            </div>
            <button class="btn btn-primary" style="float: left; margin-left: 300px;margin-right: auto;" onclick="reload()" >
                    <span>
                        <i class="fas fa-redo-alt"></i>
                    </span>
            </button>

        </nav>
    </div>
</div>
<script>
    function reload(){
        location.reload();
    }
</script>

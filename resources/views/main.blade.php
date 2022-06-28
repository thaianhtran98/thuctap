<!doctype html>
<html >
@include('head')
<body>
<div onclick="page_normal()" id="body"
     style="width: 100%;height: 1000%;position:absolute; background-color: rgba(10,14,20,0.89);z-index: 1101;display: none;">
</div>
<header id="header" style="width: 100%;
  background-color: #0266c7;
  /*display: block;*/
  /*box-shadow: 0px 2px 2px rgba(0,0,0,0.5); !*Đổ bóng cho menu*!*/
  position: fixed; /*Cho menu cố định 1 vị trí với top và left*/
  top: 0; /*Nằm trên cùng*/
  left: 0; /*Nằm sát bên trái*/
  z-index: 100000;
  /*Hiển thị lớp trên cùng*/">
    @include('header')
</header>

<div id="content" style="display: block;margin-top: 120px">
    @yield('content')
</div>

@include('footer')
</body>
</html>

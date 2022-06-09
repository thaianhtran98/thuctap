<!doctype html>
<html >
@include('head')
<body>
<div onclick="page_normal()" id="body"
     style="width: 100%;height: 100%;position:absolute; background-color: rgba(10,14,20,0.89);z-index: 1101;display: none">
</div>
<header id="header" style="display: block;position: relative">
    @include('header')
</header>

<div id="content" style="display: block">
    @yield('content')
</div>

@include('footer')

</body>
</html>

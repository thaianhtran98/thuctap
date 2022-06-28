<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/icon type">
    <title>{{$title}}</title>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/template/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/template/fonts/linearicons-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="/template/css/util.css">
    <link rel="stylesheet" type="text/css" href="/template/css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <script src="/template/owlcarousel/owl.carousel.min.js"></script>--}}
    <link rel="stylesheet" href="/template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">


    <!-- Theme style -->
    <link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/template/css/bootstrap.css">
    <link rel="stylesheet" href="/template/css/boostrap4.datatable.css">
    <link rel="stylesheet" href="/template/css/searchPanes.dataTables.css">
    <link rel="stylesheet" href="/template/css/select.dataTables.min.css">



    <script src="/template/js/jquery-3.5.1.js" ></script>

    <script src="/template/js/bootstrap.min.js"></script>
    <script src="/template/js/popper.min.js"></script>
    <script src="/template/js/jquery.dataTables.min.js"></script>
    <script src="/template/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/template/js/dataTables.searchPanes.min.js"></script>
    <script type="text/javascript" src="/template/js/searchPanes.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/template/js/dataTables.select.min.js"></script>
    <!--===============================================================================================-->
</head>

<style>
    /*table{*/
    /*    border:1px solid #767677;*/
    /*}*/
    /*th{*/
    /*    border:1px solid #767677;*/
    /*}*/
    /*!*td{*!*/
    /*    border:0.5px solid #767677;*/
    /*}*/
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #767677;
        border-top: 1px solid #767677;
    }
</style>
@yield('head')

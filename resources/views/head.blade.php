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
    <link rel="stylesheet" href="/template/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/template/owlcarousel/assets/owl.theme.default.min.css">
    <script src="/template/vendor/jquery/jquery-3.2.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/template/owlcarousel/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.2/basic/ckeditor.js"></script>

    <script src="/template/js/popper.min.js"></script>
    <script src="/template/js/bootstrap.min.js"></script>

    <script src="/template/js/jquery.dataTables.min.js"></script>
    <script src="/template/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="/template/css/boostrap4.datatable.css">

    <!--===============================================================================================-->
</head>

<style>
    table{
        border:1px solid #767677;
    }
    th{
        border:1px solid #767677;
    }
    td{
        border:1px solid #767677;
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #767677;
        border-top: 1px solid #767677;
    }
</style>
@yield('head')

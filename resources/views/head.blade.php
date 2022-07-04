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
    <link rel="stylesheet" href="/template/css/boostrap4.datatable.css">
    <link rel="stylesheet" href="/template/css/searchPanes.dataTables.css">
    <link rel="stylesheet" href="/template/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/template/css/bootstrap.css">



    <script src="/template/js/jquery-3.5.1.js" ></script>

    <script src="/template/js/bootstrap.min.js"></script>

    <script src="/template/js/jquery.dataTables.min.js"></script>
    <script src="/template/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/template/js/dataTables.searchPanes.min.js"></script>
    <script type="text/javascript" src="/template/js/searchPanes.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/template/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

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

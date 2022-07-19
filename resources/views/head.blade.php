<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="https://vnpt.com.vn/design/images/icon.png"/>
    <title id = 'title_head'>{{$title}}</title>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/thuctap1/public/template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/thuctap1/public/template/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/thuctap1/public/template/fonts/linearicons-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="/thuctap1/public/template/css/util.css">
    <link rel="stylesheet" type="text/css" href="/thuctap1/public/template/css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <script src="/template/owlcarousel/owl.carousel.min.js"></script>--}}
    <link rel="stylesheet" href="/thuctap1/public/template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/thuctap1/public/template/admin/plugins/fontawesome-free/css/all.min.css">


    <!-- Theme style -->
    <link rel="stylesheet" href="/thuctap1/public/template/admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/thuctap1/public/template/css/boostrap4.datatable.css">
    <link rel="stylesheet" href="/thuctap1/public/template/css/searchPanes.dataTables.css">
    <link rel="stylesheet" href="/thuctap1/public/template/css/select.dataTables.min.css">
    <link rel="stylesheet" href="/thuctap1/public/template/css/bootstrap.css">



    <script src="/thuctap1/public/template/js/jquery-3.5.1.js" ></script>

    <script src="/thuctap1/public/template/js/bootstrap.min.js"></script>

    <script src="/thuctap1/public/template/js/jquery.dataTables.min.js"></script>
    <script src="/thuctap1/public/template/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/thuctap1/public/template/js/dataTables.searchPanes.min.js"></script>
    <script type="text/javascript" src="/thuctap1/public/template/js/searchPanes.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/thuctap1/public/template/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>


    <script type="text/javascript" src="/thuctap1/public/template/admin/Inputmask/dist/jquery.inputmask.js"></script>
    <script type="text/javascript" src="/thuctap1/public/template/admin/jquery-ui-1.13.1.custom/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="/thuctap1/public/template/admin/ui/jquery-ui.css"/>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script src="https://rawgit.com/RobinHerbots/Inputmask/5.x/dist/inputmask.js"></script>


{{--    <style>--}}
{{--        div.dataTables_wrapper div.dataTables_filter{--}}
{{--            margin-top: 0px;--}}
{{--        }--}}
{{--    </style>--}}
    <!--===============================================================================================-->
</head>

<style>
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #767677;
        border-top: 1px solid #767677;
    }
</style>
@yield('head')

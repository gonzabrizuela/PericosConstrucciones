<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ Session::token() }}">
        <title>DIAGEO</title>
        <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
        <!-- Bootstrap core CSS-->


        <link rel="stylesheet" href="/vendor/bootstrap.min.css" crossorigin="anonymous">
        <!-- Custom fonts for this template-->
        <link href="/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">   
        <!-- Custom styles for this template-->
        <link href="/css/sb-admin.css" rel="stylesheet">
        <link href="/css/custom.css" rel="stylesheet">
        <script src="/vendor/jquery-3.3.1.min.js" crossorigin="anonymous"></script>


        
    </head>
   
    @isset($bodyclass)
    <body class="{{$bodyclass}}" id="page-top">
        @endisset
        @empty($bodyclass)
    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        @endempty


        @yield('content')

        @empty($hidenav)
        @include('layouts.nav')
        @endempty

        <!-- Bootstrap core JavaScript-->

        <script src="/vendor/popper.min.js" crossorigin="anonymous"></script>
        <script src="/vendor/bootstrap.min.js" crossorigin="anonymous"></script>

        <!-- Core plugin JavaScript-->
        <script src="/vendor/jquery.easing.compatibility.js" crossorigin="anonymous"></script>

        <!-- Page level plugin JavaScript-->
        <!--<script src="/vendor/Chart.bundle.js" crossorigin="anonymous"></script>-->

        <!-- DATA-TABLES-->
        <script src="/assets/js/lib/data-table/jquery.dataTables.min.js"></script>
        <script src="/assets/js/lib/data-table/dataTables.bootstrap4.js"></script>
        <script src="/assets/js/lib/data-table/dataTables.rowReorder.min.js"></script>
        <link href="/assets/css/lib/datatable/rowReorder.dataTables.min.css" rel="stylesheet" type="text/css">
        <link href="/assets/css/lib/datatable/buttons.dataTables.min.css" rel="stylesheet">
        <script src="/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
        <script src="/assets/js/lib/data-table/buttons.flash.min.js"></script>
        <script src="/assets/js/lib/data-table/jszip.min.js"></script>
        <script src="/assets/js/lib/data-table/pdfmake.min.js"></script>
        <script src="/assets/js/lib/data-table/vfs_fonts.js"></script>
        <script src="/assets/js/lib/data-table/buttons.html5.min.js"></script>
        <script src="/assets/js/lib/data-table/buttons.print.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="/js/sb-admin.js"></script>

        <!-- Custom scripts for this page-->
        <script src="/js/sb-admin-datatables.js"></script>
        <!-- <script src="/js/sb-admin-charts.js"></script>-->
        
        <script>
$('#toggleNavPosition').click(function () {
    $('body').toggleClass('fixed-nav');
    $('nav').toggleClass('fixed-top static-top');
});

$('#toggleNavColor').click(function () {
    $('nav').toggleClass('navbar-dark navbar-light');
    $('nav').toggleClass('bg-dark bg-light');
    $('body').toggleClass('bg-dark bg-light');
});
        </script>

    </body>
    
</html>
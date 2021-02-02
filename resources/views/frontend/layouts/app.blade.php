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
        <link rel="stylesheet" href="/css/frontend/nav.css">
        <link rel="stylesheet" href="/vendor/bootstrap.min.css" crossorigin="anonymous">
        <!-- Custom fonts for this template-->
        <link href="/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">   
        <link rel="stylesheet" href="/css/frontend/footer.css">
        <!-- Custom styles for this template-->
        <link href="/css/sb-admin.css" rel="stylesheet">
        <link href="/css/custom.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/frontend/general.css">
        <script src="/vendor/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
        {{-- <link rel="stylesheet" href="/vendor/bootvar/css/bootnavbar.css">
        <link rel="stylesheet" href="/vendor/bootvar/css/animate.min.css"> --}}
        {{-- <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> --}}

    </head>
   @include('frontend/layouts.modals')
    @isset($bodyclass)
    <body class="{{$bodyclass}}" id="page-top">
        
        @endisset
        @empty($bodyclass)
        
    <body class="bg-white" id="page-top"> 
        @endempty
        <style>
            @media (orientation:landscape)
            {
                .nav-margin{
                margin-left: 250px
            }
            }
            
        </style>
        <div class="nav-margin">
            <div class="container" id="main-container" style="padding-top:55px !important">
            @yield('content')
            </div>
        </div>
        @include('frontend/layouts.nav')
        <!-- Bootstrap core JavaScript-->
        @include('frontend/layouts.footer')
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
        
        {{-- Bootvar --}}
        {{-- <script src="/vendor/bootvar/js/bootnavbar.js" ></script> --}}
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
<script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar, #content').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
</script>
    </body>
    
</html>
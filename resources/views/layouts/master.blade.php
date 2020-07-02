<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>@yield('title')</title>
    @include('layouts.style')
    <style>
        .page-wrapper .page-body-wrapper .page-body {
            background-color: #fff;
        }
        .breadcrumb-item.active {
            color: #F9F9F9;
        }
        .page-wrapper .page-body-wrapper .page-header .row h3 {
            color: black;
        }

        body.dark-header-sidebar-mix .page-wrapper .page-main-header .main-header-right {
            background-color: white;
        }

        /*SIDEBAR*/

        .page-wrapper .page-body-wrapper .page-sidebar {
            background: #f9f9f9;
        }



        .page-wrapper .page-body-wrapper .page-sidebar .sidebar-menu .sidebar-header {
            color: #808080;
        }

        /* links color active */
        .page-wrapper .page-body-wrapper .page-sidebar .sidebar-menu>li>a.active {
            color: #383737;
        }

        /*Esto nombre abajo del logo */
        .page-wrapper .page-body-wrapper .page-sidebar .sidebar-user h6 {
            color: #808080;
        }

        /*Esto es del logo */
        .page-wrapper .page-body-wrapper .page-sidebar .sidebar-user {
            padding: 5px 0px;
            position: relative;
        }

        li.active a.sidebar-header{
            color: black !important;
        }

        li:hover a.sidebar-header{
            color: black !important;
        }


        li > a > span {
            font-size: 1.2em;
        }

        .img-logo{
            max-height: 40px;
            margin-right: 5px;
        }


        body > div.page-wrapper > div.page-main-header.open > div > div.nav-right.col.p-0 > ul > li.onhover-dropdown > div > div{
            font-size: 1.2em;
            margin-left: 5px;
        }

        .card {
            -webkit-box-shadow: 1px 5px 24px 0 rgba(34,34,34,0.1) !important;
            box-shadow: 1px 5px 24px 0 rgba(34,34,34, 0.1) !important;
        }

        #hDate{
            color: #5F4DFC !important;
        }

        #hTime{
            color: #5F4DFC !important;
        }
    </style>
</head>
<body class="dark-header-sidebar-mix">
<!-- Loader starts-->
<!-- <div class="loader-wrapper">
  <div class="loader bg-white">
    <div class="whirly-loader"> </div>
  </div>
</div> -->
<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper">
@include('layouts.header')
    @include('sweetalert::alert')
<!-- Page Body Start-->
    <div class="page-body-wrapper">
        @include('layouts.sidebar')
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <div class="page-header-left">
                                <h3>@yield('breadcrumb-title')</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                                    @yield('breadcrumb-item')
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('body')

        </div>
        @include('layouts.footer')

    </div>
</div>
@include('layouts.script')
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>@yield('title')</title>
    @include('layouts.style')
    <style>
        .page-wrapper .page-body-wrapper .page-body {
            background-color: #FC5759;
        }
        .breadcrumb-item.active {
            color: #F9F9F9;
        }
        .page-wrapper .page-body-wrapper .page-header .row h3 {
            color: #F9F9F9;
        }

        body.dark-header-sidebar-mix .page-wrapper .page-main-header .main-header-right {
            background-color: #FC5759;
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

        /*Esto es icono numero 3 */
        .page-wrapper .page-body-wrapper .page-sidebar[sidebar-layout="iconcolor-sidebar"] .sidebar-menu li:nth-child(7n+3) svg {
            color: #4466F2;
        }

        /*Esto es del logo */
        .page-wrapper .page-body-wrapper .page-sidebar .sidebar-user {
            padding: 5px 0px;
            position: relative;
        }

        /* */

        .page-wrapper .page-body-wrapper .page-sidebar[sidebar-layout="iconcolor-sidebar"] .sidebar-menu li:nth-child(7n+9) svg {
            color: #F09FAF;
        }
        .page-wrapper .page-body-wrapper .page-sidebar[sidebar-layout="iconcolor-sidebar"] .sidebar-menu li:nth-child(7n+7) svg {
            color:  #F7C48C;
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

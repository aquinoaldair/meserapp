<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>@yield('title')</title>
    @include('layouts.style')
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

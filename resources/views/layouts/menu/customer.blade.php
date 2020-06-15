<div class="page-sidebar" sidebar-layout="iconcolor-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper"><a href=" "><img src="{{asset('assets/images/meserapp_logo.png')}}" alt=""></a></div>
    </div>
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center">
            <div>
                <img class="img-60 rounded-circle" src="{{asset('assets/images/user/profile.png')}}" alt="#">
            </div>
            <h6 class="mt-3 f-14">{{ auth()->user()->commerce->name }}</h6>
        </div>
        <ul class="sidebar-menu">
            <li><a class="sidebar-header" href="{{ route('dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a></li>
            <li><a class="sidebar-header" href="{{ route('room.index') }}"><i data-feather="grid"></i><span>{{ __(\App\Models\Room::NAME) }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('product.index') }}"><i data-feather="shopping-cart"></i><span>{{ \App\Models\Product::NAME }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('category.index') }}"><i data-feather="bookmark"></i><span>{{ \App\Models\Category::NAME }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('supplier.index') }}"><i data-feather="users"></i><span>{{ \App\Models\Supplier::NAME }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('cost.index') }}"><i data-feather="dollar-sign"></i><span>{{ \App\Models\Cost::NAME }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('printer.index') }}"><i data-feather="printer"></i><span>{{ \App\Models\Printer::NAME }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('station.index') }}"><i data-feather="monitor"></i><span>{{ \App\Models\Station::NAME }}</span></a></li>
            <li><a class="sidebar-header" href="#"><i data-feather="shopping-cart"></i><span>Ventas</span></a></li>
            {{--<li><a class="sidebar-header" href="#"><i data-feather="lock"></i><span>Usuarios y Roles</span></a></li>--}}
            <li><a class="sidebar-header" href="{{ route('schedule.index') }}"><i data-feather="clock"></i><span>{{ \App\Models\Schedule::NAME }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('reservation.index') }}"><i data-feather="calendar"></i><span>{{ \App\Models\Reservation::NAME }}</span></a></li>
            {{--<li><a class="sidebar-header" href="{{ route('room.index') }}"><i data-feather="dollar-sign"></i><span>Ventas</span></a></li>
            <li><a class="sidebar-header" href="{{ route('room.index') }}"><i data-feather="clipboard"></i><span>Compras y Gastos</span></a></li>
            <li><a class="sidebar-header" href="{{ route('room.index') }}"><i data-feather="settings"></i><span>Configuración</span></a></li>--}}
            {{--<li class="active">
                <a class="sidebar-header" href="#" data-original-title="" title="">
                    <i data-feather="layout"></i>
                    <span>{{ __(\App\Models\Table::NAME) }}</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="sidebar-submenu menu-open" style="display: block;">
                    <li><a href="general-widget.html" data-original-title="" title=""><i class="fa fa-circle"></i>{{ __(\App\Models\Room::NAME) }}</a></li>
                    <li><a href="chart-widget.html" data-original-title="" title=""><i class="fa fa-circle"></i>{{ __(\App\Models\Table::NAME) }}</a></li>
                </ul>
            </li>--}}
            {{--<li><a class="sidebar-header" href="{{ route('room.index') }}"><i data-feather="layout"></i><span>{{ __(\App\Models\Room::NAME) }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('product.index') }}"><i data-feather="shopping-cart"></i><span>{{ __(\App\Models\Product::NAME) }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('category.index') }}"><i data-feather="grid"></i><span>{{ __(\App\Models\Category::NAME) }}</span></a></li>--}}
        </ul>
    </div>
</div>

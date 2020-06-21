<div class="page-sidebar" sidebar-layout="border-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper"><a href=" "><img src="{{asset('assets/images/meserapp_logo.png')}}" alt=""></a></div>
    </div>
    <div class="sidebar custom-scrollbar">
        <ul class="sidebar-menu">
            <li class="active">
                <a class="sidebar-header" href="{{ route('dashboard') }}">
                    <img class="img-logo" src="{{ asset('icons/icono_inicio_admin.png') }}" alt="">
                    <span>Inicio</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header" href="{{ route('room.index') }}">
                    <img class="img-logo" src="{{ asset('icons/icono_mesas_admin.png') }}" alt="">
                    <span>{{ __(\App\Models\Room::NAME) }}</span>
                </a>
            </li>
            <li class="">
                <a class="sidebar-header" href="#" data-original-title="" title="">
                    <img class="img-logo" src="{{ asset('icons/icono_gastos_admin.png') }}" alt="">
                    <span>Gastos</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a class="sidebar-header" href="{{ route('supplier.index') }}"><i data-feather="users"></i><span>{{ \App\Models\Supplier::NAME }}</span></a></li>
                    <li><a class="sidebar-header" href="{{ route('cost.index') }}"><i data-feather="dollar-sign"></i><span>{{ \App\Models\Cost::NAME }}</span></a></li>
                </ul>
            </li>
            <li>
                <a class="sidebar-header" href="#">
                    <img class="img-logo" src="{{ asset('icons/icono_ventas_admin.png') }}" alt="">
                    <span>Ventas</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header" href="{{ route('reservation.index') }}">
                    <img class="img-logo" src="{{ asset('icons/icono_reservaciones_admin.png') }}" alt="">
                    <span>{{ \App\Models\Reservation::NAME }}</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header" href="{{ route('product.index') }}">
                    <img class="img-logo" src="{{ asset('icons/icono_productos_admin.png') }}" alt="">
                    <span>{{ \App\Models\Product::NAME }}</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header" href="#">
                    <img class="img-logo" src="{{ asset('icons/icono_clientes_admin.png') }}" alt="">
                    <span>Clientes</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header" href="#">
                    <img class="img-logo" src="{{ asset('icons/icono_estadisticas_admin.png') }}" alt="">
                    <span>Estadisticas</span>
                </a>
            </li>
            {{--<li><a class="sidebar-header" href="{{ route('category.index') }}"><i data-feather="bookmark"></i><span>{{ \App\Models\Category::NAME }}</span></a></li>--}}
            {{--<li><a class="sidebar-header" href="#"><i data-feather="lock"></i><span>Usuarios y Roles</span></a></li>--}}
            <li class="">
                <a class="sidebar-header" href="#" data-original-title="" title="">
                    <img class="img-logo" src="{{ asset('icons/icono_preferencias_admin.png') }}" alt="">
                    <span>Preferencias</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a class="sidebar-header" href="{{ route('printer.index') }}"><i data-feather="printer"></i><span>{{ \App\Models\Printer::NAME }}</span></a></li>
                    <li><a class="sidebar-header" href="{{ route('station.index') }}"><i data-feather="monitor"></i><span>{{ \App\Models\Station::NAME }}</span></a></li>
                    <li><a class="sidebar-header" href="{{ route('schedule.index') }}"><i data-feather="clock"></i><span>{{ \App\Models\Schedule::NAME }}</span></a></li>
                </ul>
            </li>
            {{--<li><a class="sidebar-header" href="{{ route('room.index') }}"><i data-feather="layout"></i><span>{{ __(\App\Models\Room::NAME) }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('product.index') }}"><i data-feather="shopping-cart"></i><span>{{ __(\App\Models\Product::NAME) }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('category.index') }}"><i data-feather="grid"></i><span>{{ __(\App\Models\Category::NAME) }}</span></a></li>--}}
        </ul>
    </div>
</div>

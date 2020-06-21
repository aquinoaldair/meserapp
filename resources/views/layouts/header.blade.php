<!-- Page Header Start-->
<div class="page-main-header">
    <div class="main-header-right row">
        <div class="main-header-left d-lg-none">
            <div class="logo-wrapper"><a href=""><img src="{{asset('assets/images/endless-logo.png')}}" alt=""></a></div>
        </div>
        <div class="mobile-sidebar">
            <div class="media-body text-right switch-sm">
                <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
            </div>
        </div>
        <div class="nav-right col p-0">
            <ul class="nav-menus">
                <li>
                    <div class="form-inline search-form" >
                       <h4 id="hDate"></h4>
                        <img style="margin-left: 10px; max-height: 50px" src="{{ asset('icons/icono_reloj_admin_blanco.png') }}" alt="">
                        <h1 class="ml-4" id="hTime"></h1>
                    </div>
                </li>
                <li class="onhover-dropdown">
                    <i style="color:white;" data-feather="mail"></i>
                    <span style="color:white" class="dot"></span>
                    <ul class="notification-dropdown onhover-show-div">
                        <li>Mensajes <span class="badge badge-pill badge-primary pull-right">1</span></li>
                        <li>
                            <div class="media">
                                <div class="media-body">
                                    <h6 class="mt-0"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag shopping-color"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg></span>Your order ready for Ship..!<small class="pull-right">9:00 AM</small></h6>
                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="onhover-dropdown">
                    <i style="color:white;" data-feather="bell"></i>
                    <span style="color:white" class="dot"></span>
                    <ul class="notification-dropdown onhover-show-div">
                        <li>Notificaciones <span class="badge badge-pill badge-primary pull-right">1</span></li>
                        <li>
                            <div class="media">
                                <div class="media-body">
                                    <h6 class="mt-0"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag shopping-color"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg></span>Your order ready for Ship..!<small class="pull-right">9:00 AM</small></h6>
                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="onhover-dropdown">
                    <div class="media align-items-center">
                        <img class="align-self-center pull-right img-50 rounded-circle" src="{{asset('icons/usuario.png')}}" alt="header-user">
                        <div style="margin-left: 10px">
                            Hola, {{ auth()->user()->name }}
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div p-20">
                        <li>
                            <a href="{{ route('profile') }}"><i data-feather="user"></i>{{ __("Editar Perfil") }}</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-feather="log-out"></i>{{ __("Salir") }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
        </div>
    </div>
</div>


<script>

    function getTime(){
        var today = new Date();
        var time = today.toString().split(' ')[4];

        var day_name = today.toString().split(' ')[0];
        var month_name = today.toString().split(' ')[1];
        var day_number = today.toString().split(' ')[2];

        document.getElementById("hTime").textContent = time;
        document.getElementById("hDate").textContent = getNameDay(day_name)+" "+day_number+" "+getNameMonth(month_name);

        setTimeout("getTime()",1000)
    }


    function getNameDay(day) {
        var dict = {
            "Sun" : "Domingo",
            "Mon" : "Lunes",
            "Tue" : "Martes",
            "Wed" : "Miercoles",
            "Thu" : "Jueves",
            "Fri" : "Viernes",
            "Sat" : "Sabado"
        };
        return dict[day];
    }

    function getNameMonth(name) {
        var dict = {
            "Jan" : "Ene.",
            "Feb" : "Feb.",
            "Mar" : "Mar.",
            "Apr" : "Abr.",
            "May" : "May.",
            "Jun" : "Jun.",
            "Jul" : "Jul.",
            "Aug" : "Ago.",
            "Sep" : "Sep.",
            "Oct" : "Oct.",
            "Nov" : "Nov.",
            "Dic" : "Dic."
        };
        return dict[name];
    }

    getTime();

</script>
<!-- Page Header Ends  -->

<!-- Page Header Start-->
<div class="page-main-header" id="header">
    <div class="main-header-right row">
        <div class="main-header-left d-lg-none" style="background-color: white">
            <div class="logo-wrapper"><a href=""><img src="{{asset('icons/icono_app_con_texto.png')}}" alt=""></a></div>
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
                        <img style="margin-left: 10px; max-height: 50px" src="{{ asset('icons/hora.png') }}" alt="">
                        <h1 class="ml-4" id="hTime"></h1>
                    </div>
                </li>

                <alert-table admin="{{ auth()->user()->isAdmin() ? 1 : 0 }}"></alert-table>

                <li class="onhover-dropdown">
                    <div class="media align-items-center">
                        <img class="align-self-center pull-right img-50 rounded-circle" src="{{asset('icons/mi_cuenta.png')}}" alt="header-user">
                        <div style="margin-left: 10px; color: #5F4DFC">
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

<script src="{{ mix('js/header.js') }}"></script>
<!-- Page Header Ends  -->

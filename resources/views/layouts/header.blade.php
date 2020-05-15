<!-- Page Header Start-->
<div class="page-main-header open">
  <div class="main-header-right row">
    <div class="main-header-left d-lg-none">
      <div class="logo-wrapper"><a href="#"><img src="{{asset('assets/images/meserapp_logo.png')}}" alt=""></a></div>
    </div>
    <div class="mobile-sidebar">
      <div class="media-body text-right switch-sm">
        <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
      </div>
    </div>
    <div class="nav-right col p-0">
      <ul class="nav-menus">
        <li>

        </li>
        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        <li class="onhover-dropdown">
          <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle" src="{{asset('assets/images/user/profile.png')}}" alt="header-user">
            <div class="dotted-animation"><span class="animate-circle"></span><span class="main-circle"></span></div>
          </div>
          <ul class="profile-dropdown onhover-show-div p-20">
            <li><a href="#"><i data-feather="user"></i>{{ __("Editar Perfil") }}</a></li>
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
<!-- Page Header Ends -->

<div class="page-sidebar sidebar-img2" sidebar-layout="iconcolor-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper"><a href=" "><img src="{{asset('assets/images/meserapp_logo.png')}}" alt=""></a></div>
    </div>
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center">
            <div>
                <img class="img-60 rounded-circle" src="{{asset('assets/images/user/profile.png')}}" alt="#">
            </div>
            <h6 class="mt-3 f-14">{{ auth()->user()->name }}</h6>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a class="sidebar-header {{ request()->routeIs('dashboard') ? 'active' : ''}}" href="{{ route('dashboard') }}">
                    <i data-feather="home"></i><span>Dashboard</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header {{ request()->routeIs('commerce.*') ? 'active' : ''}}" href="{{ route('commerce.index') }}" >
                    <i data-feather="shopping-cart"></i><span>{{ __(\App\Models\Commerce::NAME) }}</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header" href="{{ route('category.index') }}">
                    <i data-feather="grid"></i><span>{{ __(\App\Models\Category::NAME) }}</span>
                </a>
            </li>

            <li>
                <a class="sidebar-header" href="{{ route('image.index') }}">
                    <i data-feather="image"></i><span>{{ __(\App\Models\Image::NAME) }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>

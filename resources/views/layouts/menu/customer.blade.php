<div class="page-sidebar sidebar-img2" sidebar-layout="iconcolor-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper"><a href=" "><img src="{{asset('assets/images/endless-logo.png')}}" alt=""></a></div>
    </div>
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center">
            <div><img class="img-60 rounded-circle" src="{{asset('assets/images/user/1.jpg')}}" alt="#">
                <div class="profile-edit"><a href="#" target="_blank"><i data-feather="edit"></i></a></div>
            </div>
            <h6 class="mt-3 f-14">{{ auth()->user()->name }}</h6>
            <p>{{ auth()->user()->commerce->name }}</p>
        </div>
        <ul class="sidebar-menu">
            <li><a class="sidebar-header" href="{{ route('dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a></li>
            <li><a class="sidebar-header" href="{{ route('room.index') }}"><i data-feather="layout"></i><span>{{ __(\App\Models\Room::NAME) }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('product.index') }}"><i data-feather="shopping-cart"></i><span>{{ __(\App\Models\Product::NAME) }}</span></a></li>
            <li><a class="sidebar-header" href="{{ route('category.index') }}"><i data-feather="grid"></i><span>{{ __(\App\Models\Category::NAME) }}</span></a></li>
        </ul>
    </div>
</div>

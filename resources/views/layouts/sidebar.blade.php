<!-- Page Sidebar Start-->
@hasrole(\App\User::CUSTOMER_ROLE)
    @include('layouts.menu.customer')
@endhasrole

@hasrole(\App\User::ADMIN_ROLE)
    @include('layouts.menu.admin')
@endhasrole


@hasrole(\App\User::WAITER_ROLE)
@include('layouts.menu.waiter')
@endhasrole
<!-- Page Sidebar Ends-->

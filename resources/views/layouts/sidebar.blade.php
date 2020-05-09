<!-- Page Sidebar Start-->
@hasrole(\App\User::CUSTOMER_ROLE)
    @include('layouts.menu.customer')
@endhasrole

@hasrole(\App\User::ADMIN_ROLE)
    @include('layouts.menu.admin')
@endhasrole

<!-- Page Sidebar Ends-->

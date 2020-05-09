
@if ($message = session()->get('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <p>{{ $message ?? "" }}</p>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title="" title=""><span aria-hidden="true">×</span></button>
    </div>
@endif


@if ($message = session()->get('danger'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
        <p>{{ $message ?? "" }}</p>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title="" title=""><span aria-hidden="true">×</span></button>
    </div>
@endif


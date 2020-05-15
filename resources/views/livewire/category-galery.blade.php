<div class="card">
    <h4 class="text-center p-2">{{ __("Categorias Precargadas") }}</h4>
    <div class="my-gallery card-body row gallery-with-description">
        <div class="row p-2" style="width: 100% !important;">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title="" title=""><span aria-hidden="true">×</span></button>
                </div>
            @endif
                @if (session()->has('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('danger') }}</strong>
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close" data-original-title="" title=""><span aria-hidden="true">×</span></button>
                    </div>
                @endif
        </div>
        <div class="row">
            @foreach($categories as $item)
                <figure class="col-6 col-xl-3">
                    <a itemprop="contentUrl" data-original-title="" title="">
                        <img src="{{ asset('storage/'.$item->image) }}" itemprop="thumbnail" alt="Image description" data-original-title="">
                        <div class="caption">
                            <h4 class="text-center">{{ $item->name }}</h4>
                            <p class="text-center">
                                <button class="btn btn-success btn-sm" type="button" wire:click="$emit('addCategory', {{ $item->id }})"> {{ __("Agregar") }}</button>
                            </p>
                        </div>
                    </a>
                </figure>
            @endforeach
        </div>

    </div>

    <div class="card-footer">
        {{ $categories->links() }}
    </div>
</div>

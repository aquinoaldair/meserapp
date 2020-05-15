
<div class="row" x-data="galery()">
    <input type="text" wire:model="searchTerm"  class="form-control" placeholder="{{ __("Escribe algo") }}"/>

    <div class="row p-3">
        @foreach($galery as $image)
            <img v-on:click="setImage('{{ $image->image }}')" class="image-galery" v-bind:class="{ 'figure-selected' : (image == '{{ $image->image }}')  }" src="{{ asset('storage/'.$image->image) }}">
        @endforeach
    </div>

    {{ $galery->links() }}

</div>

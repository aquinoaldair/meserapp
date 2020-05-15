<?php

namespace App\Http\Livewire;

use App\Models\Image;
use Livewire\Component;
use Livewire\WithPagination;

class SearchGalery extends Component
{
    use WithPagination;

    public $searchTerm;

    public function render()
    {
        $searchTerm = "%{$this->searchTerm}%";

        return view('livewire.search-galery', [
            "galery" => Image::where('keywords', 'like', $searchTerm)->paginate(12)
        ]);
    }
}

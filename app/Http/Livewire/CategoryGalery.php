<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryGalery extends Component
{
    use WithPagination;

    protected $listeners = ['addCategory'];

    public function addCategory($id)
    {
        try {
            $instance = app(CategoryRepositoryInterface::class);
            $category = $instance->find($id);
            $data = [
                'name' => $category->name,
                'image' => $category->image,
                'commerce_id' => auth()->user()->commerce->id
            ];
            $category->create($data);
            session()->flash('success', __("Se ha agregado correctamente"));
        }
        catch (\Exception $e){
            session()->flash('danger', __("No se pudo agregar la categoria"));
        }




    }

    public function render()
    {
        $category = app(CategoryRepositoryInterface::class);

        return view('livewire.category-galery', [
            "categories" =>  $category->getByAdminPaginate(4)
        ]);
    }
}

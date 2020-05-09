<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;
    private $user;
    private $message_403 = "No tienes los permisos para acceder a esta página";

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;

        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    public function index()
    {
        $data = $this->category->getByCommerceId($this->user->commerce->id);
        return view('category.index', compact('data'));
    }


    public function create()
    {
        return view('category.create');
    }


    public function store(CategoryRequest $request)
    {
        $this->category->create([
            'name' => $request->name,
            'commerce_id' => $this->user->commerce->id ,
            'image' => ($request->image) ? FileHelper::storage('categories', $request->image) : null
        ]);

        return redirect()->route('category.index')->with('success', __('El registro se ha guardado correctamente'));
    }

    public function edit($id)
    {
        $category = $this->category->find($id);

        abort_if($this->user->cannot('view', $category), 403, __($this->message_403));

        return view('category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $category = $this->category->find($id);

        abort_if($this->user->cannot('update', $category), 403, __($this->message_403));

        $this->category->update([
            'name' => $request->name,
            'image' => ($request->image) ? FileHelper::storage('categories', $request->image) : $category->image
        ], $category->id);

        return redirect()->route('category.index')->with('success', __('El registro se ha guardado correctamente'));
    }


    public function destroy($id)
    {
        $category = $this->category->find($id);

        abort_if($this->user->cannot('delete', $category), 403, __($this->message_403));

        $this->category->delete($category->id);

        return response()->json(__('Se eliminó correctamente'), 202);
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;
    private $category;
    private $user;
    private $message_403 = "No tienes los permisos para acceder a esta página";

    public function __construct(ProductRepositoryInterface $product, CategoryRepositoryInterface $category)
    {
        $this->product = $product;
        $this->category = $category;

        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    public function index()
    {
        $data = $this->product->getByCommerceId($this->user->commerce->id);
        $data->load('category');
        return view('product.index', compact('data'));
    }


    public function create()
    {
        $categories = $this->category->getByCommerceId($this->user->commerce->id);
        return view('product.create', compact('categories'));
    }


    public function store(ProductRequest $request)
    {
        $category = $this->category->find($request->category_id);

        abort_if($this->user->cannot('view', $category), '403', 'La categoria que ingresaste no es valida');

        $this->product->create([
            'name' => $request->name,
            'commerce_id' => $this->user->commerce->id,
            'image' => ($request->image) ? FileHelper::storage('products', $request->image) : null,
            'category_id' => $category->id
        ]);

        return redirect()->route('product.index')->with('success', __('El registro se ha guardado correctamente'));

    }


    public function edit($id)
    {
        $product = $this->product->find($id);

        abort_if($this->user->cannot('view', $product), 403, __($this->message_403));

        $categories = $this->category->getByCommerceId($this->user->commerce->id);

        return view('product.edit', compact('product', 'categories'));
    }


    public function update(ProductRequest $request, $id)
    {
        $product = $this->product->find($id);

        abort_if($this->user->cannot('update', $product), 403, __($this->message_403));

        $category = $this->category->find($request->category_id);

        abort_if($this->user->cannot('view', $category), '403', 'La categoria que ingresaste no es valida');

        $this->product->update([
            'name' => $request->name,
            'category_id' => $category->id,
            'image' => ($request->image) ? FileHelper::storage('categories', $request->image) : $product->image
        ], $product->id);

        return redirect()->route('product.index')->with('success', __('El registro se ha actualizado correctamente'));
    }


    public function destroy($id)
    {
        $product = $this->product->find($id);

        abort_if($this->user->cannot('delete', $product), 403, __($this->message_403));

        $this->product->delete($product->id);

        return response()->json(__('Se eliminó correctamente'), 202);
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Station\StationRepositoryInterface;

class ProductController extends BaseController
{
    private $product;
    private $category;
    private $gallery;
    private $station;

    public function __construct(ProductRepositoryInterface $product, CategoryRepositoryInterface $category, ImageRepositoryInterface $image, StationRepositoryInterface $station)
    {
        parent::__construct();

        $this->product = $product;
        $this->category = $category;
        $this->gallery = $image;
        $this->station = $station;
    }

    public function index()
    {
        $data = $this->product->getByCommerceId($this->user->commerce->id);
        return view('product.index', compact('data'));
    }


    public function create()
    {
        $categories = $this->getCategories();
        $stations = $this->getStations();
        return view('product.create', compact('categories', 'stations'));
    }


    public function store(ProductRequest $request)
    {

        $category = $this->category->find($request->category_id);

        $this->authorize('view', $category);

        $station = $this->station->find($request->station_id);

        $this->authorize('view', $station);

        $this->product->create([
            'name' => $request->name,
            'use_stock' => $request->use_stock ?? 0,
            'stock' => $request->stock,
            'margin' => $request->margin ?? "",
            'price' => $request->price,
            'category_id' => $category->id,
            'station_id' => $station->id,
            'commerce_id' => $this->user->commerce->id,
            'description' => $request->description ?? "",
            'image' => $this->getImage($request)
        ]);

        return redirect()->route('product.index')->with('success', __('El registro se ha guardado correctamente'));

    }


    public function edit($id)
    {
        $product = $this->product->find($id);

        $this->authorize('view', $product);

        $categories = $this->getCategories();

        $stations = $this->getStations();

        return view('product.edit', compact('product', 'categories', 'stations'));
    }


    public function update(ProductUpdateRequest $request, $id)
    {
        $product = $this->product->find($id);

        $this->authorize('update', $product);

        $category = $this->category->find($request->category_id);

        $this->authorize('view', $category);

        $this->product->update([
            'name' => $request->name,
            'use_stock' => $request->use_stock,
            'stock' => $request->stock,
            'margin' => $request->margin,
            'price' => $request->price,
            'category_id' => $category->id,
            'station_id' => $request->station_id,
            'description' => $request->description,
            'image' => $this->getImage($request, $product->image),
        ], $product->id);

        return redirect()->route('product.index')->with('success', __('El registro se ha actualizado correctamente'));
    }


    public function destroy($id)
    {
        $product = $this->product->find($id);

        $this->authorize('delete', $product);

        $this->product->delete($product->id);

        return response()->json(__('Se eliminó correctamente'), 202);
    }

    public function getImage($request, $image = null){

        $image = ($request->file_device) ? FileHelper::storage('products', $request->file_device) : $image;

        $image = ($request->file_gallery) ? $request->file_gallery : $image;

        return $image;
    }


    private function getStations(){
        return $this->station->getByCommerceId($this->user->commerce->id);
    }

    private function getCategories(){
        return  $this->category->getByCommerceId($this->user->commerce->id);
    }
}

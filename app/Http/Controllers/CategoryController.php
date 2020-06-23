<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\CategoryRequest;
use App\Interfaces\PermissionInterface;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Strategy\Image\ImageFromBase64;
use App\Strategy\Image\ImageProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use function GuzzleHttp\Promise\all;

class CategoryController extends BaseController
{
    private $category;

    public function __construct(CategoryRepositoryInterface $category)
    {
        parent::__construct();

        $this->category = $category;
    }


    public function index()
    {

        $data = $this->user->isAdmin()
            ? $this->category->getByAdmin()
            : $this->category->getByCommerceId($this->user->commerce->id);

        return view('category.index', compact('data'));
    }


    public function create()
    {
        return view('category.create');
    }


    public function store(CategoryRequest $request)
    {

        // FileHelper::storage('categories', $request->image)

        $data = [
            'name' => $request->name,
            'image' => ($request->file_device) ? (new ImageProcess(new ImageFromBase64()))->store($request->file_device, 'categories')  : null
        ];

        $this->user->isAdmin()
            ? $data["is_admin"] = true
            : $data["commerce_id"] = $this->user->commerce->id;

        $this->category->create($data);

        return redirect()->route('product.index')->with('success', __('El registro se ha guardado correctamente'));
    }

    public function edit($id)
    {
        $category = $this->category->find($id);

        $this->authorize('edit', $category);

        return view('category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $category = $this->category->find($id);

        $this->authorize('update', $category);

        $this->category->update([
            'name' => $request->name,
            'image' => ($request->file_device)
                ? (new ImageProcess(new ImageFromBase64))->store($request->file_device, 'categories')
                : $category->image
        ], $category->id);

        return redirect()->route('product.index')->with('success', __('El registro se ha guardado correctamente'));
    }


    public function destroy($id)
    {
        $category = $this->category->find($id);

        $this->authorize('delete', $category);

        $this->category->delete($category->id);

        return response()->json(__('Se eliminó correctamente'), 202);
    }

    public function getGeneral(){
        return $this->category->getByAdmin();
    }

    public function createCategoryFromGeneral(Request $request){

        $category = $this->category->find($request->id);

        $this->authorize('view', $category);

        try {
            $this->category->create([
                'name' => $category->name,
                'image' => $category->image,
                'commerce_id' => $this->user->commerce->id,
                'is_admin' => false
            ]);
            return response()->json("success", 200);
        }catch (\Exception $e){
            Log::info("Controller: CategoryController");
            Log::info("Method: createCategoryFromGeneral");
            Log::error($e->getMessage());
        }

    }


}

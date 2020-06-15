<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\ImageStoreRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Models\Image;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Strategy\Image\ImageFromBase64;
use App\Strategy\Image\ImageProcess;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    private $image;

    public function __construct(ImageRepositoryInterface $image)
    {
        $this->image  = $image;
    }

    public function index()
    {
        $data =  $this->image->all();
        return view('image.index', compact('data'));
    }


    public function create()
    {
        return view('image.create');
    }


    public function store(ImageStoreRequest $request)
    {
        $this->image->create([
            "image" => (new ImageProcess(new ImageFromBase64))->store($request->image, 'products') ,
            'keywords' => $request->keywords
        ]);

        return redirect()->route('image.index');
    }

    public function edit($id)
    {
        $image = $this->image->find($id);

        return view('image.edit', compact('image'));
    }

    public function update(ImageUpdateRequest $request, $id)
    {
        $image = $this->image->find($id);

        $this->image->update([
            "image" => ($request->image)
                ? (new ImageProcess(new ImageFromBase64))->store($request->image, 'products')
                : $image->image,
            'keywords' => $request->keywords
        ], $image->id);

        return redirect()->route('image.index');
    }

    public function destroy($id)
    {
        $category = $this->image->find($id);
        $this->image->delete($category->id);
        return response()->json(__('Se eliminó correctamente'), 202);
    }

    public function search($term){
        return $this->image->search($term);
    }
}

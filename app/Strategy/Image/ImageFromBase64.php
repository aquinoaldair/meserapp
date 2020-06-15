<?php


namespace App\Strategy\Image;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageFromBase64 implements StoreImage
{

    public function store($file, $folder = null)
    {
        $name = "";
        try {
            $image = Image::make(base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$file)))->stream();
            $name = $folder."/".Str::random('40').".png";
            Storage::disk('public')->put($name, $image);
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }
        return $name;
    }
}

<?php


namespace App\Strategy\Image;


use App\Helpers\FileHelper;

class ImageFromFormData implements StoreImage
{

    public function store($file, $folder = null)
    {
        return FileHelper::storage($folder, $file);
    }
}

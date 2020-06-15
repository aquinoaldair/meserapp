<?php

namespace App\Strategy\Image;

class ImageFromUrl implements StoreImage
{

    public function store($file, $folder = null)
    {
        return $file;
    }
}

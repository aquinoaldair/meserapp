<?php


namespace App\Strategy\Image;


use Illuminate\Support\Facades\Storage;

class ImageProcess implements StoreImage
{

    private $image;

    public function __construct(StoreImage $image)
    {
        $this->image = $image;
    }

    public function store($file, $folder = null)
    {
        return $this->image->store($file, $folder);
    }
}

<?php


namespace App\Strategy\Image;


interface StoreImage
{
    public function store($file, $folder = null);
}

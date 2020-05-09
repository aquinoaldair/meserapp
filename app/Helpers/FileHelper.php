<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Storage;

class FileHelper
{

    public static function storage($folder, $file){
        return Storage::disk('public')->put($folder, $file);
    }
}

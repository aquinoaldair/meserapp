<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Image extends Model
{
    use SoftDeletes;

    const NAME = "Galería";

    protected $fillable = [
        'image', 'keywords'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];


    public function setKeywordsAttribute($value)
    {
        $this->attributes['keywords'] = Str::lower($value);
    }

}

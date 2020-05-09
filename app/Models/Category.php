<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    const NAME = "Categorias";

    protected $fillable = [
        'name', 'image', 'commerce_id'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    const NAME = "Categorias";

    const DEFAULT_ROW = "Ninguno";

    protected $fillable = [
        'name', 'image', 'commerce_id', 'is_admin'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];


    public function createdByAdmin(){
        return $this->is_admin;
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}

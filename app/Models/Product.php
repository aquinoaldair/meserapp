<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    const NAME = 'Productos';

    protected $fillable = [
        'name', 'image', 'category_id', 'commerce_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}

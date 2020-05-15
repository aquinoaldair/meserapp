<?php

namespace App\Models;

use Appstract\Stock\StockMutation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    const NAME = 'Productos';

    protected $fillable = [
        'name', 'image', 'category_id', 'station_id' ,'commerce_id', 'status', 'stock', 'use_stock', 'description', 'margin', 'price'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function station(){
        return $this->belongsTo(Product::class);
    }

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function suppliers(){
        return $this->belongsToMany(Supplier::class);
    }


}

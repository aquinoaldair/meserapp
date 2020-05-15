<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    const NAME = "Proveedores";

    protected $fillable = [
        'name', 'commerce_id', 'prefix_number', 'phone_number', 'address', 'active'
    ];


    public function products(){
        return $this->belongsToMany(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    CONST NAME = "Salones";

    protected $fillable = [ 'commerce_id', 'name', 'image', 'key'];

    protected  $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'commerce_id'
    ];

    public function getRouteKeyName()
    {
        return 'key';
    }


    public function commerce(){
        return $this->belongsTo(Commerce::class);
    }

    public function tables(){
        return $this->hasMany(Table::class);
    }

}

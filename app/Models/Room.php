<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    CONST NAME = "Salones";

    protected $fillable = [ 'commerce_id', 'name', 'image', 'key'];

    public function getRouteKeyName()
    {
        return 'key';
    }


    public function commerce(){
        return $this->belongsTo(Commerce::class);
    }

}

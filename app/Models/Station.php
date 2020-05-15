<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Station extends Model
{
    use SoftDeletes;

    const NAME = "Estaciones";

    const DEFAULT_ROW = "Barras";

    protected $fillable = ['commerce_id', 'name'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function commerce(){
        return $this->belongsTo(Commerce::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    const NAME = "Reservaciones";

    use SoftDeletes;

    protected $fillable = [
        'commerce_id', 'name', 'phone', 'date', 'time', 'people'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'commerce_id'
    ];

    public function commerce(){
        return $this->belongsTo(Commerce::class);
    }
}

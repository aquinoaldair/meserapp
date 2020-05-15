<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commerce extends Model
{
    use SoftDeletes;

    const NAME = "Comercios";

    protected $fillable = [
        'user_id', 'name', 'date', 'logo', 'address', 'latitude', 'longitude'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function printer(){
        return $this->hasOne(Printer::class)->withDefault();
    }
}

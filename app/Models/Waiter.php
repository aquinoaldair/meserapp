<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Waiter extends Model
{
    use SoftDeletes;

    const NAME = "Meseros";

    protected $fillable = [
        'commerce_id', 'address',  'phone', 'user_id'
    ];

    public function commerce(){
        return $this->belongsTo(Commerce::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

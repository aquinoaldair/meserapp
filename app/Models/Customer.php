<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'phone_number', 'prefix_phone'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

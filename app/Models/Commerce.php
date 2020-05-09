<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commerce extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'name', 'date', 'logo'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    CONST NAME = "Ratings";

    protected $fillable = [ 'commerce_id', 'user_id', 'value', 'comment'];


    protected  $hidden = [
        'created_at', 'updated_at', 'commerce_id', 'user_id'
    ];


}

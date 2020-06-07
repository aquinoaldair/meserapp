<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    const NAME = "Horarios";

    protected $fillable = [
        'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'commerce_id', 'is_starting'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'commerce_id', 'id'
    ];
}

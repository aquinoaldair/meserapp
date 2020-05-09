<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{

    use SoftDeletes;

    const NAME = "Mesas";

    protected $fillable = [
        'name', 'key', 'url', 'room_id'
    ];

    public function getRouteKeyName()
    {
        return 'key';
    }
}

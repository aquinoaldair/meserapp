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

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'url', 'room_id'
    ];

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function getRouteKeyName()
    {
        return 'key';
    }
}

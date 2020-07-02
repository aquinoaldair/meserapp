<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{

    use SoftDeletes;

    const NAME = "Mesas";


    protected $fillable = [
        'name', 'key', 'url', 'room_id', 'status'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'url', 'room_id'
    ];

    protected $appends = [
        'status_trans'
    ];

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function getRouteKeyName()
    {
        return 'key';
    }

    public function lastService(){
        return $this->hasOne(Service::class);
    }

    public function scopeWithLastService($query)
    {
        $query->addSelect(['last_service_id' => Service::select('id')
            ->whereColumn('table_id', 'tables.id')
            ->latest()
            ->take(1)
        ])->with('lastService.orders.details.product')->with('lastService.payment');
    }

    public function getStatusTransAttribute(){
        return StatusTable::getTranslation($this->status);
    }
}

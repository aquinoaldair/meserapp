<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    const NAME = "Servicios";
    const STATUS_ACTIVE = 'active';
    const STATUS_FINISHED = 'finished';

    protected $fillable = [
        'table_id', 'status', 'commerce_id'
    ];

    protected $appends = [
        'date', 'total'
    ];

    protected $hidden = [
        'updated_at', 'deleted_at', 'created_at'
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function getDateAttribute(){
        return $this->created_at->toTimeString();
    }

    public function getTotalAttribute()
    {
        return $this->orders->sum('total');
    }

    public function table(){
        return $this->belongsTo(Table::class);
    }


    public function payment(){
        return $this->hasOne(Payment::class);
    }

}

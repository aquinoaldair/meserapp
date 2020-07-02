<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'service_id'
    ];

    protected $appends = [
        'date', 'total'
    ];

    protected $hidden = [
        'updated_at', 'deleted_at', 'created_at'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function details(){
        return $this->hasMany(Details::class);
    }

    public function getDateAttribute(){
        return $this->created_at->toTimeString();
    }

    public function getTotalAttribute()
    {
        return $this->details->sum('total');
    }


}

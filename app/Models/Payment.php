<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $appends = [
        'date'
    ];

    protected $fillable = [
        'service_id', 'type', 'tip_detail', 'total', 'tip', 'amount'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function getDateAttribute(){
        return $this->created_at->toDateTimeString();
    }
}

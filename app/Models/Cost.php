<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cost extends Model
{
    use SoftDeletes;

    const NAME = "Gastos";
    
    protected $fillable = [
        'name', 'cost', 'commerce_id',  'supplier_id', 'description', 'bill', 'comment'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class)->withDefault();
    }

}

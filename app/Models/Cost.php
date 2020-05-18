<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cost extends Pivot
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

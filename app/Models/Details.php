<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id', 'order_id', 'quantity', 'price', 'comment'
    ];


    protected $appends = [
        'total'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}

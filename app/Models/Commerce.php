<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commerce extends Model
{
    use SoftDeletes;

    const NAME = "Comercios";

    protected $fillable = [
        'user_id', 'name', 'date', 'logo', 'address', 'latitude',
        'longitude', 'first_image', 'second_image', 'type', 'description',
        'phone_number', 'prefix_phone'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'user_id'
    ];


    protected $appends = [
        'rating'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function printer()
    {
        return $this->hasOne(Printer::class)->withDefault();
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


    public function getRatingAttribute()
    {
        return $this->ratings()->avg('value') ?: 0;
    }


    public function scopeWithHighestPrice($query)
    {
        $query->addSelect(['highest_price' => Product::select('price')
            ->whereColumn('commerce_id', 'commerces.id')
            ->orderBy('price', 'desc')
            ->take(1)
        ]);
    }

    public function scopeWithLowestPrice($query)
    {
        $query->addSelect(['lowest_price' => Product::select('price')
            ->whereColumn('commerce_id', 'commerces.id')
            ->orderBy('price', 'asc')
            ->take(1)
        ]);
    }


}

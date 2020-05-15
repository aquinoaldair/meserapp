<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Printer extends Model
{
    const NAME = "Impresora";

    use SoftDeletes;

    protected $fillable = [
        'commerce_id','top_text', 'bottom_text', 'middle_text', 'title', 'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function commerce(){
        return $this->belongsTo(Commerce::class);
    }
}

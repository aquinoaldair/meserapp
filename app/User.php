<?php

namespace App;

use App\Models\Commerce;
use App\Models\Customer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    CONST ADMIN_ROLE = 'admin';
    CONST CUSTOMER_ROLE = 'customer';
    CONST WAITER_ROLE = 'waiter';
    CONST CLIENT_ROLE = 'client';

    use Notifiable, HasRoles, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token','created_at', 'deleted_at', 'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function customer(){
        return $this->hasOne(Customer::class)->withDefault();
    }

    public function commerce(){
        return $this->hasOne(Commerce::class)->withDefault();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function isAdmin(){
        return $this->hasRole(self::ADMIN_ROLE);
    }

    public function isCustomer(){
        return $this->hasRole(self::CUSTOMER_ROLE);
    }
}

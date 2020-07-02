<?php

namespace App\Rules;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Waiter\WaiterRepositoryInterface;
use Illuminate\Contracts\Validation\Rule;

class WaiterRule implements Rule
{

    private $id;

    public function __construct($id)
    {
        $this->id = $id;

    }

    public function passes($attribute, $value)
    {
        // create instance from repository
        $instance = app(WaiterRepositoryInterface::class);
        // get waiter by id
        $waiter = $instance->find($this->id);
        // check email pass is the same that is registered
        if ($value == $waiter->user->email){
            return true;
        }
        // check if email exist in another user
        $exist = app(UserRepositoryInterface::class)->findByEmail($value);
        // if exist thne no passes
        return ($exist) ? false : true;
    }

    public function message()
    {
        return 'El email ya ha sido registrado';
    }
}

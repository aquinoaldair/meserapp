<?php

namespace App\Rules;

use App\Repositories\Commerce\CommerceRepository;
use App\Repositories\Commerce\CommerceRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Validation\Rule;

class CommerceRule implements Rule
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;

    }

    public function passes($attribute, $value)
    {
        // create instance from repository
        $instance = app(CommerceRepositoryInterface::class);
        // get commerce by id
        $commerce = $instance->find($this->id);
        // check email pass is the same that is registered
        if ($value == $commerce->user->email){
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

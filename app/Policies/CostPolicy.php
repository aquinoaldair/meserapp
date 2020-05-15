<?php

namespace App\Policies;

use App\Models\Cost;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CostPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {

    }


    public function view(User $user, Cost $cost)
    {
        return $user->commerce->id == $cost->commerce_id;
    }


    public function create(User $user)
    {

    }


    public function update(User $user, Cost $cost)
    {
        return $user->commerce->id == $cost->commerce_id;
    }


    public function delete(User $user, Cost $cost)
    {
        return $user->commerce->id == $cost->commerce_id;
    }


    public function restore(User $user, Cost $cost)
    {

    }


    public function forceDelete(User $user, Cost $cost)
    {

    }
}

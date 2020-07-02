<?php

namespace App\Policies;

use App\Models\Waiter;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WaiterPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }


    public function view(User $user, Waiter $waiter)
    {
        return $user->commerce->id === $waiter->commerce_id;
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Waiter $waiter)
    {
        return $user->commerce->id === $waiter->commerce_id;
    }

    public function delete(User $user, Waiter $waiter)
    {
        return $user->commerce->id === $waiter->commerce_id;
    }

    public function restore(User $user, Waiter $waiter)
    {

    }

    public function forceDelete(User $user, Waiter $waiter)
    {

    }
}

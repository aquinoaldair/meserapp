<?php

namespace App\Policies;

use App\Models\Details;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Details  $details)
    {
        //
    }


    public function create(User $user)
    {
        //
    }


    public function update(User $user, Details $details)
    {
        return $user->commerce->id == $details->product->commerce_id;
    }


    public function delete(User $user, Details $details)
    {
       return $user->commerce->id == $details->product->commerce_id;
    }


    public function restore(User $user, Details $details)
    {
        //
    }


    public function forceDelete(User $user, Details $details)
    {
        //
    }
}

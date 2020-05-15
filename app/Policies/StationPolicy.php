<?php

namespace App\Policies;

use App\Models\Station;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StationPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Station $station)
    {
        return $user->commerce->id == $station->commerce_id;
    }

    public function update(User $user, Station $station)
    {
        return $user->commerce->id == $station->commerce_id;
    }

    public function delete(User $user, Station $station)
    {
        return $user->commerce->id == $station->commerce_id;
    }
}

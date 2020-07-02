<?php

namespace App\Policies;

use App\Models\Service;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;


    public function view(User $user, Service $service){
        return $user->commerce->id == $service->commerce_id;
    }

}

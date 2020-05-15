<?php

namespace App\Policies;

use App\User;
use App\Models\Table;
use Illuminate\Auth\Access\HandlesAuthorization;

class TablePolicy
{
    use HandlesAuthorization;



    public function view(User $user,  Table $table)
    {
        return $user->commerce->id == $table->room->commerce_id;
    }


    public function update(User $user,  Table $table)
    {
        return $user->commerce->id == $table->room->commerce_id;
    }


    public function delete(User $user, Table $table)
    {
        return $user->commerce->id == $table->room->commerce_id;
    }



}

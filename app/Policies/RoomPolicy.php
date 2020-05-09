<?php

namespace App\Policies;

use App\Models\Room;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Room $room){
        return $user->id ==$room->commerce->user_id;
    }

    public function update(User $user, Room $room)
    {
        return $user->id ==$room->commerce->user_id;
    }

    public function delete(User $user, Room $room)
    {
        return $user->id == $room->commerce->user_id;
    }

}

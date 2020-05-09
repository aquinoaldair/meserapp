<?php

namespace App\Http\Middleware;

use App\Repositories\Room\RoomRepositoryInterface;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoom
{
    public function handle($request, Closure $next)
    {
        $key = $request->route('room');
        $instance= app(RoomRepositoryInterface::class);
        $room = $instance->findByKey($key);
        $user = Auth::user();
        abort_if($user->cannot('view', $room), 403, 'No tienes los permisos para acceder a esta página');
        $request->attributes->add(['room' => $room]); // add room to use in controller and don't repeat query
        return $next($request);
    }
}

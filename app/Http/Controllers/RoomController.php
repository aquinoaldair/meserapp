<?php

namespace App\Http\Controllers;

use App\Helpers\RoomHelper;
use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Repositories\Room\RoomRepositoryInterface;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    private $room;
    private $user;
    private $message_403 = "No tienes los permisos para acceder a esta página";

    public function __construct(RoomRepositoryInterface $room)
    {
        $this->room = $room;

        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    public function index(){
        $data = $this->room->getByCommerceId($this->user->commerce->id);
        return view('room.index', compact('data'));
    }

    public function create(){
        return view('room.create');
    }

    public function store(RoomRequest $request){
        $this->room->create([
            'name' => $request->name,
            'commerce_id' => $this->user->commerce->id,
            'key' => RoomHelper::getKey()
        ]);
        return redirect()->route('room.index')->with('success', __('El registro se ha guardado correctamente'));
    }


    public function edit($key){
        $room = $this->room->findByKey($key);
        abort_if($this->user->cannot('update', $room), 403, __($this->message_403));
        return view('room.edit', compact('room'));
    }

    public function update(RoomRequest $request, $key){
        $room = $this->room->findByKey($key);
        abort_if($this->user->cannot('update', $room), 403, __($this->message_403));
        $this->room->update(['name' => $request->name], $room->id);
        return redirect()->route('room.index')->with('success', __('El registro se ha actualizado correctamente'));
    }

    public function destroy($key){
        $room = $this->room->findByKey($key);
        abort_if($this->user->cannot('update', $room), 403, __($this->message_403));
        $this->room->delete($room->id);
        return response()->json(__('Se eliminó correctamente'), 202);
    }
}

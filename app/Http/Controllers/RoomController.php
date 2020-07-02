<?php

namespace App\Http\Controllers;

use App\Helpers\RoomHelper;
use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Repositories\Room\RoomRepositoryInterface;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class RoomController extends BaseController
{
    private $room;

    public function __construct(RoomRepositoryInterface $room)
    {
        parent::__construct();
        $this->room = $room;
    }

    public function index(){
        return view('room.index');
    }

    public function getRooms(){
        return $this->room->getByCommerceIdWithTables($this->user->commerce->id);
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

        return $this->getRooms();
    }


    public function edit($key){
        $room = $this->room->findByKey($key);

        $this->authorize('update', $room);

        return view('room.edit', compact('room'));
    }

    public function update(RoomRequest $request, $key){

        $room = $this->room->findByKey($key);

        $this->authorize('update', $room);

        $this->room->update(['name' => $request->name], $room->id);

        return $this->getRooms();
    }

    public function destroy($key){

        $room = $this->room->findByKey($key);

        $this->authorize('delete', $room);

        $this->room->delete($room->id);

        return response()->json(__('Se eliminó correctamente'), 202);
    }


    public function getRoomsWithTables(){
        return $this->room->getByCommerceIdWithTablesAndService($this->user->commerce->id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\RoomHelper;
use App\Http\Requests\TableRequest;
use App\Models\StatusTable;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Table\TableRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class TableController extends Controller
{
    private $table;
    private $room;
    private $service;

    public function __construct(TableRepositoryInterface $table, ServiceRepositoryInterface $service)
    {
        $this->middleware(function ($request, $next) {
          $this->room = $request->get('room'); //this come from CheckRoom Middleware
          return $next($request);
        });
        $this->table = $table;
        $this->service = $service;
    }

    public function index()
    {
        $data =  $this->table->getByRoom($this->room->id);
        return view('table.index', ["data" => $data, "room" => $this->room]);
    }


    public function create()
    {
        return view('table.create', ['room' => $this->room] );
    }


    public function store(TableRequest $request)
    {
        return $this->table->create([
            'name' => $request->name,
            'key' => RoomHelper::getKeyTable(),
            'room_id' => $this->room->id
        ]);
    }


    public function edit(Request $request)
    {
        $key = $request->route('table');

        $table =  $this->table->findOrFailByKey($key);

        $this->authorize('update', $table);

        return view('table.edit', ['table' => $table, 'room' => $this->room]);
    }


    public function update(TableRequest $request)
    {
        $key = $request->route('table');

        $table =  $this->table->findOrFailByKey($key);

        $this->authorize('update', $table);

        $data = [];

        if ($request->name){
            $data["name"] =  $request->name;
        }

        if ($request->room_id){
            $data["room_id"] =  $request->room_id;
        }

        return $this->table->update($data, $table->id);
    }

    public function destroy(Request $request)
    {
        $key = $request->route('table');

        $table =  $this->table->findOrFailByKey($key);

        $this->authorize('delete', $table);

        $this->table->delete($table->id);

        return response()->json(__('Se eliminó correctamente'), 202);
    }

    public function showQr($room, $qr){
        $image = QrCode::format('png')
            ->size(600)
            ->generate(route('table.qr', ['qr' => $qr]));
        return response($image)->header('Content-type','image/png');
    }

    public function setStatusToTable(Request $request){

        $table = $this->table->find($request->id);

        $this->authorize('update', $table);

        return $this->table->updateStatusById($table->id, $request->status);

    }


    public function moveServiceToAnotherTable(Request $request){

        $table_to_move = $this->table->find($request->table_to_move);

        abort_if($table_to_move->status != StatusTable::STATUS_ENABLED, 400);

        $current_table = $this->table->find($request->table_id);

        $service = $this->service->getServiceById($request->service_id);


        DB::transaction(function () use($service, $current_table, $table_to_move) {
            //actualizar servicio en dado caso de que ya exista
            if($service) $this->service->updateTableInService($service->id, $table_to_move->id);
            //actualizar el estado de la mesa nueva con el estado de ocupada
            $this->table->updateStatusById($table_to_move->id, StatusTable::STATUS_OCCUPIED);
            //actualizar el estado de la mesa anterior
            $this->table->updateStatusById($current_table->id, StatusTable::STATUS_ENABLED);
        });

        return response()->json('', 202);
    }

    public function getByStatusOrdered(){

        $user = $this->getUser();

        return $this->table->getByStatusByCommerceId($user->commerce->id, StatusTable::STATUS_ORDERED);
    }

    public function getUser(){
        return auth()->user();
    }

}

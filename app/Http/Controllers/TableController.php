<?php

namespace App\Http\Controllers;

use App\Helpers\RoomHelper;
use App\Http\Requests\TableRequest;
use App\Repositories\Table\TableRepositoryInterface;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class TableController extends Controller
{
    private $table;
    private $room;

    public function __construct(TableRepositoryInterface $table)
    {
        $this->middleware(function ($request, $next) {
          $this->room = $request->get('room'); //this come from CheckRoom Middleware
          return $next($request);
        });
        $this->table = $table;
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
        $this->table->create([
            'name' => $request->name,
            'key' => RoomHelper::getKeyTable(),
            'room_id' => $this->room->id
        ]);
        return redirect()->route('table.index', $this->room)
            ->with('success', __('El registro se ha guardado correctamente'));
    }


    public function edit(Request $request)
    {
        $key = $request->route('table');
        $table =  $this->table->findOrFailByKey($key);
        return view('table.edit', ['table' => $table, 'room' => $this->room]);
    }


    public function update(TableRequest $request)
    {
        $key = $request->route('table');
        $table =  $this->table->findOrFailByKey($key);
        $this->table->update(
            ['name' => $request->name], $table->id
        );
        return redirect()->route('table.index', $this->room)
            ->with('success', __('El registro se ha actualizado correctamente'));
    }

    public function destroy(Request $request)
    {
        $key = $request->route('table');
        $table =  $this->table->findOrFailByKey($key);
        $this->table->delete($table->id);
        return response()->json(__('Se eliminó correctamente'), 202);
    }

    public function showQr($qr){
        $image = QrCode::format('png')
            ->size(600)
            ->generate(route('table.qr', ['qr' => $qr]));
        return response($image)->header('Content-type','image/png');
    }
}

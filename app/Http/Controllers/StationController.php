<?php

namespace App\Http\Controllers;

use App\Http\Requests\StationRequest;
use App\Models\Station;
use App\Repositories\Station\StationRepositoryInterface;
use Illuminate\Http\Request;

class StationController extends BaseController
{

    private $station;

    public function __construct(StationRepositoryInterface $station)
    {
        parent::__construct();

        $this->station = $station;
    }

    public function index()
    {
        $data = $this->station->getByCommerceId($this->user->commerce->id);

        return view('station.index', compact('data'));
    }


    public function create()
    {
        return view('station.create');
    }


    public function store(StationRequest $request)
    {
        $this->station->create([
           'commerce_id' => $this->user->commerce->id,
           'name' => $request->name
        ]);

        return redirect()->route('station.index');
    }

    public function edit($id)
    {
        $station = $this->station->find($id);

        $this->authorize('view', $station);

        return view('station.edit', compact('station'));
    }


    public function update(StationRequest $request, $id)
    {
        $station = $this->station->find($id);

        $this->authorize('update', $station);

        $this->station->update([
            'name' => $request->name
        ], $station->id);

        return redirect()->route('station.index');
    }

    public function destroy($id)
    {
        $station = $this->station->find($id);

        $this->authorize('delete', $station);

        $this->station->delete($id);

        return response()->json('success', 200);
    }
}

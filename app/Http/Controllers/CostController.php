<?php

namespace App\Http\Controllers;

use App\Http\Requests\CostStoreRequest;
use App\Models\Cost;
use App\Repositories\Cost\CostRepositoryInterface;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CostController extends BaseController
{
    private $cost;
    private $supplier;

    public function __construct(CostRepositoryInterface $cost, SupplierRepositoryInterface $supplier)
    {
        parent::__construct();
        $this->cost = $cost;
        $this->supplier = $supplier;
    }

    public function index(Request $request)
    {
        $params = $this->getDate($request);
        $data = $this->cost->getInRangeDateByCommerceIdWithSupplier($this->user->commerce->id, $params["start"], $params["end"], $params["supplier_id"]);
        $suppliers = $this->supplier->getByCommerceId($this->user->commerce->id);
        return view('cost.index', compact('data', 'suppliers'));
    }

    private function getDate(Request $request){

        $date = [ "start" => Carbon::now(), "end" => Carbon::now(), "supplier_id" => null ];

        if ($request->daterange){
            list($date["start"], $date["end"]) =  explode(' - ', $request->daterange);
        }

        if ($request->supplier_id){
             $date["supplier_id"] = $request->supplier_id;
        }

        return $date;
    }


    public function create()
    {
        $suppliers = $this->supplier->getByCommerceId($this->user->commerce->id);
        return view('cost.create', compact('suppliers'));
    }


    public function store(CostStoreRequest $request)
    {
        $this->validateSupplier($request->supplier_id);

        $this->cost->create([
            'commerce_id' => $this->user->commerce->id,
            'supplier_id' => $request->supplier_id,
            'name' => $request->name,
            'cost' => $request->cost,
            'description' => $request->description,
            'bill' => $request->bill,
            'comment' => $request->comment
        ]);

        return redirect()->route('cost.index')->with('success', __('El registro se ha guardado correctamente'));
    }



    public function edit($id)
    {
        $cost = $this->cost->find($id);

        $this->authorize('view', $cost);

        $suppliers = $this->supplier->getByCommerceId($this->user->commerce->id);

        return view('cost.edit', compact('cost', 'suppliers'));

    }


    public function update(CostStoreRequest $request, $id)
    {
        $this->validateSupplier($request->supplier_id);

        $cost = $this->cost->find($id);

        $this->authorize('update', $cost);

        $this->cost->update([
            'supplier_id' => $request->supplier_id,
            'name' => $request->name,
            'cost' => $request->cost,
            'description' => $request->description,
            'bill' => $request->bill,
            'comment' => $request->comment
        ], $cost->id);

        return redirect()->route('cost.index')->with('success', __('El registro se ha guardado correctamente'));
    }

    public function destroy($id)
    {
        $cost = $this->cost->find($id);

        $this->authorize('delete', $cost);

        $this->cost->delete($cost->id);

        return response()->json(__('Se eliminó correctamente'), 202);
    }


    private function validateSupplier($supplier_id){
        if ($supplier_id){
            $supplier = $this->supplier->find($supplier_id);
            $this->authorize('view', $supplier);
        }
    }
}

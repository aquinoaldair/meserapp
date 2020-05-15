<?php

namespace App\Http\Controllers;

use App\Http\Requests\CostStoreRequest;
use App\Models\Cost;
use App\Repositories\Cost\CostRepositoryInterface;
use App\Repositories\Supplier\SupplierRepositoryInterface;
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

    public function index()
    {
        $data = $this->cost->getByCommerceIdWithSupplier($this->user->commerce->id);
        return view('cost.index', compact('data'));
    }


    public function create()
    {
        $suppliers = $this->supplier->getByCommerceId($this->user->commerce->id);
        return view('cost.create', compact('suppliers'));
    }


    public function store(CostStoreRequest $request)
    {
        $supplier = $this->supplier->find($request->supplier_id);

        $this->authorize('view', $supplier);

        $this->cost->create([
            'commerce_id' => $this->user->commerce->id,
            'supplier_id' => $request->supplier_id,
            'name' => $request->name,
            'cost' => $request->cost,
            'description' => $request->description,
            'bill' => $request->bill,
            'comment' => $request->comment
        ]);

        return redirect()->route('cost.index');
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
        $supplier = $this->supplier->find($request->supplier_id);

        $this->authorize('view', $supplier);

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

        return redirect()->route('cost.index');
    }

    public function destroy($id)
    {
        $cost = $this->cost->find($id);

        $this->authorize('delete', $cost);

        $this->cost->delete($cost->id);

        return response()->json(__('Se eliminó correctamente'), 202);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierStoreRequest;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends BaseController
{
    private $supplier;
    private $product;

    public function __construct(SupplierRepositoryInterface $supplier, ProductRepositoryInterface $product)
    {
        parent::__construct();
        $this->supplier = $supplier;
        $this->product = $product;
    }

    public function index(){
        $data = $this->supplier->getByCommerceId($this->user->commerce->id);
        return view('supplier.index', compact('data'));
    }

    public function create(){
        $products = $this->product->getByCommerceId($this->user->commerce->id);
        return view('supplier.create', compact('products'));
    }

    public function store(SupplierStoreRequest $request){

        DB::transaction(function () use ($request) {
            $supplier = $this->supplier->create([
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'commerce_id' => $this->user->commerce->id
            ]);
            $this->supplier->attachProducts($supplier->id, $request->products);
        });

        return redirect()->route('supplier.index');
    }

    public function edit($id){

        $supplier = $this->supplier->findByIdWithProducts($id);

        $this->authorize('view', $supplier);

        $products = $this->product->getByCommerceId($this->user->commerce->id);

        return view('supplier.edit', compact('supplier', 'products'));
    }


    public function update(SupplierStoreRequest $request, $id){

        $supplier = $this->supplier->find($id);

        $this->authorize('update', $supplier);

        DB::transaction(function () use ($request, $supplier)  {
            $this->supplier->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number
            ], $supplier->id);

            $this->supplier->syncProducts($supplier->id, $request->products);
        });


        return redirect()->route('supplier.index');
    }



    public function destroy($id){

        $supplier = $this->supplier->find($id);

        $this->authorize('delete', $supplier);

        $this->supplier->delete($supplier->id);

        return response()->json(__('Se eliminó correctamente'), 202);
    }
}

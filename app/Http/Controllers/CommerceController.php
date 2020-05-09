<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\CommerceStoreRequest;
use App\Http\Requests\CommerceUpdateRequest;
use App\Models\Commerce;
use App\Repositories\Commerce\CommerceRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommerceController extends Controller
{

    private $commerce;
    private $customer;
    private $user;

    public function __construct(CommerceRepositoryInterface $commerce, UserRepositoryInterface $user, CustomerRepositoryInterface $customer)
    {
        $this->commerce = $commerce;
        $this->user = $user;
        $this->customer = $customer;
    }

    public function index()
    {
        $data = $this->commerce->all();
        $data->load('user.customer');
        return view('commerce.index', compact('data'));
    }


    public function create()
    {
        return  view('commerce.create');
    }


    public function store(CommerceStoreRequest $request)
    {
        DB::transaction(function () use ($request){
            $user = $this->storeUser($request);
            $this->storeCustomer($request, $user->id);
            $this->storeCommerce($request, $user->id);
        });

        return redirect()->route('commerce.index')->with('success', __('El registro se ha creado correctamente'));
    }

    public function edit($id)
    {
        $commerce = $this->commerce->find($id);
        return view('commerce.edit', compact('commerce'));
    }


    public function update(CommerceUpdateRequest $request, $id)
    {
        $commerce = $this->commerce->find($id);

        DB::transaction(function () use ($request, $commerce){
            $this->updateUser($request, $commerce->user->id);
            $this->updateCustomer($request, $commerce->user->customer->id);
            $this->updateCommerce($request, $commerce->id);
        });

        return redirect()->route('commerce.index')->with('success', __('El registro se ha actualizado correctamente'));
    }

    public function destroy($id)
    {
        if (request()->ajax()){
            $commerce = $this->commerce->find($id);
            DB::transaction(function () use ($commerce){
                $this->commerce->delete($commerce->id);
                $this->customer->delete($commerce->user->customer->id);
                $this->user->delete($commerce->user->id);

            });
            return response()->json(__('Se eliminó correctamente'), 202);
        }
        return response()->json(__('La solicitud no es válida'), 404);
    }


    private function storeUser($request){
        return $this->user->createUserWithRole([
            'name' => $request->customer,
            'email' => $request->email,
            'password' => $request->password
        ], User::CUSTOMER_ROLE);
    }

    private function updateUser($request, $id){
        $data = [
            'name' => $request->customer,
            'email' => $request->email,
        ];
        if ($request->password) $data["password"] = $request->password;

        $this->user->update($data, $id);
    }


    private function storeCommerce($request, $user_id){
        $this->commerce->create([
            'user_id' => $user_id,
            'name' => $request->name,
            'date' => $request->date,
            'logo' => ($request->logo) ? FileHelper::storage('commerce', $request->logo) : null
        ]);
    }

    private function updateCommerce($request, $id){
        $data = [
            'name' => $request->name,
            'date' => $request->date,
        ];
        if ($request->logo) $data['logo'] = FileHelper::storage('commerce', $request->logo);
        $this->commerce->update($data, $id);
    }

    private function storeCustomer(Request $request, $user_id){
        $this->customer->create([
            'user_id' => $user_id,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);
    }

    private function updateCustomer($request, $id){
        $this->customer->update([
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ], $id);
    }


}

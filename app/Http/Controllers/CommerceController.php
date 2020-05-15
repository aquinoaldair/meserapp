<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\CommerceStoreRequest;
use App\Http\Requests\CommerceUpdateRequest;
use App\Http\Traits\RegisterCommerce;
use App\Models\Commerce;
use App\Repositories\Commerce\CommerceRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommerceController extends Controller
{
    use RegisterCommerce;

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
        $this->storeFullCustomer($this->user, $this->customer, $this->commerce, $request->all());

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

        $data = $request->all();

        DB::transaction(function () use ($data, $commerce){
            $this->updateUser($data, $commerce->user->id);
            $this->updateCustomer($data, $commerce->user->customer->id);
            $this->updateCommerce($data, $commerce->id);
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


    private function updateUser($data, $id){
        $field = [
            'name' => $data["name"],
            'email' => $data["email"],
        ];
        if (isset($data["password"])) $field["password"] = $data["password"];

        $this->user->update($field, $id);
    }



    private function updateCommerce($data, $id){
        $fields = [
            'name' => $data["name"],
        ];
        if (isset($data['logo'])) $fields['logo'] = FileHelper::storage('commerce', $data['logo']);
        if (isset($data['date'])) $fields['date'] = $data['date'];
        if (isset($data['address'])) $fields['address'] = $data['address'];
        if (isset($data['latitude'])) $fields['latitude'] = $data['latitude'];
        if (isset($data['longitude'])) $fields['longitude'] = $data['longitude'];


        $this->commerce->update($fields, $id);
    }


    private function updateCustomer($data, $id){
        $this->customer->update([
            'phone_number' => $data["phone_number"],
            'prefix_phone' => $data["prefix_phone"]
        ], $id);
    }


}

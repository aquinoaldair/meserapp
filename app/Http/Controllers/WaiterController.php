<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaiterStoreRequest;
use App\Http\Requests\WaiterUpdateRequest;
use App\Models\Waiter;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Waiter\WaiterRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\DB;

class WaiterController extends BaseController
{

    private $waiter;

    private $userRepository;

    public function __construct(WaiterRepositoryInterface $waiter, UserRepositoryInterface $userRepository)
    {
        parent::__construct();

        $this->waiter = $waiter;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $data = $this->waiter->getByCommerceIdWithUser($this->user->commerce->id);

        return view('waiter.index', compact('data'));
    }


    public function create()
    {
        return view('waiter.create');
    }


    public function store(WaiterStoreRequest $request)
    {
        $data = $request->all();
        DB::transaction(function () use($data) {
            $user = $this->userRepository->create($data);
            $this->storeWaiter($data, $user->id);
            $user->assignRole(User::WAITER_ROLE);
        });

        return redirect()->route('waiter.index')->with('success', __('El registro se ha guardado correctamente'));
    }

    private function storeWaiter($data, $user_id){
        $data['user_id'] = $user_id;
        $data['commerce_id'] = $this->user->commerce->id;
        $this->waiter->create($data);
    }




    public function edit($id)
    {
        $waiter = $this->waiter->find($id);

        $this->authorize('update', $waiter);

        return view('waiter.edit', compact('waiter'));
    }


    public function update(WaiterUpdateRequest $request, $id)
    {

        $waiter = $this->waiter->find($id);

        $this->authorize('update', $waiter);

        $data = $request->all();

        DB::transaction(function () use($data, $waiter) {
            $this->userRepository->update($data, $waiter->user->id);
            $this->waiter->update($data, $waiter->id);
        });

        return redirect()->route('waiter.index')->with('success', __('El registro se ha guardado correctamente'));
    }


    public function destroy($id)
    {
        $waiter = $this->waiter->find($id);

        $this->authorize('delete', $waiter);

        $this->waiter->delete($waiter->id);

        return response()->json(__('Se eliminó correctamente'), 202);
    }
}

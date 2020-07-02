<?php


namespace App\Repositories\Order;


use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{

    private $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findWithServiceAndDetails($id)
    {
        return $this->model->with('service')
            ->with('details')
            ->where('id', $id)
            ->first();
    }
}

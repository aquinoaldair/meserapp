<?php


namespace App\Repositories\Payment;


use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{

    private $model;

    public function __construct(Payment $model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }
}

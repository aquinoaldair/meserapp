<?php


namespace App\Repositories\Order;


interface OrderRepositoryInterface
{
    public function find($id);

    public function findWithServiceAndDetails($id);

}

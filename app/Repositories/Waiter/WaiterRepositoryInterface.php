<?php


namespace App\Repositories\Waiter;


use App\Repositories\Base\BaseRepositoryInterface;

interface WaiterRepositoryInterface extends BaseRepositoryInterface
{
    public function getByCommerceIdWithUser(int $id);
}

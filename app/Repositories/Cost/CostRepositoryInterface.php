<?php


namespace App\Repositories\Cost;


use App\Repositories\Base\BaseRepositoryInterface;

interface CostRepositoryInterface extends BaseRepositoryInterface
{
    public function getByCommerceId($id);

    public function getByCommerceIdWithSupplier($id);
}

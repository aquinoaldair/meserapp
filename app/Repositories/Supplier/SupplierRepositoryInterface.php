<?php


namespace App\Repositories\Supplier;


use App\Repositories\Base\BaseRepositoryInterface;

interface SupplierRepositoryInterface extends BaseRepositoryInterface
{
    public function getWithProductsByCommerceId(int $id);

    public function getByCommerceId(int $id);

    public function attachProducts(int $id, array $products);

    public function syncProducts(int $id, array $products);

    public function findByIdWithProducts(int $id);
}

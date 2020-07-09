<?php


namespace App\Repositories\Product;


use App\Repositories\Base\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getByCommerceId($id);

    public function searchByNameAndCommerceId($term, $id);
}

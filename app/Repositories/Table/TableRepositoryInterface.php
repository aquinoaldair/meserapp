<?php


namespace App\Repositories\Table;


use App\Repositories\Base\BaseRepositoryInterface;

interface TableRepositoryInterface extends BaseRepositoryInterface
{
    public function getByRoom($id);
    public function findByKey($key);
    public function findOrFailByKey($key);
    public function getParentCommerce($key);
}

<?php


namespace App\Repositories\Category;


use App\Repositories\Base\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getByCommerceId($id);

    public function getByAdmin();

    public function getByAdminPaginate($paginate);

    public function getWithProductsByCommerceId($id);
}

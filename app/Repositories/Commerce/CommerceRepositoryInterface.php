<?php


namespace App\Repositories\Commerce;
use App\Repositories\Base\BaseRepositoryInterface;


interface CommerceRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllInformationById($id);

    public function getWithSchedules();
}

<?php


namespace App\Repositories\Room;


use App\Repositories\Base\BaseRepositoryInterface;

interface RoomRepositoryInterface extends  BaseRepositoryInterface
{
    public function getByCommerceId($id);

    public function getByCommerceIdWithTables($id);

    public function findByKey($key);
}

<?php


namespace App\Repositories\User;

use App\Repositories\Base\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function createUserWithRole(array $data, string $role);

    public function findByEmail($email);
}

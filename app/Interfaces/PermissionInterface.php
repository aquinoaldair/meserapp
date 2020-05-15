<?php


namespace App\Interfaces;


interface PermissionInterface
{
    public function hasPermission($ability, $model);
}

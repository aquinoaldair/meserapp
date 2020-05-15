<?php


namespace App\Repositories\Image;
use App\Repositories\Base\BaseRepositoryInterface;

interface ImageRepositoryInterface extends BaseRepositoryInterface
{
    public function paginate($paginate);

    public function search($term);
}

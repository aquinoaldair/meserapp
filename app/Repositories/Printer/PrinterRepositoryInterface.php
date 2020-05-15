<?php


namespace App\Repositories\Printer;


use App\Repositories\Base\BaseRepositoryInterface;

interface PrinterRepositoryInterface extends BaseRepositoryInterface
{
    public function firstOrCreata($matching, $data);
}

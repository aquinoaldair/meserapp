<?php


namespace App\Repositories\Stock;


use Illuminate\Database\Eloquent\Model;

interface StockRepositoryInterface
{
    public function increase($value, $model);

    public function decrease($value, $model);

    public function mutate($value, $model);

    public function clear($value, $model);

    public function set($value, $model);


}

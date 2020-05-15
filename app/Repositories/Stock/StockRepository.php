<?php


namespace App\Repositories\Stock;


use Illuminate\Database\Eloquent\Model;

class StockRepository implements StockRepositoryInterface
{

    public function increase($value, $model)
    {
        $model->increaseStock($value);
    }

    public function decrease($value, $model)
    {
        $model->decreaseStock($value);
    }

    public function mutate($value, $model)
    {
        $model->mutateStock($value);
    }

    public function clear($value, $model)
    {
        $model->clearStock($value);
    }

    public function set($value, $model)
    {
        $model->setStock($value);
    }
}

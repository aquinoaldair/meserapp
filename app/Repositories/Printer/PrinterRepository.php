<?php


namespace App\Repositories\Printer;


use App\Models\Printer;

class PrinterRepository implements PrinterRepositoryInterface
{

    protected $model;

    public function __construct(Printer $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }


    public function firstOrCreata($matching, $data)
    {
        return $this->model->firstOrCreate($matching, $data);
    }
}

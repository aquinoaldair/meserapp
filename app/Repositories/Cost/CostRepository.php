<?php


namespace App\Repositories\Cost;


use App\Models\Cost;

class CostRepository implements CostRepositoryInterface
{
    private $model;

    public function __construct(Cost $cost)
    {
        $this->model = $cost;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function getByCommerceId($id)
    {
        return $this->model->where('commerce_id', $id)->get();
    }

    public function getByCommerceIdWithSupplier($id)
    {
        return $this->model->whereHas('supplier')->with('supplier')->where('commerce_id', $id)->get();
    }
}

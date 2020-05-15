<?php


namespace App\Repositories\Station;


use App\Models\Station;

class StationRepository implements StationRepositoryInterface
{
    protected $model;

    public function __construct(Station $model)
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

    public function getByCommerceId($id)
    {
        return $this->model->where('commerce_id', $id)->get();
    }
}

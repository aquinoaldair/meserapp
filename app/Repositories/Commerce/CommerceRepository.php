<?php


namespace App\Repositories\Commerce;

use App\Models\Commerce;

class CommerceRepository implements CommerceRepositoryInterface
{
    protected $model;

    public function __construct(Commerce $model)
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
        return $this->model->findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }


    public function getAllInformationById($id){
        return $this->model->where('id', $id)
            ->with('rooms.tables')
            ->with('categories.products')
            ->with('schedules')
            ->first();
    }

    public function getWithSchedules()
    {
        return $this->model->withHighestPrice()->withLowestPrice()->with('schedules')->get();
    }
}

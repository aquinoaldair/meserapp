<?php


namespace App\Repositories\Table;



use App\Models\Table;

class TableRepository implements TableRepositoryInterface
{

    protected $model;

    public function all()
    {
        $this->model->all();
    }

    public function __construct(Table $model)
    {
        $this->model = $model;
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
        return $this->model->findOrFail($id);
    }

    public function getByRoom($id)
    {
        return $this->model->where('room_id', $id)->get();
    }

    public function findByKey($key)
    {
        return $this->model->where('key', $key)->first();
    }

    public function findOrFailByKey($key)
    {
        return $this->model->where('key', $key)->firstOrFail();
    }

    public function getParentCommerce($key){
        return $this->model
            ->with(['room.commerce' => function($q){
                $q->with('categories.products')->with('schedules');
            }])
            ->where('key', $key)
            ->first();
    }

    public function updateStatusById($id, $status)
    {
        $this->model->where('id', $id)->update([
            'status' => $status
        ]);
    }

    public function updateStatusBykEY($key, $status)
    {
        $this->model->where('key', $key)->update([
            'status' => $status
        ]);
    }
}

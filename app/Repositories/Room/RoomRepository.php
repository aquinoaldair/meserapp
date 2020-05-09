<?php


namespace App\Repositories\Room;



use App\Models\Room;

class RoomRepository implements RoomRepositoryInterface
{
    protected $model;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        $this->model->all();
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

    public function getByCommerceId($id){
        return $this->model->where('commerce_id', $id)->get();
    }

    public function findByKey($key)
    {
        return $this->model->where('key', $key)->first();
    }
}

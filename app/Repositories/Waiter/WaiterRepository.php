<?php


namespace App\Repositories\Waiter;


use App\Models\Waiter;

class WaiterRepository implements WaiterRepositoryInterface
{

    private $model;

    public function __construct(Waiter $model)
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
        return $this->model->find($id);
    }

    public function getByCommerceIdWithUser(int $id)
    {
        return $this->model->where('commerce_id', $id)->with('user')->get();
    }
}

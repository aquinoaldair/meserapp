<?php


namespace App\Repositories\Product;


use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
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

    public function getByCommerceId($id)
    {
        return $this->model
            ->with('category')
            ->whereHas('category')
            ->where('commerce_id', $id)
            ->get();
    }

    public function searchByNameAndCommerceId($term, $id)
    {
        return $this->model->where('name', 'like', "%{$term}%")->where('commerce_id', $id)->get();
    }
}

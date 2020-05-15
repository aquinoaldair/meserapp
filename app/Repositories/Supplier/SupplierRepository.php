<?php


namespace App\Repositories\Supplier;


use App\Models\Supplier;

class SupplierRepository implements SupplierRepositoryInterface
{

    protected $model;

    public function __construct(Supplier $model)
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
        return $this->model->findOrFail($id);
    }

    public function getWithProductsByCommerceId($id)
    {
        return $this->model->with('products')->where('commerce_id', $id)->get();
    }

    public function getByCommerceId($id)
    {
        return $this->model->where('commerce_id', $id)->get();
    }

    public function attachProducts(int $id, array $products)
    {
        $user = $this->find($id);
        $user->products()->attach($products);
    }

    public function syncProducts(int $id, array $products)
    {
        $user = $this->find($id);
        $user->products()->sync($products);
    }

    public function findByIdWithProducts(int $id)
    {
        return $this->model->with('products')->find($id);
    }
}

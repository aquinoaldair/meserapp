<?php


namespace App\Repositories\Category;


use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    protected $model;

    public function __construct(Category $model)
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

    public function getByAdmin()
    {
        return $this->model->where('is_admin', true)->get();
    }

    public function getByAdminPaginate($paginate)
    {
        return $this->model->where('is_admin', true)->paginate($paginate);
    }

    public function getWithProductsByCommerceId($id)
    {
        return $this->model->where('commerce_id', $id)->with('products')->get();
    }
}

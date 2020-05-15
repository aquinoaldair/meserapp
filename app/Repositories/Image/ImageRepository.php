<?php


namespace App\Repositories\Image;
use App\Models\Image;

class ImageRepository implements ImageRepositoryInterface
{
    protected $model;

    public function __construct(Image $model)
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

    public function paginate($paginate)
    {
       return $this->model->paginate($paginate);
    }

    public function search($term)
    {
       return $this->model->where('keywords', 'like', "%{$term}%")->get();
    }
}

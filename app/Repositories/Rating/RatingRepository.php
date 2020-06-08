<?php


namespace App\Repositories\Rating;


use App\Models\Rating;

class RatingRepository implements RatingRepositoryInterface
{
    /**
     * @var Rating
     */
    private $model;

    public function __construct(Rating $model)
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
}

<?php


namespace App\Repositories\User;
use App\User;

class UserRepository implements UserRepositoryInterface
{

    protected $model;

    public function __construct(User $model)
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
        $user = $this->find($id);

        return $user->update($data);
        //return $this->model->find('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function createUserWithRole(array $data, string $role)
    {
        $user = $this->create($data);
        $user->assignRole($role);
        return $user;
    }


    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }
}

<?php


namespace App\Repositories\Cost;


use App\Models\Cost;
use Illuminate\Support\Facades\DB;

class CostRepository implements CostRepositoryInterface
{
    private $model;

    public function __construct(Cost $cost)
    {
        $this->model = $cost;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)->update($data);
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

    public function getByCommerceIdWithSupplier($id)
    {
        return $this->model->with('supplier')->where('commerce_id', $id)->get();
    }

    public function getInRangeDateByCommerceIdWithSupplier($id, $start_date, $end_date, $supplier_id)
    {
        return $this->model->with('supplier')
            ->with('supplier')
            ->where('commerce_id', $id)
            ->whereDate('created_at', ">=", $start_date)
            ->whereDate('created_at', "<=", $end_date)
            ->where('supplier_id', $supplier_id)
            ->get();
    }
}

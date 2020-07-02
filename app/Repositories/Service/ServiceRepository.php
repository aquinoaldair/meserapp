<?php


namespace App\Repositories\Service;


use App\Models\Details;
use App\Models\Order;
use App\Models\Service;

class ServiceRepository implements ServiceRepositoryInterface
{

    private $service;

    private $order;

    private $details;

    public function __construct(Service $service, Order $order, Details $details)
    {
        $this->service = $service;
        $this->order = $order;
        $this->details = $details;
    }

    public function storeService($data)
    {
        return $this->service->create($data);
    }

    public function storeOrder($data)
    {
        return $this->order->create($data);
    }

    public function storeDetails($data)
    {
        return $this->details->create($data);
    }

    public function getServiceById($id)
    {
        return $this->service->with('orders.details.product')->find($id);
    }

    public function changeStatusServices($id, $status)
    {
        return $this->service->find($id)->update([
            'status' => $status
        ]);
    }


    public function getServicesByCommerceAndDateRange($id, $start_date, $end_date)
    {
        return $this->service
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->with('orders.details.product')
            ->with('table')
            ->whereHas('orders.details.product')
            ->get();
    }

    public function getServiceWithTableByCommerce($id,  $start_date, $end_date)
    {
        return $this->service->with('table')
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function updateTableInService($service_id, $table_id )
    {
        return $this->service->find($service_id)->update([
            'table_id' => $table_id
        ]);
    }
}

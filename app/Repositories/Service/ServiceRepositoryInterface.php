<?php


namespace App\Repositories\Service;


interface ServiceRepositoryInterface
{
    public function storeService($data);

    public function storeOrder($data);

    public function storeDetails($data);

    public function getServiceById($id);

    public function changeStatusServices($id, $status);

    public function getServicesByCommerceAndDateRange($id, $start_date, $end_date);

    public function getServiceWithTableByCommerce($id, $start_date, $end_date);

    public function updateTableInService($service_id, $table_id);
}

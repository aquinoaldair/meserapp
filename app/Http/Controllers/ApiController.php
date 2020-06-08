<?php

namespace App\Http\Controllers;

use App\Repositories\Commerce\CommerceRepositoryInterface;
use App\Repositories\Table\TableRepositoryInterface;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $table;
    private $commerce;

    public function __construct(TableRepositoryInterface $table, CommerceRepositoryInterface $commerce)
    {
        $this->table = $table;
        $this->commerce = $commerce;
    }

    public function getCommerceInformationFromQr($qr){
        return $this->table->getParentCommerce($qr);
    }

    public function getCommerces(){
        return $this->commerce->getWithSchedules();
    }
}

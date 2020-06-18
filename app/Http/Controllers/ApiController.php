<?php

namespace App\Http\Controllers;

use App\Repositories\Commerce\CommerceRepositoryInterface;
use App\Repositories\Reservation\ReservationRepositoryInterface;
use App\Repositories\Table\TableRepositoryInterface;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $table;
    private $commerce;
    private $reservation;

    public function __construct(TableRepositoryInterface $table, CommerceRepositoryInterface $commerce, ReservationRepositoryInterface $reservation)
    {
        $this->table = $table;
        $this->commerce = $commerce;
        $this->reservation = $reservation;
    }

    public function getCommerceInformationFromQr($qr){
        return $this->table->getParentCommerce($qr);
    }

    public function getCommerces(){
        return $this->commerce->getWithSchedules();
    }

    public function storeReservation(Request $request){
        try {
            $this->reservation->create($request->all());

            return response()->json(['message' => "La reservación se ha realizado correctamente", "success" => true], 200);
        }catch (\Exception $e){
            return response()->json(['message' => "No se realizó la reservación,intentelo mas tarde", "success" => false], 400);
        }
    }


    public function getDataFromCommerceId($id){
        return $this->commerce->getAllInformationById($id);
    }
}

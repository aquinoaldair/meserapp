<?php

namespace App\Http\Controllers;

use App\Repositories\Reservation\ReservationRepositoryInterface;
use Illuminate\Http\Request;

class ReservationController extends BaseController
{

    private $reservation;

    public function __construct(ReservationRepositoryInterface $reservation)
    {
        parent::__construct();

        $this->reservation = $reservation;
    }

    public function index(){
        $data = $this->reservation->getByCommerceId($this->user->commerce->id);
        return view('reservation.index', compact('data'));
    }
}

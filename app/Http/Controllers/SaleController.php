<?php

namespace App\Http\Controllers;

use App\Repositories\Service\ServiceRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends BaseController
{


    private $service;

    public function __construct(ServiceRepositoryInterface $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function index(Request $request){
        $params = $this->getDate($request);
        $data = $this->service->getServiceWithTableByCommerce($this->user->id, $params['start'], $params['end']);
        return view('sale.index', compact('data'));
    }

    private function getDate(Request $request){

        $date = [ "start" => Carbon::now(), "end" => Carbon::now()];

        if ($request->daterange){
            list($date["start"], $date["end"]) =  explode(' - ', $request->daterange);
        }

        return $date;
    }

    public function show($id){

        $service =  $this->service->getServiceById($id);

        $this->authorize('view', $service);

        return view('sale.show', compact('service'));
    }
}

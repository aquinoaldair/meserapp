<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\StatusTable;
use App\Models\Table;
use App\Repositories\Commerce\CommerceRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Rating\RatingRepositoryInterface;
use App\Repositories\Reservation\ReservationRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Table\TableRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    private $table;
    private $commerce;
    private $reservation;
    private $service;
    private $product;
    private $payment;
    private $rating;

    public function __construct(TableRepositoryInterface $table,
                                CommerceRepositoryInterface $commerce,
                                ReservationRepositoryInterface $reservation,
                                ServiceRepositoryInterface $service,
                                ProductRepositoryInterface $product,
                                PaymentRepositoryInterface $payment,
                                RatingRepositoryInterface $rating)
    {
        $this->table = $table;
        $this->commerce = $commerce;
        $this->reservation = $reservation;
        $this->service = $service;
        $this->product = $product;
        $this->payment = $payment;
        $this->rating = $rating;
    }

    public function getCommerceInformationFromQr($qr){

        $table = $this->table->findByKey($qr);

        if ($table->status != StatusTable::STATUS_ENABLED){
            return response()->json(['message' => "Mesa Ocupada"], 401);
        }

        $this->table->updateStatusBykEY($qr, StatusTable::STATUS_OCCUPIED);

        return response()->json(['message' => "Mesa Libre"], 200);

    }


    public function getCommerceDataFromQr($qr){
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
            return response()->json(['message' => "No se realizó la reservación, intentelo mas tarde", "success" => false], 400);
        }
    }

    public function getDataFromCommerceId($id){
        return $this->commerce->getAllInformationById($id);
    }


    public function storeService(Request $request){
        $data = $request->all();
        $table = $this->table->find($request->table_id);
        $data['commerce_id'] = $table->room->commerce_id;
        return $this->service->storeService($data);
    }

    public function storeOrder(Request $request){

        //get service
        $service = $this->service->getServiceById($request->service_id);

        DB::transaction(function () use($request, $service) {

            //update status table
            $this->table->updateStatusById($service->table_id, StatusTable::STATUS_ORDERED);

            //store the order
            $order = $this->service->storeOrder($request->all());

            //store details order
            $this->createDetails($request->products, $order);
        });

        //return service
        return $this->service->getServiceById($service->id);
    }


    public function createDetails($products, $order){

        foreach ($products as $item){
            //get product
            $product = $this->product->find($item['id']);
            //store details
            $this->storeDetails([
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'order_id' => $order->id,
                'price' => $product->price,
                'comment' => isset($item['comment']) ? $item['comment'] : ''
            ]);
        }
    }

    public function storeDetails($data){
        return $this->service->storeDetails($data);
    }

    public function getService($id){
        return $this->service->getServiceById($id);
    }

    public function storePayment(Request $request){

        return DB::transaction(function () use($request) {

            $service = $this->service->getServiceById($request->service_id);

            $payment = $this->payment->store([
                'service_id'    => $request->service_id,
                'type'          => $request->type,
                'tip_detail'    => $request->tip_detail ?? null,
                'total'         => $request->total ?? null,
                'tip'           => $request->tip ?? null,
                'amount'        => $request->amount ?? null
            ]);

            $this->service->changeStatusServices($payment->service_id, Service::STATUS_FINISHED);

            $this->table->updateStatusById($service->table_id, StatusTable::STATUS_PAYING);

            return $payment;

        });
    }

    public function storeRating(Request $request){
        return $this->rating->create($request->all());
    }


}

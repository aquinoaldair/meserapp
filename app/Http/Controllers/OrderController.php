<?php

namespace App\Http\Controllers;

use App\Repositories\Detail\DetailRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Printer\PrinterRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends BaseController
{

    private $order;
    private $detail;


    public function __construct(OrderRepositoryInterface $order, DetailRepositoryInterface $detail)
    {
        parent::__construct();
        $this->order = $order;
        $this->detail = $detail;
    }

    public function printSingle($id){

        $order =  $this->order->findWithServiceAndDetails($id);

        $this->authorize('view', $order);

        $printer_config = $this->user->commerce->printer;

        $pdf = app('dompdf.wrapper');

        $pdf->setPaper($this->getCustomPaper());

        $pdf->loadView('order.print.single', compact('order', 'printer_config'));

        return $pdf->stream('order.pdf');
    }

    private function getCustomPaper(){
        return array(0,0,340,440);
    }

    public function deleteProductFromOrder(Request $request){
        $detail = $this->detail->find($request->detail_id);

        $this->authorize('delete', $detail);

        return $this->detail->delete($detail->id);

    }
}

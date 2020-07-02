<?php

namespace App\Http\Controllers;

use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Printer\PrinterRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends BaseController
{

    private $order;


    public function __construct(OrderRepositoryInterface $order)
    {
        parent::__construct();
        $this->order = $order;
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
}

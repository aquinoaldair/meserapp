<?php

namespace App\Http\Controllers;

use App\Models\Printer;
use App\Repositories\Printer\PrinterRepositoryInterface;
use Illuminate\Http\Request;

class PrinterController extends BaseController
{
    private $printer;

    public function __construct(PrinterRepositoryInterface $printer)
    {
        parent::__construct();

        $this->printer = $printer;
    }

    public function index()
    {
        $printer = $this->user->commerce->printer;

        return view('printer.index', compact('printer'));
    }

    public function store(Request $request)
    {
        $this->printer->firstOrCreata([
            'commerce_id' => $this->user->commerce->id
        ],$request->all());

        return redirect()->route('printer.index')->with('success', "Se ha guardado correctamente");
    }

}

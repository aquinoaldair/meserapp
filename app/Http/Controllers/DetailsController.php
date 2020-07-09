<?php

namespace App\Http\Controllers;

use App\Repositories\Detail\DetailRepositoryInterface;
use Illuminate\Http\Request;

class DetailsController extends BaseController
{

    private $detail;

    public function __construct(DetailRepositoryInterface $detail)
    {
        parent::__construct();
        $this->detail = $detail;
    }

    public function updateProductInDetail(Request $request){

        $detail = $this->detail->find($request->detail_id);

        $this->authorize('update', $detail);

        $this->detail->update([
            'quantity' => $request->quantity
        ], $detail->id);

        return response()->json('', 200);
    }
}

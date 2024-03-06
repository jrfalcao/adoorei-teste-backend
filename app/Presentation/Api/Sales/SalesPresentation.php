<?php

namespace App\Presentation\Api\Sales;

use Illuminate\Http\Request;
use App\Application\Services\SalesServiceInterface;
use App\Http\Controllers\Controller;

class SalesPresentation extends Controller
{
    protected $salesService;

    public function __construct(SalesServiceInterface $salesService)
    {
        $this->salesService = $salesService;
    }

    public function createSale(Request $request)
    {
        $saleData = $request->all();
        $result = $this->salesService->createSale($saleData);

        if ($result) {
            return response()->json($result, 201);
        } else {
            return response()->json(['message' => 'Failed to create sale.'], 500);
        }
    }
}

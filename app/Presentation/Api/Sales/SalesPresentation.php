<?php

namespace App\Presentation\Api\Sales;

use Illuminate\Http\Request;
use App\Application\Services\SalesServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SalesPresentation extends Controller
{
    protected $salesService;

    public function __construct(SalesServiceInterface $salesService)
    {
        $this->salesService = $salesService;
    }

    public function createSale(Request $request): JsonResponse
    {
        $saleData = $request->all();
        $result = $this->salesService->createSale($saleData);

        if ($result) {
            return response()->json((array) $result, 201);
        } else {
            return response()->json(['message' => 'Failed to create sale.'], 500);
        }
    }

    public function getSales(Request $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->salesService->getSales($data);
        if ($result) {
            return response()->json((array) $result, 201);
        } else {
            return response()->json(['message' => 'Failed to find sales.'], 500);
        }
    }

    public function getById($id): JsonResponse
    {
        $result = $this->salesService->find($id);

        if ($result) {
            return response()->json((array) $result, 201);
        } else {
            return response()->json(['message' => 'Failed to find sales.'], 500);
        }
    }

    public function destroy($id)
    {
        $result = $this->salesService->destroy($id);

        if($result)
            return response()->json(['message' => 'Sale deleted successfully'], 200);
        else
            return response()->json(['message' => 'Sale not found'], 401);
    }

    public function addProducts(Request $request, $saleId)
    {
        $saleData = $request->all();
        $result = $this->salesService->updateSale($saleId, $saleData);

        if ($result) {
            return response()->json((array) $result, 201);
        } else {
            return response()->json(['message' => 'Failed to create sale.'], 500);
        }
    }
}

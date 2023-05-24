<?php

namespace App\Http\Controllers;

use App\Events\NewOrder;
use App\Models\PurchaseOrder;
use App\Http\Requests\PurchaseOrderRequest;
use App\Services\PurchaseOrderService;
use Illuminate\Http\Response;

class PurchaseOrderController extends Controller
{
    private $purchaseOrderService;

    public function __construct(PurchaseOrderService $purchaseOrderService)
    {
        $this->purchaseOrderService = $purchaseOrderService;
    }

    public function store(PurchaseOrderRequest $request)
    {
        $purchaseOrder = new PurchaseOrder();
        $this->purchaseOrderService->savePurchaseOrder($request, $purchaseOrder);
        NewOrder::dispatch($purchaseOrder);
        return response(PurchaseOrder::with('items')->find($purchaseOrder->id), Response::HTTP_CREATED);
    }

}

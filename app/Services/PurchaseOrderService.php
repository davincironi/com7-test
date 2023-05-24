<?php

namespace App\Services;

use App\Models\PurchaseOrderItem;


class PurchaseOrderService
{

    public function savePurchaseOrder($request, $purchaseOrder)
    {
        $purchaseOrder->user_id = $request->user()->id;
        $purchaseOrder->email = $request->user()->email;
        $purchaseOrder->phone = $request->phone;
        $purchaseOrder->bill_address = $request->bill_address;
        $purchaseOrder->ship_address = $request->ship_address;
        $purchaseOrder->summary_price = $request->summary_price;
        $purchaseOrder->save();

        foreach($request->items as $item) {
            $purchaseOrderItem = new PurchaseOrderItem();
            $purchaseOrderItem->purchase_order_id = $purchaseOrder->id;
            $this->savePurchaseOrderItem($item, $purchaseOrderItem);
        }
    }

    public function savePurchaseOrderItem($item, $purchaseOrderItem)
    {
        $purchaseOrderItem->product_id = $item['product_id'];
        $purchaseOrderItem->product_name = $item['product_name'];
        $purchaseOrderItem->quantity = $item['quantity'];
        $purchaseOrderItem->price = $item['price'];
        $purchaseOrderItem->total_price = $item['total_price'];
        $purchaseOrderItem->save();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'purchase_order_items';

    protected $fillable = [
        'product_id', 'product_name', 'quantity', 'price', 'total_price'
    ];

    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }
}

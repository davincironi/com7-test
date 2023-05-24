<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('product_name', 255);
            $table->integer('quantity')->unsigned();
            $table->double('price')->unsigned()->default(0);
            $table->double('total_price')->unsigned()->default(0);

            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};

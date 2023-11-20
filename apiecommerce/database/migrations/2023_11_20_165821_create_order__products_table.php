<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

   // dans la migration create_order_products_table.php
public function up()
{
    Schema::create('order_products', function (Blueprint $table) {
        $table->unsignedBigInteger('order_id');
        $table->unsignedBigInteger('product_id');
        $table->integer('quantity');
        $table->timestamps();

        $table->primary(['order_id', 'product_id']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order__products');
    }
};

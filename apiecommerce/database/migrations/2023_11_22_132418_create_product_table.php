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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_category');
<<<<<<<< HEAD:apiecommerce/database/migrations/2023_11_22_155641_create_product_table.php
            $table->foreign('id_category')->references('id')->on('categorie')->onDelete("cascade");
========
            $table->foreign('id_category')->references('id')->on('categorie')->onDelete('cascade');
>>>>>>>> main:apiecommerce/database/migrations/2023_11_22_132418_create_product_table.php
            $table->string('name');
            $table->string('description');
            $table->string('prix');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};

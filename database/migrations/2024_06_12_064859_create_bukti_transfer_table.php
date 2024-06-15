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
        Schema::create('bukti_transfer', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->enum('status', ['Menunggu Pembayaran','Menunggu Konfirmasi', 'Pembayaran Dikonfirmasi']);
            $table->unsignedBigInteger('sales_product_id');
            $table->timestamps();

            $table->foreign('sales_product_id')->references('id')->on('sales_product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_transfer');
    }
};

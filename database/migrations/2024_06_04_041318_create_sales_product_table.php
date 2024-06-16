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
        Schema::create('sales_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('jumlah');
            $table->unsignedBigInteger('total');
            $table->integer('luas')->nullable();
            $table->enum('satuan_luas', ['m2', 'h'])->nullable();
            $table->enum('status_pesanan', ['Pending', 'Proses Penanaman', 'Siap Kirim / Siap Diambil', 'Dikirim / Diambil']);
            $table->date('tanggal_penanaman')->nullable();
            $table->text('alamat_pengiriman')->default('Ambil Ditempat');
            $table->string('lokasi')->nullable();
            $table->unsignedBigInteger('ongkir')->nullable();
            $table->unsignedBigInteger('total_keseluruhan')->nullable();
            $table->enum('metode_pembayaran', ['Transfer', 'COD']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_product');
    }
};

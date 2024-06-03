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
            $table->string('kode_bibit');
            $table->string('nama_bibit');
            $table->text('detail_bibit');
            $table->unsignedBigInteger('harga_bibit');
            $table->integer('stok_bibit');
            $table->string('image');
            $table->enum('status_bibit', ['ready', 'soldout']);
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

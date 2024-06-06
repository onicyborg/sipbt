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
        Schema::create('perkembangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_product_id');
            $table->string('title');
            $table->text('image');
            $table->integer('umur');
            $table->integer('tinggi');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('sales_product_id')->references('id')->on('sales_product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkembangan');
    }
};

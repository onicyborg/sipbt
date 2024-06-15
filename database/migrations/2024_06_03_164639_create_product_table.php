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
            $table->string('kode')->unique();
            $table->string('nama');
            $table->text('detail');
            $table->unsignedBigInteger('harga');
            $table->integer('stok');
            $table->string('image');
            $table->enum('jenis_pesanan', ['preorder', 'ready']);
            $table->date('tanggal_tanam')->nullable();
            $table->enum('jarak_tanam', ['50', '60'])->nullable();
            $table->enum('display', ['Tampilkan', 'Sembunyikan'])->default('Tampilkan');
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

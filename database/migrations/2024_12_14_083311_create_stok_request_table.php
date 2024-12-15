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
        Schema::create('stok_request', function (Blueprint $table) {
            $table->id('id_request');
            $table->date('tanggal_pengajuan');
            $table->foreignId('id_produk')->constrained('produk','id_produk');
            $table->integer('jumlah');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_request');
    }
};

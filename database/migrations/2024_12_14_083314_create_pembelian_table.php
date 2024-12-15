<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id('id_pembelian');
            $table->foreignId('id_supplier')->constrained('supplier','id_supplier');
            $table->string('no_faktur');
            $table->date('tanggal');
            $table->integer('total');
            $table->timestamps();
        });

        Schema::create('pembelian_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pembelian')->constrained('pembelian','id_pembelian');
            $table->foreignId('id_produk')->constrained('produk','id_produk');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};

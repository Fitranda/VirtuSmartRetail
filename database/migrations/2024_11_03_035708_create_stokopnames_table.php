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
        Schema::create('stokopname', function (Blueprint $table) {
            $table->id('id_stokopname');
            $table->foreignId('id_produk')->constrained('produk','id_produk');
            $table->date('tanggal_opname');
            $table->integer('jumlah_sebenarnya');
            $table->integer('selisih');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stokopname');
    }
};

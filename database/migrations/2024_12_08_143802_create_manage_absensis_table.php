<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_absensis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');  // Tanggal absensi
            $table->foreignId('shift_id')->constrained('shifts');  // Relasi ke tabel shifts
            $table->foreignId('karyawan_id')->constrained('karyawans');  // Relasi ke tabel karyawans
            $table->timestamps();

            // Pastikan tidak ada data yang memiliki tanggal dan karyawan yang sama pada shift yang sama
            $table->unique(['tanggal', 'shift_id', 'karyawan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_absensis');
    }
}

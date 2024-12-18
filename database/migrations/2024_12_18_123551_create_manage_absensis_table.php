<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageAbsensisTable extends Migration
{
    public function up()
    {
        Schema::create('manage_absensis', function (Blueprint $table) {
            $table->id(); // ID untuk absensi
            $table->foreignId('id_karyawan')->constrained('karyawan', 'id_karyawan')->onDelete('cascade'); // Relasi ke tabel Karyawan
            $table->foreignId('id_shift')->constrained('shifts')->onDelete('cascade'); // Relasi ke tabel Shift
            $table->date('tanggal'); // Tanggal absensi
            $table->enum('status_hadir', ['Hadir', 'Tidak Hadir']); // Status kehadiran
            $table->timestamps(); // Timestamps (created_at dan updated_at)
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('manage_absensis');
    }
}

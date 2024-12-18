<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'jadwal';

    // Kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'id_karyawan',
        'id_shift',
        'tanggal',
    ];

    // Menentukan kolom yang harus diperlakukan sebagai timestamp
    public $timestamps = true;

    // Relasi dengan model Karyawan
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}

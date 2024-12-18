<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'absensi';

    protected $primaryKey = 'id_absensi';

    // Menentukan kolom mana saja yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'id_karyawan',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'status_hadir',
    ];

    // Menentukan kolom yang harus diperlakukan sebagai timestamp
    public $timestamps = true;

    // Relasi dengan model Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift');
    }

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'id_karyawan', 'id_karyawan')
                    ->whereColumn('tanggal', 'absensi.tanggal');
    }

}

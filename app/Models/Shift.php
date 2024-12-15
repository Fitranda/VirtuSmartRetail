<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shifts';
    protected $primaryKey = 'id_shift';
    protected $fillable = ['nama_shift', 'jam_mulai', 'jam_selesai'];
// Shift.php
public function karyawan()
{
    return $this->hasMany(Karyawan::class, 'id_shift'); // pastikan kolom relasi 'shift_id' sesuai dengan kolom yang ada di tabel karyawan
}

}

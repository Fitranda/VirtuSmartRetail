<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageAbsensi extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'shift_id', 'karyawan_id'];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}

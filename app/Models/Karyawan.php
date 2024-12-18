<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Karyawan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    public $timestamps = true;

    protected $fillable = [
        'nama', 'posisi', 'gaji_pokok', 'id_shift', 'username', 'password', 'email', 'id_role', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Mutator untuk password agar otomatis terenkripsi
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Relasi ke tabel Role
// app/Models/Karyawan.php

public function role()
{
    return $this->belongsTo(Role::class, 'id_role', 'id_role');
}


    // Relasi ke tabel Shift
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift', 'id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_karyawan', 'id_karyawan');
    }

    // Scope untuk karyawan yang aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}

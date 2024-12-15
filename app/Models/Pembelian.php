<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';

    protected $primaryKey = 'id_pembelian'; // Specify your primary key column

    protected $fillable = [
        'id_supplier',
        'no_faktur',
        'tanggal',
        'total'
    ];

    public $timestamps = true;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'id_pembelian', 'id_pembelian');
    }
}

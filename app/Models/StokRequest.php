<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokRequest extends Model
{
    protected $table = 'stok_request';
    protected $primaryKey = 'id_request';
    protected $fillable = [
        'id_produk',
        'tanggal_pengajuan',
        'jumlah',
        'status',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}

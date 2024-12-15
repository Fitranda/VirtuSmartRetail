<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian_detail';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_pembelian',
        'id_produk',
        'jumlah',
        'harga',
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_pembelian', 'id_pembelian');
    }

    public function barang()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}

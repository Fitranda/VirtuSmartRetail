<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProduksTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // foreach (range(1, 20) as $index) {
            DB::table('produk')->insert([
                ['nama_produk' => 'Beras Premium', 'kategori' => 'Sembako', 'stok' => 50, 'harga_beli' => 10000, 'harga_jual' => 12500, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Gula Pasir', 'kategori' => 'Sembako', 'stok' => 70, 'harga_beli' => 12000, 'harga_jual' => 15000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Minyak Goreng', 'kategori' => 'Sembako', 'stok' => 30, 'harga_beli' => 14000, 'harga_jual' => 18000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Kopi Sachet', 'kategori' => 'Minuman', 'stok' => 100, 'harga_beli' => 2000, 'harga_jual' => 2500, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Teh Celup', 'kategori' => 'Minuman', 'stok' => 80, 'harga_beli' => 4000, 'harga_jual' => 6000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Mie Instan', 'kategori' => 'Makanan', 'stok' => 120, 'harga_beli' => 2500, 'harga_jual' => 3000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Roti Tawar', 'kategori' => 'Makanan', 'stok' => 20, 'harga_beli' => 8000, 'harga_jual' => 10000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Tepung Terigu', 'kategori' => 'Sembako', 'stok' => 40, 'harga_beli' => 7000, 'harga_jual' => 9000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Sabun Cuci Piring', 'kategori' => 'Kebutuhan Rumah', 'stok' => 60, 'harga_beli' => 5000, 'harga_jual' => 7000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Pasta Gigi', 'kategori' => 'Kebutuhan Pribadi', 'stok' => 50, 'harga_beli' => 8000, 'harga_jual' => 10000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Susu Bubuk', 'kategori' => 'Minuman', 'stok' => 25, 'harga_beli' => 45000, 'harga_jual' => 50000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Air Mineral 600ml', 'kategori' => 'Minuman', 'stok' => 200, 'harga_beli' => 1500, 'harga_jual' => 2000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Shampoo 200ml', 'kategori' => 'Kebutuhan Pribadi', 'stok' => 30, 'harga_beli' => 15000, 'harga_jual' => 18000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Detergen Bubuk', 'kategori' => 'Kebutuhan Rumah', 'stok' => 40, 'harga_beli' => 15000, 'harga_jual' => 20000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Snack Keripik', 'kategori' => 'Makanan', 'stok' => 100, 'harga_beli' => 5000, 'harga_jual' => 7000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Telur Ayam 1kg', 'kategori' => 'Sembako', 'stok' => 20, 'harga_beli' => 23000, 'harga_jual' => 25000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Baterai AA', 'kategori' => 'Elektronik', 'stok' => 30, 'harga_beli' => 8000, 'harga_jual' => 10000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Obat Nyamuk', 'kategori' => 'Kebutuhan Rumah', 'stok' => 45, 'harga_beli' => 10000, 'harga_jual' => 12000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Sikat Gigi', 'kategori' => 'Kebutuhan Pribadi', 'stok' => 60, 'harga_beli' => 3000, 'harga_jual' => 5000, 'created_at' => now(), 'updated_at' => now()],
                ['nama_produk' => 'Lampu LED', 'kategori' => 'Elektronik', 'stok' => 35, 'harga_beli' => 15000, 'harga_jual' => 20000, 'created_at' => now(), 'updated_at' => now()],
            ]);

        // }
    }
}

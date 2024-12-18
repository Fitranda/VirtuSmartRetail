<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JurnalsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $akuns = DB::table('akun')->pluck('id_akun')->toArray();

        DB::table('jurnal')->insert([
            // Pembelian
            ['id_akun' => 4, 'tanggal_jurnal' => '2024-12-01', 'debet' => 50000, 'kredit' => 0, 'keterangan' => 'Pembelian Persediaan', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 6, 'tanggal_jurnal' => '2024-12-01', 'debet' => 0, 'kredit' => 50000, 'keterangan' => 'Pembelian secara kredit', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 4, 'tanggal_jurnal' => '2024-12-02', 'debet' => 80000, 'kredit' => 0, 'keterangan' => 'Pembelian Persediaan tambahan', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 6, 'tanggal_jurnal' => '2024-12-02', 'debet' => 0, 'kredit' => 80000, 'keterangan' => 'Pembelian tambahan secara kredit', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 4, 'tanggal_jurnal' => '2024-12-03', 'debet' => 60000, 'kredit' => 0, 'keterangan' => 'Pembelian barang dagang', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 6, 'tanggal_jurnal' => '2024-12-03', 'debet' => 0, 'kredit' => 60000, 'keterangan' => 'Pembelian barang dagang secara kredit', 'created_at' => now(), 'updated_at' => now()],

            // Penjualan
            ['id_akun' => 3, 'tanggal_jurnal' => '2024-12-04', 'debet' => 100000, 'kredit' => 0, 'keterangan' => 'Piutang atas penjualan', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 11, 'tanggal_jurnal' => '2024-12-04', 'debet' => 0, 'kredit' => 100000, 'keterangan' => 'Pendapatan dari penjualan', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 3, 'tanggal_jurnal' => '2024-12-05', 'debet' => 120000, 'kredit' => 0, 'keterangan' => 'Penjualan secara piutang', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 11, 'tanggal_jurnal' => '2024-12-05', 'debet' => 0, 'kredit' => 120000, 'keterangan' => 'Pendapatan dari penjualan', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 1, 'tanggal_jurnal' => '2024-12-06', 'debet' => 50000, 'kredit' => 0, 'keterangan' => 'Kas diterima dari penjualan', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 11, 'tanggal_jurnal' => '2024-12-06', 'debet' => 0, 'kredit' => 50000, 'keterangan' => 'Pendapatan dari penjualan', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 3, 'tanggal_jurnal' => '2024-12-07', 'debet' => 75000, 'kredit' => 0, 'keterangan' => 'Penjualan kredit kepada pelanggan', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 11, 'tanggal_jurnal' => '2024-12-07', 'debet' => 0, 'kredit' => 75000, 'keterangan' => 'Pendapatan penjualan kredit', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 3, 'tanggal_jurnal' => '2024-12-08', 'debet' => 110000, 'kredit' => 0, 'keterangan' => 'Penjualan kredit lainnya', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 11, 'tanggal_jurnal' => '2024-12-08', 'debet' => 0, 'kredit' => 110000, 'keterangan' => 'Pendapatan penjualan tambahan', 'created_at' => now(), 'updated_at' => now()],

            // Aset
            ['id_akun' => 1, 'tanggal_jurnal' => '2024-12-09', 'debet' => 90000, 'kredit' => 0, 'keterangan' => 'Kas masuk dari hasil usaha', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 2, 'tanggal_jurnal' => '2024-12-10', 'debet' => 70000, 'kredit' => 0, 'keterangan' => 'Dana disimpan ke bank', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 5, 'tanggal_jurnal' => '2024-12-11', 'debet' => 30000, 'kredit' => 0, 'keterangan' => 'Pembelian perlengkapan kantor', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 1, 'tanggal_jurnal' => '2024-12-12', 'debet' => 45000, 'kredit' => 0, 'keterangan' => 'Kas tambahan dari investor', 'created_at' => now(), 'updated_at' => now()],
            ['id_akun' => 5, 'tanggal_jurnal' => '2024-12-13', 'debet' => 50000, 'kredit' => 0, 'keterangan' => 'Pengadaan aset tetap', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
}

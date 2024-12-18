<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AkunsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // foreach (range(1, 20) as $index) {
            DB::table('akun')->insert([
                ['nama_akun' => 'Kas', 'tipe' => 'Asset', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Bank', 'tipe' => 'Asset', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Piutang Usaha', 'tipe' => 'Asset', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Persediaan', 'tipe' => 'Asset', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Perlengkapan Kantor', 'tipe' => 'Asset', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Hutang Usaha', 'tipe' => 'Kewajiban', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Hutang Bank', 'tipe' => 'Kewajiban', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Pendapatan Diterima di Muka', 'tipe' => 'Kewajiban', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Modal Pemilik', 'tipe' => 'Ekuitas', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Laba Ditahan', 'tipe' => 'Ekuitas', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Pendapatan Penjualan', 'tipe' => 'Pendapatan', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Pendapatan Lain-lain', 'tipe' => 'Pendapatan', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Beban Gaji', 'tipe' => 'Beban', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Beban Sewa', 'tipe' => 'Beban', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Beban Listrik dan Air', 'tipe' => 'Beban', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Beban Transportasi', 'tipe' => 'Beban', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Beban Penyusutan', 'tipe' => 'Beban', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Pendapatan Bunga', 'tipe' => 'Pendapatan', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Pendapatan Dividen', 'tipe' => 'Pendapatan', 'created_at' => now(), 'updated_at' => now()],
                ['nama_akun' => 'Beban Asuransi', 'tipe' => 'Beban', 'created_at' => now(), 'updated_at' => now()],
            ]);

        // }
    }
}

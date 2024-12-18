<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Shift;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        $karyawans = Karyawan::all();
        $shifts = Shift::all();
        $faker = Faker::create();

        foreach ($karyawans as $karyawan) {
            foreach (range(1, 5) as $index) {
                DB::table('jadwal')->insert([
                    'id_karyawan' => $karyawan->id_karyawan,
                    'id_shift' => $shifts->random()->id_shift,
                    'tanggal' => $faker->date(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

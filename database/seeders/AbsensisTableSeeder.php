<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Jadwal;
use Carbon\Carbon;

class AbsensisTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('absensi')->truncate();

        $jadwals = Jadwal::with('shift')->get();

        if ($jadwals->isEmpty()) {
            $this->command->warn('Tidak ada data jadwal. Jalankan JadwalSeeder terlebih dahulu.');
            return;
        }

        foreach ($jadwals as $jadwal) {
            if (!$jadwal->shift) {
                $this->command->warn("Shift tidak ditemukan untuk Jadwal ID {$jadwal->id}.");
                continue;
            }

            if (empty($jadwal->shift->jam_mulai) || empty($jadwal->shift->jam_selesai)) {
                $this->command->warn("Shift tidak valid (jam kosong) pada Jadwal ID {$jadwal->id}.");
                continue;
            }

            $tanggal = Carbon::parse($jadwal->tanggal);

            $jamMulaiString = $jadwal->shift->jam_mulai;
            $jamSelesaiString = $jadwal->shift->jam_selesai;

            try {
                $jamMulai = $tanggal->copy()->setTimeFromTimeString($jamMulaiString);
                $jamSelesai = $tanggal->copy()->setTimeFromTimeString($jamSelesaiString);

                if ($jamMulai->greaterThan($jamSelesai)) {
                    $jamSelesai->addDay();
                }


                DB::table('absensi')->insert([
                    'id_karyawan' => $jadwal->id_karyawan,
                    'tanggal' => $tanggal->format('Y-m-d'),
                    'jam_masuk' => $jamMulai->format('Y-m-d H:i:s'),
                    'jam_keluar' => $jamSelesai->format('Y-m-d H:i:s'),
                    'status_hadir' => 'Hadir',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Exception $e) {
                $this->command->warn("Gagal memproses Jadwal ID {$jadwal->id}: " . $e->getMessage());
            }
        }

        $this->command->info('Seeder Absensi berhasil dijalankan.');
    }
}

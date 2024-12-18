<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class KaryawansTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $roles = DB::table('role')->pluck('id_role')->toArray();

        // foreach (range(1, 20) as $index) {
            DB::table('karyawan')->insert([
                ['nama' => 'Budi Santoso', 'posisi' => 'Manager', 'gaji_pokok' => 7500000, 'username' => 'budi.santoso', 'password' => Hash::make('password123'), 'email' => 'budi.santoso@gmail.com', 'id_role' => 1, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Siti Nurhaliza', 'posisi' => 'Admin', 'gaji_pokok' => 4500000, 'username' => 'siti.nurhaliza', 'password' => Hash::make('password123'), 'email' => 'siti.nurhaliza@gmail.com', 'id_role' => 2, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Andi Pratama', 'posisi' => 'Staff IT', 'gaji_pokok' => 6000000, 'username' => 'andi.pratama', 'password' => Hash::make('password123'), 'email' => 'andi.pratama@gmail.com', 'id_role' => 3, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Dewi Sartika', 'posisi' => 'HRD', 'gaji_pokok' => 7000000, 'username' => 'dewi.sartika', 'password' => Hash::make('password123'), 'email' => 'dewi.sartika@gmail.com', 'id_role' => 4, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Rizki Hidayat', 'posisi' => 'Marketing', 'gaji_pokok' => 5500000, 'username' => 'rizki.hidayat', 'password' => Hash::make('password123'), 'email' => 'rizki.hidayat@gmail.com', 'id_role' => 5, 'remember_token' => Str::random(10), 'status' => 'nonaktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Nurul Fadilah', 'posisi' => 'Finance', 'gaji_pokok' => 6500000, 'username' => 'nurul.fadilah', 'password' => Hash::make('password123'), 'email' => 'nurul.fadilah@gmail.com', 'id_role' => 2, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Adi Wibowo', 'posisi' => 'Staff Operasional', 'gaji_pokok' => 4000000, 'username' => 'adi.wibowo', 'password' => Hash::make('password123'), 'email' => 'adi.wibowo@gmail.com', 'id_role' => 3, 'remember_token' => Str::random(10), 'status' => 'nonaktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Lestari Handayani', 'posisi' => 'Supervisor', 'gaji_pokok' => 8000000, 'username' => 'lestari.handayani', 'password' => Hash::make('password123'), 'email' => 'lestari.handayani@gmail.com', 'id_role' => 1, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Farid Maulana', 'posisi' => 'IT Support', 'gaji_pokok' => 5000000, 'username' => 'farid.maulana', 'password' => Hash::make('password123'), 'email' => 'farid.maulana@gmail.com', 'id_role' => 3, 'remember_token' => Str::random(10), 'status' => 'nonaktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Yulianti Pramesti', 'posisi' => 'Admin', 'gaji_pokok' => 4500000, 'username' => 'yulianti.pramesti', 'password' => Hash::make('password123'), 'email' => 'yulianti.pramesti@gmail.com', 'id_role' => 2, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Hendra Gunawan', 'posisi' => 'Manager Operasional', 'gaji_pokok' => 8500000, 'username' => 'hendra.gunawan', 'password' => Hash::make('password123'), 'email' => 'hendra.gunawan@gmail.com', 'id_role' => 1, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Linda Kusuma', 'posisi' => 'Supervisor Marketing', 'gaji_pokok' => 7500000, 'username' => 'linda.kusuma', 'password' => Hash::make('password123'), 'email' => 'linda.kusuma@gmail.com', 'id_role' => 5, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Agus Prasetyo', 'posisi' => 'Keuangan', 'gaji_pokok' => 6000000, 'username' => 'agus.prasetyo', 'password' => Hash::make('password123'), 'email' => 'agus.prasetyo@gmail.com', 'id_role' => 2, 'remember_token' => Str::random(10), 'status' => 'nonaktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Rani Wijaya', 'posisi' => 'HR', 'gaji_pokok' => 7000000, 'username' => 'rani.wijaya', 'password' => Hash::make('password123'), 'email' => 'rani.wijaya@gmail.com', 'id_role' => 4, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Dwi Anggoro', 'posisi' => 'Marketing', 'gaji_pokok' => 5000000, 'username' => 'dwi.anggoro', 'password' => Hash::make('password123'), 'email' => 'dwi.anggoro@gmail.com', 'id_role' => 5, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Sri Lestari', 'posisi' => 'Admin', 'gaji_pokok' => 4000000, 'username' => 'sri.lestari', 'password' => Hash::make('password123'), 'email' => 'sri.lestari@gmail.com', 'id_role' => 2, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Fikri Abdullah', 'posisi' => 'Supervisor IT', 'gaji_pokok' => 7500000, 'username' => 'fikri.abdullah', 'password' => Hash::make('password123'), 'email' => 'fikri.abdullah@gmail.com', 'id_role' => 3, 'remember_token' => Str::random(10), 'status' => 'nonaktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Vina Maharani', 'posisi' => 'Finance', 'gaji_pokok' => 5000000, 'username' => 'vina.maharani', 'password' => Hash::make('password123'), 'email' => 'vina.maharani@gmail.com', 'id_role' => 2, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Teguh Saputra', 'posisi' => 'Manager', 'gaji_pokok' => 9000000, 'username' => 'teguh.saputra', 'password' => Hash::make('password123'), 'email' => 'teguh.saputra@gmail.com', 'id_role' => 1, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Rina Andayani', 'posisi' => 'Admin', 'gaji_pokok' => 4000000, 'username' => 'rina.andayani', 'password' => Hash::make('password123'), 'email' => 'rina.andayani@gmail.com', 'id_role' => 2, 'remember_token' => Str::random(10), 'status' => 'aktif', 'created_at' => now(), 'updated_at' => now()],
            ]);

        // }
    }
}

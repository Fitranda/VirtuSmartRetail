<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;  // Import Jadwal Model
use App\Models\Karyawan;  // Import Karyawan Model
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageAbsensiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan dari request atau gunakan bulan saat ini
        $month = $request->get('month', now()->format('Y-m'));

        // Query data absensi sesuai permintaan
        $absensiRawData = DB::table('absensi as a')
            ->join('karyawan as k', 'a.id_karyawan', '=', 'k.id_karyawan')
            ->leftJoin('shifts as s', 'k.id_shift', '=', 's.id_shift')
            ->select('a.tanggal', 'k.nama as nama_karyawan', 's.nama_shift', 'a.status_hadir')
            ->where('a.status_hadir', 'Hadir')
            ->where('a.tanggal', 'like', "$month%")
            ->orderBy('a.tanggal', 'asc')
            ->get();

        // Kelompokkan data berdasarkan tanggal dan shift
        $absensiData = $absensiRawData->groupBy('tanggal')->map(function ($items) {
            return [
                'pagi' => $items->where('nama_shift', 'Pagi')->pluck('nama_karyawan')->toArray(),
                'sore' => $items->where('nama_shift', 'Sore')->pluck('nama_karyawan')->toArray(),
                'malam' => $items->where('nama_shift', 'Malam')->pluck('nama_karyawan')->toArray(),
            ];
        });

        return view('manageAbsensi.index', compact('absensiData', 'month'));
    }

    public function edit($tanggal)
    {
        // Mengambil jadwal untuk tanggal tertentu beserta shift dan karyawan yang terdaftar
        $jadwal = Jadwal::with(['shift', 'karyawan'])
                        ->where('tanggal', $tanggal)
                        ->get();

        // Jika tidak ada jadwal untuk tanggal tersebut
        if ($jadwal->isEmpty()) {
            return redirect()->route('manageAbsensi.index')
                ->with('error', 'Data jadwal tidak ditemukan untuk tanggal tersebut.');
        }

        // Mengambil data karyawan dan shift untuk dropdown
        $karyawans = Karyawan::all();
        $shifts = Shift::all();

        // Kirim data ke view untuk form edit
        return view('manageAbsensi.edit', compact('jadwal', 'karyawans', 'shifts', 'tanggal'));
    }

    public function update(Request $request, $tanggal)
    {
        // Validasi input
        $request->validate([
            'jadwal' => 'required|array',
            'jadwal.*.id_shift'    => 'required|exists:shifts,id',
        ]);

        // Update data jadwal per tanggal
        foreach ($request->jadwal as $id => $data) {
            // Cari jadwal berdasarkan ID dan update shift yang dipilih
            Jadwal::where('id', $id)->update([
                'id_shift' => $data['id_shift'],
            ]);
        }

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('manageAbsensi.index')
            ->with('success', 'Data jadwal berhasil diperbarui.');
    }
}

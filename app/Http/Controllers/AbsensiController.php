<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // Menampilkan semua data absensi
    public function index()
    {
        $tanggal = request('tanggal', now()->format('Y-m-d'));
        $absensiData = Absensi::with('karyawan')->where('tanggal', $tanggal)->get();

        return view('absensi.index', compact('absensiData', 'tanggal'));
    }

    // Menampilkan form tambah absensi
    public function create()
    {
        $karyawans = Karyawan::all();
        return view('absensi.create', compact('karyawans'));
    }

    // Menyimpan data absensi
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'nullable|after:jam_masuk',
            'status_hadir' => 'required|in:Hadir,Sakit,Izin,Alpa',
        ]);

        $masuk = new \DateTime($request->jam_masuk);
        $keluar = new \DateTime($request->jam_keluar);

        $jam_masuk = $masuk->format('H:i:s');
        $jam_keluar = $keluar->format('H:i:s');

        Absensi::create([
            'id_karyawan' => $request->id_karyawan,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $jam_masuk,
            'jam_keluar' => $jam_keluar,
            'status_hadir' => $request->status_hadir,
        ]);

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil ditambahkan.');
    }

    // Menampilkan form edit absensi
    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        $karyawans = Karyawan::all();
        return view('absensi.edit', compact('absensi', 'karyawans'));
    }

    // Mengupdate data absensi
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i:s',
            'jam_keluar' => 'nullable|date_format:H:i:s|after:jam_masuk',
            'status_hadir' => 'required|in:Hadir,Sakit,Izin,Alpa',
        ]);

        // Cari absensi yang ingin di-update
        $absensi = Absensi::findOrFail($id);
        $absensi->update($request->all());

        // Redirect ke halaman home atau halaman lain setelah berhasil
        return redirect('/')->with('success', 'Data absensi berhasil diperbarui.');
    }


    // Menghapus data absensi
    public function destroy($id)
    {
        Absensi::destroy($id);
        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil dihapus.');
    }
}

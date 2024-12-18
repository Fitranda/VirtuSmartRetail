<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\Karyawan;
use App\Models\Absensi;
use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    public function index()
    {
        $penggajian = Penggajian::with('karyawan')->get();
        return view('penggajian.index', compact('penggajian'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        foreach ($karyawans as $key => $karyawan) {
            $karyawans[$key]['absen'] = Absensi::where('id_karyawan', $karyawan->id_karyawan)
                              ->whereMonth('tanggal', date('m'))
                              ->whereYear('tanggal', date('Y'))
                              ->count();
        }
        return view('penggajian.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'tanggal' => 'required|date',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ]);

        // Calculate total salary based on attendance
        $absensi = Absensi::where('id_karyawan', $request->id_karyawan)
                          ->whereMonth('tanggal', date('m', strtotime($request->tanggal)))
                          ->whereYear('tanggal', date('Y', strtotime($request->tanggal)))
                          ->get();

        $total_gaji = $request->gaji_pokok + ($request->tunjangan ?? 0) - ($request->potongan ?? 0);

        Penggajian::create([
            'id_karyawan' => $request->id_karyawan,
            'tanggal' => $request->tanggal,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan ?? 0,
            'potongan' => $request->potongan ?? 0,
            'total_gaji' => $total_gaji,
        ]);

        return redirect()->route('penggajian.index')->with('success', 'Penggajian berhasil ditambahkan.');
    }

    public function edit(Penggajian $gaji)
    {
        $karyawans = Karyawan::all();
        return view('penggajian.edit', compact('gaji', 'karyawans'));
    }

    public function update(Request $request, Penggajian $gaji)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'tanggal' => 'required|date',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ]);

        // Calculate total salary based on attendance
        $absensi = Absensi::where('id_karyawan', $request->id_karyawan)
                          ->whereMonth('tanggal', date('m', strtotime($request->tanggal)))
                          ->whereYear('tanggal', date('Y', strtotime($request->tanggal)))
                          ->get();

        $total_gaji = $request->gaji_pokok + ($request->tunjangan ?? 0) - ($request->potongan ?? 0);

        $gaji->update([
            'id_karyawan' => $request->id_karyawan,
            'tanggal' => $request->tanggal,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan ?? 0,
            'potongan' => $request->potongan ?? 0,
            'total_gaji' => $total_gaji,
        ]);

        return redirect()->route('penggajian.index')->with('success', 'Penggajian berhasil diperbarui.');
    }

    public function destroy(Penggajian $gaji)
    {
        $gaji->delete();

        return redirect()->route('penggajian.index')->with('success', 'Penggajian berhasil dihapus.');
    }
}

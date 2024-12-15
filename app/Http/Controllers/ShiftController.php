<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Karyawan; // Tambahkan model Karyawan
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    // Menampilkan daftar shift
    public function index()
    {
        // Ambil data shift beserta relasi karyawan
        $shifts = Shift::with('karyawan')->get();
        return view('shift.index', compact('shifts'));
    }

    // Menampilkan form untuk membuat shift
    public function create()
    {
        // Ambil data karyawan untuk penempatan shift
        $karyawans = Karyawan::all();
        return view('shift.create', compact('karyawans'));
    }

    // Menyimpan data shift baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_shift' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'karyawan' => 'nullable|array', // Karyawan bisa lebih dari satu
            'karyawan.*' => 'exists:karyawan,id', // Validasi bahwa setiap karyawan ada di tabel karyawan
        ]);

        // Membuat shift baru
        $shift = Shift::create($request->only(['nama_shift', 'jam_mulai', 'jam_selesai']));

        // Menambahkan relasi karyawan dengan shift
        if ($request->filled('karyawan')) {
            $shift->karyawan()->sync($request->karyawan); // Menyinkronkan karyawan yang dipilih ke shift
        }

        return redirect()->route('shift.index')->with('success', 'Shift berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit shift
    public function edit(Shift $shift)
    {
        $karyawans = Karyawan::all();
        return view('shift.edit', compact('shift', 'karyawans'));
    }

    // Mengupdate data shift
    public function update(Request $request, Shift $shift)
    {
        $request->validate([
            'nama_shift' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'karyawan' => 'nullable|array', // Karyawan bisa lebih dari satu
            'karyawan.*' => 'exists:karyawan,id', // Validasi bahwa setiap karyawan ada di tabel karyawan
        ]);

        // Mengupdate data shift
        $shift->update($request->only(['nama_shift', 'jam_mulai', 'jam_selesai']));

        // Menambahkan atau mengupdate relasi karyawan dengan shift
        if ($request->filled('karyawan')) {
            $shift->karyawan()->sync($request->karyawan); // Menyinkronkan karyawan yang dipilih ke shift
        }

        return redirect()->route('shift.index')->with('success', 'Shift berhasil diperbarui');
    }

    // Menghapus shift
    public function destroy(Shift $shift)
    {
        // Hapus relasi shift dari karyawan sebelum menghapus shift
        $shift->karyawan()->detach(); // Menghapus semua relasi karyawan pada shift ini
        $shift->delete();

        return redirect()->route('shift.index')->with('success', 'Shift berhasil dihapus');
    }
}

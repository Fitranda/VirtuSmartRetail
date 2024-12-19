<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class KaryawanController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        // Ambil data karyawan
        $karyawan = Karyawan::all();

        // Kirim data role dan karyawan ke view
        return view('karyawan.index', compact('role', 'karyawan'));
    }





    // Menampilkan form tambah karyawan
    public function create()
    {
        $role = Auth::user()->role;
        return view('karyawan.create', compact('role')); // Mengirim data role ke view
    }


    // Menyimpan karyawan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'posisi' => 'required',
            'gaji_pokok' => 'required|numeric',
            'username' => 'required|unique:karyawan,username',
            'email' => 'required|email|unique:karyawan,email',
            'password' => 'required|min:6',
        ]);

        Karyawan::create([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'gaji_pokok' => $request->gaji_pokok,
            'id_shift' => $request->id_shift,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'id_role' => 3,
            'id_shift' => 1,
            'status' => 1,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    // Menampilkan form edit karyawan
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.edit', compact('karyawan'));
    }

    // Mengupdate data karyawan
    public function update(Request $request, $id)
    {

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'gaji_pokok' => $request->gaji_pokok,
            'id_shift' => $request->id_shift,
            'username' => $request->username,
            'email' => $request->email,
            'id_role' => 1,
            'id_shift' => 1,
            'status' => 1,
            'password' => $request->password ? bcrypt($request->password) : $karyawan->password,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    // Menghapus karyawan
    public function destroy($id)
    {
        Karyawan::destroy($id);
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}

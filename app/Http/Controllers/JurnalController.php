<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Akun;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        $jurnals = Jurnal::with('akun')->get();
        return view('jurnals.index', compact('jurnals'));
    }

    public function create()
    {
        $akuns = Akun::all();
        return view('jurnals.create', compact('akuns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_akun' => 'required',
            'tanggal_jurnal' => 'required|date',
            'debet' => 'required|numeric',
            'kredit' => 'required|numeric',
        ]);

        Jurnal::create($request->all());

        return redirect()->route('jurnals.index')->with('success', 'Jurnal berhasil ditambahkan.');
    }

    public function edit(Jurnal $jurnal)
    {
        $akuns = Akun::all();
        return view('jurnals.edit', compact('jurnal', 'akuns'));
    }

    public function update(Request $request, Jurnal $jurnal)
    {
        $request->validate([
            'id_akun' => 'required',
            'tanggal_jurnal' => 'required|date',
            'debet' => 'required|numeric',
            'kredit' => 'required|numeric',
        ]);

        $jurnal->update($request->all());

        return redirect()->route('jurnals.index')->with('success', 'Jurnal berhasil diperbarui.');
    }

    public function destroy(Jurnal $jurnal)
    {
        $jurnal->delete();

        return redirect()->route('jurnals.index')->with('success', 'Jurnal berhasil dihapus.');
    }
}

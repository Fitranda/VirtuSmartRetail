<?php

namespace App\Http\Controllers;

use App\Models\ManageAbsensi;
use App\Models\Karyawan;
use App\Models\Shift;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ManageAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
        $daysInMonth = Carbon::parse($month)->daysInMonth;

        $dates = collect();
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dates->push(Carbon::parse("$month-" . str_pad($day, 2, '0', STR_PAD_LEFT))->format('Y-m-d'));
        }

        $manageAbsensis = ManageAbsensi::with('karyawan', 'shift')
            ->where('tanggal', 'like', "$month%")
            ->get()
            ->groupBy('tanggal');

        $absensiData = $dates->mapWithKeys(function ($date) use ($manageAbsensis) {
            $shifts = $manageAbsensis->get($date, collect());
            return [$date => [
                'pagi' => $shifts->where('id_shift', 1)->pluck('karyawan.nama')->toArray(),
                'siang' => $shifts->where('id_shift', 2)->pluck('karyawan.nama')->toArray(),
                'malam' => $shifts->where('id_shift', 3)->pluck('karyawan.nama')->toArray(),
            ]];
        });

        return view('manageAbsensi.index', compact('month', 'absensiData'));
    }

    public function edit($tanggal)
    {
        try {
            $tanggalInput = Carbon::createFromFormat('Y-m-d', $tanggal);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Format tanggal tidak valid.']);
        }

        $absensi = ManageAbsensi::where('tanggal', $tanggalInput)->first();
        $karyawans = Karyawan::all();
        $shifts = Shift::all();

        if (!$absensi) {
            return redirect()->back()->withErrors(['error' => 'Absensi tidak ditemukan untuk tanggal ini.']);
        }

        return view('manage_absensi.edit', compact('absensi', 'karyawans', 'shifts'));
    }

    public function update(Request $request, $tanggal)
    {
        $tanggalInput = Carbon::createFromFormat('Y-m-d', $tanggal);

        $request->validate([
            'id_karyawan' => 'required|exists:karyawans,id',
            'id_shift' => 'required|exists:shifts,id',
        ]);

        $tanggalSekarang = Carbon::now();
        if ($tanggalInput->gt($tanggalSekarang)) {
            return redirect()->back()->withErrors(['error' => 'Tidak dapat mengedit absensi di masa depan.']);
        }

        $absensi = ManageAbsensi::where('tanggal', $tanggalInput)->first();
        if (!$absensi) {
            return redirect()->back()->withErrors(['error' => 'Absensi tidak ditemukan untuk tanggal ini.']);
        }

        $absensi->update([
            'id_karyawan' => $request->id_karyawan,
            'id_shift' => $request->id_shift,
        ]);

        return redirect()->route('manageAbsensi.index')->with('success', 'Absensi berhasil diperbarui.');
    }

    public function destroy($id_karyawan)
    {
        $karyawan = Karyawan::find($id_karyawan);

        if (!$karyawan) {
            return redirect()->back()->withErrors(['error' => 'Karyawan tidak ditemukan.']);
        }

        ManageAbsensi::where('id_karyawan', $id_karyawan)->delete();

        return redirect()->route('manageAbsensi.index')->with('success', 'Data absensi karyawan berhasil dihapus.');
    }
}

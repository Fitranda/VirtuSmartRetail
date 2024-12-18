@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Edit Absensi</h1>

        <form action="{{ route('absensi.update', $absensi->id_absensi) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="id_karyawan" class="form-label">Karyawan</label>
                <select name="id_karyawan" id="id_karyawan" class="form-control" aria-label="Pilih Karyawan" required>
                    <option value="" disabled selected>Pilih Karyawan</option>
                    @foreach($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}" 
                            {{ $absensi->id_karyawan == $karyawan->id ? 'selected' : '' }}>
                            {{ $karyawan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" 
                       name="tanggal" 
                       id="tanggal" 
                       class="form-control" 
                       value="{{ $absensi->tanggal }}" 
                       aria-label="Tanggal Absensi" 
                       required>
            </div>

            <div class="mb-3">
                <label for="jam_masuk" class="form-label">Jam Masuk</label>
                <input type="time" 
                       name="jam_masuk" 
                       id="jam_masuk" 
                       class="form-control" 
                       value="{{ $absensi->jam_masuk }}" 
                       aria-label="Jam Masuk" 
                       required>
            </div>

            <div class="mb-3">
                <label for="jam_keluar" class="form-label">Jam Keluar</label>
                <input type="time" 
                       name="jam_keluar" 
                       id="jam_keluar" 
                       class="form-control" 
                       value="{{ $absensi->jam_keluar }}" 
                       aria-label="Jam Keluar" 
                       required>
            </div>

            <div class="mb-3">
                <label for="status_hadir" class="form-label">Status Hadir</label>
                <select name="status_hadir" id="status_hadir" class="form-control" aria-label="Status Kehadiran" required>
                    <option value="Hadir" {{ $absensi->status_hadir == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="Tidak Hadir" {{ $absensi->status_hadir == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

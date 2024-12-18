@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Tambah Absensi</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('absensi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_karyawan">Pilih Karyawan:</label>
            <select name="id_karyawan" class="form-control" required>
                <option value="">--Pilih Karyawan--</option>
                @foreach($karyawans as $karyawan)
                    <option value="{{ $karyawan->id_karyawan }}">{{ $karyawan->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="jam_masuk">Jam Masuk:</label>
            <input type="time" name="jam_masuk" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="jam_keluar">Jam Keluar:</label>
            <input type="time" name="jam_keluar" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status_hadir">Status Hadir:</label>
            <select name="status_hadir" class="form-control" required>
                <option value="Hadir">Hadir</option>
                <option value="Izin">Tidak Hadir</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

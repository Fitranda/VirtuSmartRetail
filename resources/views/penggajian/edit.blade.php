@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Penggajian</h1>
    <form action="{{ route('penggajian.update', $gaji->id_penggajian) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_karyawan">Karyawan</label>
            <select class="form-control" id="id_karyawan" name="id_karyawan" required>
                @foreach($karyawans as $karyawan)
                <option value="{{ $karyawan->id_karyawan }}" {{ $gaji->id_karyawan == $karyawan->id_karyawan ? 'selected' : '' }}>{{ $karyawan->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $gaji->tanggal }}" required>
        </div>
        <div class="form-group">
            <label for="gaji_pokok">Gaji Pokok</label>
            <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" value="{{ $gaji->gaji_pokok }}" required>
        </div>
        <div class="form-group">
            <label for="tunjangan">Tunjangan</label>
            <input type="number" class="form-control" id="tunjangan" name="tunjangan" value="{{ $gaji->tunjangan }}">
        </div>
        <div class="form-group">
            <label for="potongan">Potongan</label>
            <input type="number" class="form-control" id="potongan" name="potongan" value="{{ $gaji->potongan }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

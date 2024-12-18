@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Jurnal</h1>
    <form action="{{ route('jurnals.update', $jurnal->id_jurnal) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_akun">Akun</label>
            <select class="form-control" id="id_akun" name="id_akun" required>
                @foreach($akuns as $akun)
                <option value="{{ $akun->id_akun }}" {{ $jurnal->id_akun == $akun->id_akun ? 'selected' : '' }}>{{ $akun->nama_akun }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_jurnal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal_jurnal" name="tanggal_jurnal" value="{{ $jurnal->tanggal_jurnal }}" required>
        </div>
        <div class="form-group">
            <label for="debet">Debet</label>
            <input type="number" class="form-control" id="debet" name="debet" value="{{ $jurnal->debet }}" required>
        </div>
        <div class="form-group">
            <label for="kredit">Kredit</label>
            <input type="number" class="form-control" id="kredit" name="kredit" value="{{ $jurnal->kredit }}" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan">{{ $jurnal->keterangan }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

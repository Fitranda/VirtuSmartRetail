@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Jurnal</h1>
    <a href="{{ route('jurnals.create') }}" class="btn btn-primary">Tambah Jurnal</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Akun</th>
                <th>Tanggal</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurnals as $jurnal)
            <tr>
                <td>{{ $jurnal->id_jurnal }}</td>
                <td>{{ $jurnal->akun->nama_akun }}</td>
                <td>{{ $jurnal->tanggal_jurnal }}</td>
                <td>{{ $jurnal->debet }}</td>
                <td>{{ $jurnal->kredit }}</td>
                <td>{{ $jurnal->keterangan }}</td>
                <td>
                    <a href="{{ route('jurnals.edit', $jurnal->id_jurnal) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('jurnals.destroy', $jurnal->id_jurnal) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

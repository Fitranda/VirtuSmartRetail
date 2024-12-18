@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Penggajian</h1>
    <a href="{{ route('penggajian.create') }}" class="btn btn-primary">Tambah Penggajian</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Tanggal</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penggajian as $gaji)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $gaji->karyawan->nama }}</td>
                <td>{{ $gaji->tanggal }}</td>
                <td>{{ $gaji->gaji_pokok }}</td>
                <td>{{ $gaji->tunjangan }}</td>
                <td>{{ $gaji->potongan }}</td>
                <td>{{ $gaji->total_gaji }}</td>
                <td>
                    {{-- <a href="{{ route('penggajian.edit', $gaji->id_penggajian) }}" class="btn btn-warning">Edit</a> --}}
                    <form action="{{ route('penggajian.destroy', $gaji->id_penggajian) }}" method="POST" style="display:inline;">
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

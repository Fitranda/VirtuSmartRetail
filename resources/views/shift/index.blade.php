@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Shift</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-4">
        <!-- Tombol untuk tambah transaksi -->
        <a href="{{ route('shift.create') }}" class="btn btn-primary">Tambah Transaksi</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Shift</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Karyawan yang Ditugaskan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($shifts as $index => $shift)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $shift->nama_shift }}</td>
                    <td>{{ $shift->jam_mulai }}</td>
                    <td>{{ $shift->jam_selesai }}</td>
                    <td>
                        @if ($shift->karyawan->count() > 0)
                            <ul>
                                @foreach ($shift->karyawan as $karyawan)
                                    <li>{{ $karyawan->nama }}</li> {{-- Pastikan kolom 'nama' sesuai dengan tabel karyawan --}}
                                @endforeach
                            </ul>
                        @else
                            <span>Belum Ada Karyawan</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('shift.edit', $shift->id_shift) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('shift.destroy', $shift->id_shift) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus shift ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada shift</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

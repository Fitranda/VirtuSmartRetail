@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Daftar Absensi Karyawan</h2>

    <!-- Error handling -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Filter Tanggal -->
    <form action="{{ route('absensi.index') }}" method="GET">
        <div class="form-group mb-4">
            <label for="tanggal"><strong>Pilih Tanggal:</strong></label>
            <input type="date" name="tanggal" class="form-control w-25" value="{{ $tanggal }}" onchange="this.form.submit()">
        </div>
    </form>

    <!-- Tombol Tambah Absensi -->
    <div class="mb-4">
        <a href="{{ route('absensi.create') }}" class="btn btn-primary">Tambah Absensi</a>
    </div>

    <!-- Tabel Absensi -->
    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Absensi Karyawan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Status Hadir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absensiData as $absensi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $absensi->karyawan->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</td>
                                <td>{{ $absensi->jam_masuk }}</td>
                                <td>{{ $absensi->jam_keluar ?? '-' }}</td>
                                <td>{{ ucfirst($absensi->status_hadir) }}</td>
                                <td>
                                    <a href="{{ route('absensi.edit', $absensi->id_absensi) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('absensi.destroy', $absensi->id_absensi) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data absensi untuk tanggal ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

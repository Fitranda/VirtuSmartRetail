@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 text-gray-800">Manajemen Absensi</h1>
    </div>

    <!-- Form Pilih Bulan dan Tahun -->
    <div class="mb-4">
        <form method="GET" action="{{ route('manageAbsensi.index') }}" class="form-inline">
            <label for="month" class="mr-2">Pilih Bulan dan Tahun:</label>
            <input 
                type="month" 
                id="month" 
                name="month" 
                class="form-control mr-2" 
                value="{{ request('month', now()->format('Y-m')) }}" 
                onchange="this.form.submit()">
        </form>
    </div>

    <!-- Tabel Jadwal -->
    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Jadwal</h6>
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Shift Pagi</th>
                            <th>Shift sore</th>
                            <th>Shift Malam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($absensiData as $tanggal => $shifts)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</td>

                                <!-- Shift Pagi -->
                                <td>
                                    @if (!empty($shifts['pagi']))
                                        {{ implode(', ', $shifts['pagi']) }}
                                    @else
                                        <span class="text-muted">Tidak ada data</span>
                                    @endif
                                </td>

                                <!-- Shift sore -->
                                <td>
                                    @if (!empty($shifts['sore']))
                                        {{ implode(', ', $shifts['sore']) }}
                                    @else
                                        <span class="text-muted">Tidak ada data</span>
                                    @endif
                                </td>

                                <!-- Shift Malam -->
                                <td>
                                    @if (!empty($shifts['malam']))
                                        {{ implode(', ', $shifts['malam']) }}
                                    @else
                                        <span class="text-muted">Tidak ada data</span>
                                    @endif
                                </td>

                                <!-- Tombol Aksi -->
                                <td>
                                    <a href="{{ route('manageAbsensi.edit', $tanggal) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data absensi untuk bulan ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

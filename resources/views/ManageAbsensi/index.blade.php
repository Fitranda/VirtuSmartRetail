@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h1 class="h3 text-gray-800">Manajemen Absensi</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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

        <!-- Tabel Absensi -->
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Absensi</h6>
            </div>
            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Shift Pagi</th>
                                <th>Shift Siang</th>
                                <th>Shift Malam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($absensiData as $tanggal => $shifts)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</td>
                                    <td>
                                        @if (!empty($shifts['pagi']))
                                            {{ implode(', ', $shifts['pagi']) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($shifts['siang']))
                                            {{ implode(', ', $shifts['siang']) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($shifts['malam']))
                                            {{ implode(', ', $shifts['malam']) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('manageAbsensi.edit', $tanggal) }}" 
                                               class="btn btn-sm btn-warning mr-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('manageAbsensi.destroy', $tanggal) }}" 
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus absensi ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($absensiData->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data absensi untuk bulan ini</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

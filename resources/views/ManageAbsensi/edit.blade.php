@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 text-gray-800">Manajemen Absensi - Edit Jadwal</h1>
    </div>

    <!-- Form Edit Jadwal -->
    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Jadwal untuk Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</h6>
        </div>
        <div class="card-body" style="max-height: 500px; overflow-y: auto;">
            <form action="{{ route('manageAbsensi.update', $tanggal) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Tabel Karyawan dan Shift -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Pilih Shift</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($jadwal as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->karyawan->nama }}</td>
                                    <td>
                                        <select name="jadwal[{{ $item->id }}][id_shift]" class="form-control">
                                            @foreach ($shifts as $shift)
                                                <option value="{{ $shift->id }}" 
                                                    @if ($item->id_shift == $shift->id) selected @endif>
                                                    {{ $shift->nama_shift }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Tombol Update -->
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

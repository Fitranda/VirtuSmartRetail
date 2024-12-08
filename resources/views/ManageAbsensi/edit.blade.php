@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h1 class="h3 text-gray-800">Edit Absensi</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('manageAbsensi.update', $absensi->tanggal) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="id_karyawan">Karyawan</label>
                <select name="id_karyawan" id="id_karyawan" class="form-control">
                    @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}" 
                            {{ old('id_karyawan', $absensi->id_karyawan) == $karyawan->id ? 'selected' : '' }}>
                            {{ $karyawan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_shift">Shift</label>
                <select name="id_shift" id="id_shift" class="form-control">
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}" 
                            {{ old('id_shift', $absensi->id_shift) == $shift->id ? 'selected' : '' }}>
                            {{ $shift->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection

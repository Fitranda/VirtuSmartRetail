@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Penggajian</h1>
    <form action="{{ route('penggajian.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_karyawan">Karyawan</label>
            <select class="form-control" id="id_karyawan" name="id_karyawan" required>
                @foreach($karyawans as $karyawan)
                <option value="{{ $karyawan->id_karyawan }}" data-gaji="{{ $karyawan->gaji_pokok }}">{{ $karyawan->nama }} , Masuk : {{ $karyawan->absen }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" readonly required>
        </div>
        <div class="form-group">
            <label for="gaji_pokok">Gaji Pokok</label>
            <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" required readonly>
        </div>
        <div class="form-group">
            <label for="tunjangan">Tunjangan</label>
            <input type="number" class="form-control" id="tunjangan" name="tunjangan">
        </div>
        <div class="form-group">
            <label for="potongan">Potongan</label>
            <input type="number" class="form-control" id="potongan" name="potongan">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@push('scripts')
<script>

    document.addEventListener('DOMContentLoaded', function () {
        console.log("Masukasg");
        const karyawanSelect = document.getElementById('id_karyawan');
        const gajiPokokInput = document.getElementById('gaji_pokok');

        karyawanSelect.addEventListener('change', function () {
            const selectedOption = karyawanSelect.options[karyawanSelect.selectedIndex];
            const gajiPokok = selectedOption.getAttribute('data-gaji');
            console.log(gajiPokok,"Masuk");
            gajiPokokInput.value = gajiPokok ? gajiPokok : '';
        });

        karyawanSelect.dispatchEvent(new Event('change'));
    });
</script>
@endpush
@endsection

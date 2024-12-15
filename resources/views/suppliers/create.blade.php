@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Supplier</h1>
    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_supplier">Nama Supplier</label>
            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

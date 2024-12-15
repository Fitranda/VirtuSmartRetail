@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Supplier</h1>
    <form action="{{ route('suppliers.update', $supplier->id_supplier) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_supplier">Nama Supplier</label>
            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{ $supplier->nama_supplier }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $supplier->alamat }}" required>
        </div>
        <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $supplier->kontak }}" required>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Ubah
        </button>
    </form>
</div>
@endsection

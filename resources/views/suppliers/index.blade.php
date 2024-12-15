@extends('layouts.admin')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success mt-3" id="success-alert">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
            document.getElementById('success-alert').style.display = 'none';
            }, 2000);
        </script>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mt-3" id="error-alert">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(function() {
            document.getElementById('error-alert').style.display = 'none';
            }, 2000);
        </script>
    @endif
    <h1>Daftar Supplier</h1>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Supplier
    </a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $supplier->nama_supplier }}</td>
                <td>{{ $supplier->alamat }}</td>
                <td>{{ $supplier->kontak }}</td>
                <td>
                    <a href="{{ route('suppliers.edit', $supplier->id_supplier) }}" class="btn btn-warning">
                        <i class="fas fa-edit" style="font-size: 0.8em;"></i>
                    </a>
                    <form action="{{ route('suppliers.destroy', $supplier->id_supplier) }}" method="DELEte" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')">
                            <i class="fas fa-trash-alt" style="font-size: 0.8em;"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

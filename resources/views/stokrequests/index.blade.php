@extends('layouts.admin')

@section('content')
<div class="container">
    @if(session('error'))
        <div class="alert alert-danger" id="error-alert">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('error-alert').style.display = 'none';
            }, 3000);
        </script>
    @endif
    @if(session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
    @endif
    <h1 class="text-center">Pengajuan Stock</h1>
    <a href="{{ route('stokrequests.create') }}" class="btn btn-primary" style="margin: 15px 0;">
        <i class="fas fa-plus"></i> Tambah Pengajuan Stock
    </a>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" id="stockRequestsTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stokRequests as $request)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $request->nama_produk }}</td>
                        <td>{{ $request->jumlah }}</td>
                        <td>{{ date('d F Y', strtotime($request->tanggal_pengajuan)) }}</td>
                        <td>{{ $request->status }}</td>
                        <td>
                            {{-- <a href="{{ route('stokrequests.edit', $request->id_request) }}" class="btn btn-primary">Edit</a> --}}
                            <form action="{{ route('stokrequests.destroy', $request->id_request) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('#stockRequestsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
    </script>
@endpush
@endsection

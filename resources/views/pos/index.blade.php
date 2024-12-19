@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Daftar Transaksi</h1>

        <!-- Error Handling -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tombol Tambah Transaksi -->
        <div class="mb-4 text-right">
            <a href="{{ route('pos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Transaksi
            </a>
        </div>

        <!-- Tabel Daftar Transaksi -->
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal Transaksi</th>
                    <th>Pelanggan</th>
                    <th>Total Produk</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $index => $trx)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            @if ($trx->tanggal_penjualan)
                                {{ \Carbon\Carbon::parse($trx->tanggal_penjualan)->format('Y-m-d H:i:s') }}
                            @else
                                <span>Tanggal tidak tersedia</span>
                            @endif
                        </td>
                        <td>{{ $trx->pelanggan ? $trx->pelanggan->nama_pelanggan : 'Bukan Member' }}</td>
                        <td>{{ $trx->detailPenjualan->count() }} Produk</td>
                        <td>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <!-- Tombol Edit -->
                            {{-- <a href="{{ route('pos.edit', $trx->id_penjualan) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a> --}}

                            <!-- Tombol Cetak Struk -->
                            <a href="{{ route('pos.struk', $trx->id_penjualan) }}" class="btn btn-info btn-sm"
                                target="_blank">
                                <i class="fas fa-print"></i> Cetak Struk
                            </a>

                            <!-- Tombol Delete -->
                            <form action="{{ route('pos.destroy', $trx->id_penjualan) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada transaksi tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

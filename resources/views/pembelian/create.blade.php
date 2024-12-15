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
    <form action="{{ route('savebeli') }}" class="" method="POST">
        @csrf
        <h4 style="text-align: center">Pembelian</h4>
        <div class="row" style="margin-top:20px">
            <div class="col-md-6">
                <div class="form-group row align-items-center">
                    <label class="form-label col-md-3 label-form" for="no_faktur">No. Faktur</label>
                    <div class="form-control-wrap col-md-9">
                        <input type="text" class="form-control" id="no_faktur" name="no_faktur" placeholder="No. Faktur" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="nk-block-head">
                    <div class="form-group row align-items-center">
                        <label class="form-label col-md-3 label-form" for="supplier_id">Supplier</label>
                        <div class="form-control-wrap col-md-9">
                            <select class="form-select form-control form-control-lg" id="supplier_id" name="supplier_id" data-search="on" data-placeholder="Pilih Supplier" required>
                                <option label="empty" value=""></option>
                                @foreach ($suppliers as $key => $item)
                                    <option value="{{ $item['id_supplier'] }}">{{ $item['nama_supplier'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:20px">
            <div class="col-md-6">
                <div class="form-group row align-items-center">
                    <label class="form-label col-md-3 label-form" for="tanggal">Tanggal </label>
                    <div class="form-control-wrap col-md-9">
                        <div class="form-icon form-icon-left">
                            <em class="icon ni ni-calendar"></em>
                        </div>
                        <input type="date" class="form-control date-picker" id="tanggal" name="tanggal" data-date-format="dd MM yyyy" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:40px">
            <div class="col-md-6">
                <a href="{{ route('produk') }}"class="btn btn-md btn-primary"><em class="icon ni ni-plus"></em>Produk</span></a>
                <a href="{{ route('reset') }}" class="btn btn-md btn-secondary" style="margin: 0 10px"><em class="icon ni ni-reload"></em><span>Reset</span></a>
                <button type="submit" class="btn btn-md btn-success"><em class="icon ni ni-check-thick"></em><span>Simpan</span></button>
            </div>
            <div class="col-md-6 align-items-lg-end">
                <label id="total-akhir" style="width:100%;font-size: 30px; text-align:right">{{ number_format($total, 2, ',', '.') }}</label>
            </div>
        </div>

        <div class="row" style="margin-top:20px">
            <div class="col-md-12">
                <table class="datatable-init nk-tb-list nk-tb-ulist table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 5%">Action</th>
                            <th style="width: 20%">Nama Produk</th>
                            <th style="width: 5%">Jumlah</th>
                            <th style="width: 13%">Harga Beli</th>
                            <th style="width: 13%">Total</th>
                            <th style="width: 14%">Harga Jual</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($cart_beli as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger hapus" value="{{ $item['id'] }}"><i class="fas fa-trash"></i></button>
                            </td>
                            <td>{{ $item['nama_barang'] }}</td>
                            <td>
                                <input type="number" class="form-control jumlah" name="jumlah[{{ $item['id'] }}]" value="{{ $item['jumlah'] }}" min="1" required>
                            </td>
                            <td>
                                <input type="number" class="form-control harga" name="harga[{{ $item['id'] }}]" value="{{ $item['harga'] }}" step="0.01" required>
                            </td>
                            <td>{{ number_format($item['total'], 2, ',', '.') }}</td>
                            <td>
                                <input type="number" class="form-control harga_jual" name="harga_jual[{{ $item['id'] }}]" value="{{ $item['harga_jual'] }}" step="0.01" required>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
@push('scripts')
<script>
    function showSpinner() {
        var spinner = document.createElement('div');
        spinner.className = 'spinner-border text-primary';
        spinner.role = 'status';
        var spinnerText = document.createElement('span');
        spinnerText.className = 'sr-only';
        spinnerText.innerText = 'Loading...';
        spinner.appendChild(spinnerText);
        document.body.appendChild(spinner);
    }

    function hideSpinner() {
        var spinner = document.querySelector('.spinner-border');
        if (spinner) {
        spinner.remove();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.hapus').forEach(function(button) {
            button.addEventListener('click', function() {
                showSpinner();
                var itemId = this.value;
                if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                    // Perform the delete action, e.g., send an AJAX request to delete the item
                    // For example:
                    fetch('{{ route('remove.from.session') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ id: itemId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Gagal menghapus item.');
                        }
                    })
                    .catch(error => console.error('Error:', error))
                    .finally(() => hideSpinner());
                }
            });
        });

        document.querySelectorAll('.jumlah').forEach(function(input) {
            input.addEventListener('change', function() {
                showSpinner();
            var itemId = this.name.match(/\d+/)[0];
            var newJumlah = this.value;
            // Perform the update action, e.g., send an AJAX request to update the item quantity
            fetch('{{ route('ubahcart') }}', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: itemId, jumlah: newJumlah })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                location.reload();
                } else {
                    hideSpinner();
                alert('Gagal mengubah jumlah.');
                }
            })
            .catch(error => console.error('Error:', error))
            .finally(() => hideSpinner());
            });
        });


        document.querySelectorAll('.harga').forEach(function(input) {
            input.addEventListener('change', function() {
                showSpinner();
            var itemId = this.name.match(/\d+/)[0];
            var newHarga = this.value;
            // Perform the update action, e.g., send an AJAX request to update the item price
            fetch('{{ route('ubahcart') }}', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: itemId, harga: newHarga })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                location.reload();
                } else {
                alert('Gagal mengubah harga.');
                }
            })
            .catch(error => console.error('Error:', error))
            .finally(() => hideSpinner());
            });
        });

        document.querySelectorAll('.harga_jual').forEach(function(input) {
            input.addEventListener('change', function() {
                showSpinner();
            var itemId = this.name.match(/\d+/)[0];
            var newMargin = this.value;
            // Perform the update action, e.g., send an AJAX request to update the item margin
            fetch('{{ route('ubahcart') }}', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: itemId, margin: newMargin })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                location.reload();
                } else {
                alert('Gagal mengubah margin.');
                }
            })
            .catch(error => console.error('Error:', error))
            .finally(() => hideSpinner());
            });
        });
    });
</script>
@endpush
@endsection

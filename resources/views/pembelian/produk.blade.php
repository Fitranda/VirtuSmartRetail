@extends('layouts.admin')

@section('content')

<div class="container">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    {{-- @php
        var_dump($products);die;
    @endphp --}}
    <h4 class="text-center">Produk</h4>
            <table class="table" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            {{-- <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="id">
                                <label class="custom-control-label" for="id"></label>
                            </div> --}}
                            &nbsp;
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">Nama Barang</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Jumlah Permintaan</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Stok</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Harga Beli</span></th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($products as $product)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" req="{{ $product['id_request'] }}" jml = "{{ $product['jumlah'] }}" class="custom-control-input cek_barang" value="{{ $product['id_produk'] }}" id="barang_{{ $product['id_produk'] }}"  {{ isset($cek[$product['id_produk']]) && $cek[$product['id_produk']] == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="barang_{{ $product['id_produk'] }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <span class="tb-lead">{{ $product["produk"]['nama_produk'] }} <span class="dot dot-success d-md-none ml-1"></span></span>
                            </td>
                            <td class="nk-tb-col">
                                <span class="tb-lead">{{ $product["jumlah"] }} <span class="dot dot-success d-md-none ml-1"></span></span>
                            </td>
                            <td class="nk-tb-col tb-col-mb" data-order="{{ $product["produk"]['stok'] }}">
                                <span class="tb-amount">{{ $product["produk"]['stok'] }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $product["produk"]['harga_beli'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
    <div class="text-right" style="margin-top: 20px;">
        <a href="{{ route('beli') }}" class="btn btn-danger">
            <em class="icon ni ni-arrow-left"></em> Kembali
        </a>
    </div>
</div>
@push('scripts')
<script>
    document.querySelectorAll('.cek_barang').forEach(item => {
        item.addEventListener('change', event => {
            const productId = event.target.value;
            const reqid = event.target.getAttribute('req');
            const jml = event.target.getAttribute('jml');
            console.log('Product ID:', productId, 'Request ID:', reqid, 'Jumlah:', jml);
            if (event.target.checked) {
                fetch('{{ route('add.to.session') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: productId , reqid: reqid, jml: jml})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(data.success);
                    } else {
                        console.error(data.error);
                    }
                });
            } else {
                fetch('{{ route('remove.from.session') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(data.success);
                    } else {
                        console.error(data.error);
                    }
                });
            }
        });
    });
</script>
@endpush
@endsection

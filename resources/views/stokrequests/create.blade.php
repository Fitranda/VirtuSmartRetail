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
    <form action="{{ route('stokrequests.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class="form-group">
                <label for="product_id">Pilih Produk:</label>
                <select class="form-control" id="product_id" name="product_id" required>
                @foreach($produks as $product)
                    <option value="{{ $product->id_produk }}">{{ $product->nama_produk }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="quantity">Jumlah:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


</div>
@endsection

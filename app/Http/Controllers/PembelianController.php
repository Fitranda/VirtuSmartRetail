<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StokRequest;
use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Supplier;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::all();
        return view('pembelian.index', compact('pembelians'));
    }

    public function create()
    {
        $suppliers = Supplier::all()->toArray();
        $cart_beli = session()->get('cart_beli', []);
        $total = array_sum(array_column($cart_beli, 'total'));
        return view('pembelian.create', compact('suppliers', 'cart_beli','total'));
    }

    public function pilihproduk()
    {
        $products = StokRequest::with('produk')->where('status', 'pending')->get()->toArray();

        $cart_beli = session()->get('cart_beli', []);
        $cek = array_column($cart_beli, 'id');
        $cek = array_fill_keys($cek, 1);
        return view('pembelian.produk', compact('products','cek'));
    }

    public function addToSession(Request $request)
    {
        $product = Produk::find($request->id);
        if ($product) {
            session()->push('cart_beli', [
                'id' => $product->id_produk,
                'reqid' => $request->reqid,
                'nama_barang' => $product->nama_produk,
                'stok' => $product->stok,
                'jumlah' => $request->jml,
                'harga' => $product->harga_beli,
                'total' => $request->jml * $product->harga_beli,
                'harga_jual' => $product->harga_jual,
            ]);
            $cart_beli = session()->get('cart_beli', []);
            return response()->json(['success' => 'Product added to session','cart' => $cart_beli]);
        }
        return response()->json(['error' => 'Product not found'], 404);
    }

    public function reset()
    {
        session()->forget('cart_beli');
        return redirect()->route('beli');
    }

    public function removeFromSession(Request $request)
    {
        $cart = session()->get('cart_beli', []);
        foreach ($cart as $key => $item) {
            if ($item['id'] == $request->id) {
                unset($cart[$key]);
                session()->put('cart_beli', $cart);
                return response()->json(['success' => 'Product removed from session']);
            }
        }
        return response()->json(['error' => 'Product not found in session'], 404);
    }

    public function editSession(Request $request)
    {
        $cart = session()->get('cart_beli', []);
        foreach ($cart as $key => $item) {
            if ($item['id'] == $request->id && $request->jumlah > 0 && $request->jumlah != $item['jumlah']) {
                $cart[$key]['jumlah'] = $request->jumlah;
                $cart[$key]['total'] = $request->jumlah * $cart[$key]['harga'];
                session()->put('cart_beli', $cart);
                return response()->json(['success' => 'Product updated in session']);
            }elseif($request->harga > 0 && $request->harga != $item['harga'] && $item['id'] == $request->id){
                $cart[$key]['harga'] = $request->harga;
                $cart[$key]['total'] = $cart[$key]['jumlah'] * $request->harga;
                session()->put('cart_beli', $cart);
                return response()->json(['success' => 'Product updated in session']);
            }elseif($request->margin > 0 && $request->margin != $item['harga_jual'] && $item['id'] == $request->id){
                $cart[$key]['harga_jual'] = $request->margin;
                session()->put('cart_beli', $cart);
                return response()->json(['success' => 'Product updated in session']);
            }
        }
        return response()->json(['error' => 'Product not found in session'], 404);
    }

    public function beli(Request $request)
    {

        if (Pembelian::where('no_faktur', $request->no_faktur)->exists()) {
            return redirect()->route('beli')->with('error', 'No Faktur sudah ada.');
        }

        $cart = session()->get('cart_beli', []);
        if (count($cart) == 0) {
            return redirect()->route('beli')->with('error', 'Pilih product terlebih dahulu.');
        }

        $total = array_sum(array_column($cart, 'total'));

        $pembelian = new Pembelian();
        $pembelian->no_faktur = $request->no_faktur;
        $pembelian->tanggal = date('Y-m-d', strtotime($request->tanggal));
        $pembelian->id_supplier = $request->supplier_id;
        $pembelian->total = $total;
        $pembelian->save();

        foreach ($cart as $item) {
            StokRequest::where('id_request', $item['reqid'])->update(['status' => 'approved']);
            DetailPembelian::create([
                'id' => DetailPembelian::max('id') + 1,
                'id_pembelian' => $pembelian->id_pembelian,
                'id_produk' => $item['id'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga'],
            ]);

            $barang = Produk::find($item['id']);
            if ($barang) {
                $barang->stok += $item['jumlah'];
                $barang->harga_jual = $item['harga_jual'];
                $barang->harga_beli = $item['harga'];
                $barang->save();
            }
        }

        session()->forget('cart_beli');

        return redirect()->route('beli')->with('success', 'Pembelian berhasil');
    }

    public function show(Pembelian $pembelian)
    {
        return view('pembelian.show', compact('pembelian'));
    }

    public function edit(Pembelian $pembelian)
    {
        return view('pembelian.edit', compact('pembelian'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $request->validate([
            'no_faktur' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'status' => 'nullable|string|max:255',
        ]);

        $pembelian->update($request->all());

        return redirect()->route('pembelian.index')->with('success', 'Pembelian updated successfully.');
    }

    public function destroy(Pembelian $pembelian)
    {
        $pembelian->delete();

        return redirect()->route('pembelian.index')->with('success', 'Pembelian deleted successfully.');
    }
}

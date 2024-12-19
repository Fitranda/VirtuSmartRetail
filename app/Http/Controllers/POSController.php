<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\TransaksiPenjualan;
use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use DB;

class POSController extends Controller
{
    /**
     * Tampilkan halaman POS
     */
    public function index()
    {
        // Menampilkan transaksi yang baru saja dibuat
        $transaksi = TransaksiPenjualan::with('detailPenjualan.produk', 'pelanggan')
                                        ->latest() // Mengurutkan berdasarkan tanggal terbaru
                                        // ->take(10) // Misalnya menampilkan hanya 10 transaksi terbaru
                                        ->get();

        return view('pos.index', compact('transaksi'));
    }


    /**
     * Tampilkan form tambah transaksi
     */
    public function create()
    {
        // Ambil produk dan pastikan mengambil harga satuan pada detail penjualan
        $produk = Produk::with(['detailPenjualan' => function ($query) {
            $query->select('id_produk', 'harga_satuan');
        }])->get();

        // Ambil semua pelanggan
        $pelanggan = Pelanggan::all();

        return view('pos.create', compact('produk', 'pelanggan'));
    }


    /**
     * Simpan transaksi
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk', // Pastikan id_produk ada dalam tabel produk
            'jumlah' => 'required|integer|min:1', // Jumlah minimal 1
            'id_pelanggan' => 'nullable|exists:pelanggan,id_pelanggan', // Validasi id_pelanggan jika ada
        ]);

        // Ambil produk yang dipilih
        $produk = Produk::findOrFail($request->id_produk);

        // Cek stok produk, pastikan stok cukup
        if ($produk->stok < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok produk tidak cukup']);
        }

        // Hitung subtotal berdasarkan jumlah
        $harga_satuan = $produk->detailPenjualan->first()->harga_satuan; // Ambil harga satuan dari relasi
        $subtotal = $harga_satuan * $request->jumlah;

        // Simpan transaksi
        $transaksi = new TransaksiPenjualan();
        $transaksi->id_pelanggan = $request->id_pelanggan; // Jika ada pelanggan
        $transaksi->tanggal_penjualan = now();
        $transaksi->total_harga = $subtotal; // Hitung total harga
        $transaksi->save();

        // Tambahkan detail transaksi
        $transaksi->detailPenjualan()->create([
            'id_produk' => $produk->id_produk,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $harga_satuan, // Simpan harga satuan di detail_penjualan
            'subtotal' => $subtotal,
        ]);

        // Kurangi stok produk setelah transaksi
        $produk->decrement('stok', $request->jumlah);

        return redirect()->route('pos.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    /**
     * Tampilkan hasil transaksi
     */
    public function result($id)
    {
        $transaksi = TransaksiPenjualan::with('detailPenjualan.produk')->findOrFail($id);
        return view('pos.result', compact('transaksi'));
    }

    /**
     * Cetak struk transaksi
     */
    public function cetakStruk($id)
    {
        $transaksi = TransaksiPenjualan::with('detailPenjualan.produk')->findOrFail($id);
        return view('pos.struk', compact('transaksi'));
    }

    /**
     * Hapus transaksi
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $transaksi = TransaksiPenjualan::findOrFail($id);

            // Kembalikan stok produk
            foreach ($transaksi->detailPenjualan as $detail) {
                $detail->produk->increment('stok', $detail->jumlah);
            }

            // Hapus detail dan transaksi
            $transaksi->detailPenjualan()->delete();
            $transaksi->delete();

            DB::commit();
            return redirect()->route('pos.index')->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

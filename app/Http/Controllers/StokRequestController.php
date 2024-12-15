<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\StokRequest;

class StokRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stokRequests = StokRequest::join('produk', 'stok_request.id_produk', '=', 'produk.id_produk')
                       ->select('stok_request.*', 'produk.nama_produk')
                       ->get();
        return view('stokrequests.index', compact('stokRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::all();
        return view('stokrequests.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $tanggal_sekarang = now();

        $stokRequest = new StokRequest([
            'id_produk' => $request->get('product_id'),
            'tanggal_pengajuan' => $tanggal_sekarang,
            'jumlah' => $request->get('quantity'),
            'status' => $request->get('status', 'pending'),
        ]);

        $stokRequest->save();

        return redirect()->route('stokrequests.index')->with('success', 'Stok request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stokRequest = StokRequest::findOrFail($id);
        $stokRequest->delete();

        return redirect()->route('stokrequests.index')->with('success', 'Stok request deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        // Supplier::create($request->all());
        $supplier = new Supplier();
        $supplier->nama_supplier = $request->input('nama_supplier');
        $supplier->alamat = $request->input('alamat');
        $supplier->kontak = $request->input('telepon');
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $supplier->nama_supplier = $request->input('nama_supplier');
        $supplier->alamat = $request->input('alamat');
        $supplier->kontak = $request->input('telepon');
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}

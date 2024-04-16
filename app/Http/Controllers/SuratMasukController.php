<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    // Menampilkan semua data surat masuk
    public function index()
    {
        $suratMasuk = SuratMasuk::all();
        return view('surat-masuk.surat_masuk', compact('suratMasuk'));
    }

    // Menampilkan form untuk menambah data surat masuk
    public function create()
    {
        return view('surat_masuk.create');
    }

    // Menyimpan data surat masuk yang baru ditambahkan
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            // Definisikan aturan validasi di sini sesuai kebutuhan
        ]);

        // Simpan data surat masuk
        SuratMasuk::create($request->all());

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    // Menampilkan detail data surat masuk
    public function show(SuratMasuk $suratMasuk)
    {
        return view('surat_masuk.show', compact('suratMasuk'));
    }

    // Menampilkan form untuk mengedit data surat masuk
    public function edit(SuratMasuk $suratMasuk)
    {
        return view('surat_masuk.edit', compact('suratMasuk'));
    }

    // Menyimpan perubahan pada data surat masuk yang diedit
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        // Validasi input
        $request->validate([
            // Definisikan aturan validasi di sini sesuai kebutuhan
        ]);

        // Simpan perubahan pada data surat masuk
        $suratMasuk->update($request->all());

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Data surat masuk berhasil diperbarui.');
    }

    // Menghapus data surat masuk
    public function destroy(SuratMasuk $suratMasuk)
    {
        $suratMasuk->delete();

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Data surat masuk berhasil dihapus.');
    }
}

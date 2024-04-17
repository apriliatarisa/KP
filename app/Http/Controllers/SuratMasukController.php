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
        return view('surat-masuk.surat_masuk_create');
    }

    // Menyimpan data surat masuk yang baru ditambahkan
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'asal_surat' => 'required|string',
        'no_surat' => 'required|string',
        'tgl_terima' => 'required|date',
        'isi' => 'required|string',
        'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Optional: validasi untuk file
    ]);

    // Simpan data surat masuk
    $data = [
        'asal_surat' => $request->asal_surat,
        'no_surat' => $request->no_surat,
        'tgl_terima' => $request->tgl_terima,
        'isi' => $request->isi,
        'id_user' => auth()->id(), // Menggunakan ID pengguna yang sedang login
    ];

    // Jika ada file yang diunggah
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filePath = $file->store('surat_masuk');
        $data['file_path'] = $filePath;
    }

    SuratMasuk::create($data);

    return redirect()->route('surat_masuk.index')
        ->with('success', 'Surat masuk berhasil ditambahkan.');
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
            'asal_surat' => 'required|string',
            'no_surat' => 'required|string',
            'tgl_terima' => 'required|date',
            'isi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Optional: validasi untuk file
        ]);

        // Update data surat masuk
        $data = [
            'asal_surat' => $request->asal_surat,
            'no_surat' => $request->no_surat,
            'tgl_terima' => $request->tgl_terima,
            'isi' => $request->isi,
        ];

        // Jika ada file yang diunggah
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('surat_masuk');
            $data['file_path'] = $filePath;
        }

        $suratMasuk->update($data);

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

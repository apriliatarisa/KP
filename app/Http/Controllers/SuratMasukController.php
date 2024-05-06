<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SuratMasukController extends Controller
{
    // Menampilkan semua data surat masuk
    public function index()
    {
        $suratMasuk = SuratMasuk::orderBy('created_at','desc')->paginate(10);
        return view('surat-masuk.surat_masuk', compact('suratMasuk'));
    }

    // Menampilkan form untuk menambah data surat masuk
    public function create()
    {
        return view('surat-masuk.surat_masuk_create');
    }

    // Metode store
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'asal_surat' => 'required|string',
            'no_surat' => 'required|string',
            'tgl_terima' => 'nullable|date',
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
            $file->storeAs('public/surat_masuk', $file->hashName());
            $data['file_path'] = $file->hashName();
        } else {
            // Tidak ada file yang diunggah, atur nilai default atau null untuk file_path
            $data['file_path'] = null; // atau nilai default lainnya
        }

        SuratMasuk::create($data);

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    // Menampilkan formulir untuk mengedit data surat masuk
    public function edit($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id); // Variabel sudah diperbaiki
        return view('surat-masuk.surat_masuk_edit', compact('suratMasuk'));
    }


    // Metode update
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'asal_surat' => 'required|string',
            'no_surat' => 'required|string',
            'tgl_terima' => 'nullable|date',
            'isi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Optional: validasi untuk file
        ]);

        // Menemukan instance SuratMasuk yang akan diperbarui berdasarkan ID
        $suratMasuk = SuratMasuk::findOrFail($id);

        // Update data surat masuk
        $suratMasuk->asal_surat = $request->asal_surat;
        $suratMasuk->no_surat = $request->no_surat;
        $suratMasuk->tgl_terima = $request->tgl_terima;
        $suratMasuk->isi = $request->isi;

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($suratMasuk->file_path) {
                Storage::disk('public')->delete('surat_masuk/' . $suratMasuk->file_path);
            }
    
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('surat_masuk', $fileName, 'public');
            $suratMasuk->file_path = $fileName;
        }
    
        // Simpan perubahan
        $suratMasuk->save();

        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('surat_masuk.index')
            ->with('success', 'Data surat masuk berhasil diperbarui.');
    }

    // Menghapus data surat masuk
    public function destroy($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        $suratMasuk->delete();

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Data surat masuk berhasil dihapus.');
    }
}

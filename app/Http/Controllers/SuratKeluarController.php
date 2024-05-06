<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $suratKeluar = SuratKeluar::orderBy('created_at','desc')->paginate(10);
        return view('surat-keluar.surat_keluar', compact('suratKeluar'));
    }

    public function create()
    {
        return view('surat-keluar.surat_keluar_create');
    }

    public function store(Request $request)
{
    // Validasi request
    $validatedData = $request->validate([
        'tujuan_surat' => 'required',
        'no_surat' => 'required',
        'tgl_terbit' => 'nullable|date',
        'isi' => 'required',
        'file' => 'nullable|mimes:pdf,doc,docx|max:2048', // File boleh kosong atau diisi
    ]);

    // Set pengirim berdasarkan pengguna yang sedang login
    $validatedData['pengirim'] = Auth::user()->name;

    // Set id_user berdasarkan pengguna yang sedang login
    $validatedData['id_user'] = Auth::id();

    // Upload file jika ada
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('surat_keluar', $fileName, 'public');
        $validatedData['file_path'] = $fileName;
    } else {
        // Jika tidak ada file diunggah, atur file_path menjadi null
        $validatedData['file_path'] = null;
    }

    // Simpan data surat keluar
    SuratKeluar::create($validatedData);

    return redirect()->route('surat_keluar.index')
        ->with('success', 'Surat keluar berhasil ditambahkan.');
}

 // Menampilkan formulir untuk mengedit data surat keluar
    public function edit($id)
 {
     $suratKeluar = SuratKeluar::findOrFail($id); // Variabel sudah diperbaiki
     return view('surat-keluar.surat_keluar_edit', compact('suratKeluar'));
 }


 // Metode update
    public function update(Request $request, $id)
 {
     // Validasi input
     $request->validate([
         'tujuan_surat' => 'required|string',
         'no_surat' => 'required|string',
         'tgl_terbit' => 'nullable|date',
         'isi' => 'required|string',
         'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Optional: validasi untuk file
     ]);

     // Menemukan instance SuratKeluar yang akan diperbarui berdasarkan ID
     $suratKeluar = SuratKeluar::findOrFail($id);

     // Update data surat keluar
     $suratKeluar->tujuan_surat = $request->tujuan_surat;
     $suratKeluar->no_surat = $request->no_surat;
     $suratKeluar->tgl_terbit = $request->tgl_terbit;
     $suratKeluar->isi = $request->isi;

     if ($request->hasFile('file')) {
         // Hapus file lama jika ada
         if ($suratKeluar->file_path) {
             Storage::disk('public')->delete('surat_keluar/' . $suratKeluar->file_path);
         }
 
         $file = $request->file('file');
         $fileName = time() . '_' . $file->getClientOriginalName();
         $filePath = $file->storeAs('surat_keluar', $fileName, 'public');
         $suratKeluar->file_path = $fileName;
     }
 
     // Simpan perubahan
     $suratKeluar->save();

     // Mengarahkan kembali ke halaman index dengan pesan sukses
     return redirect()->route('surat_keluar.index')
         ->with('success', 'Data surat keluar berhasil diperbarui.');
 }
    // Menghapus data surat keluar
    public function destroy($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        $suratKeluar->delete();

        return redirect()->route('surat_keluar.index')
            ->with('success', 'Data surat keluar berhasil dihapus.');
    }
}

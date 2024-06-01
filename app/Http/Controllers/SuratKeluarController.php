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

            $suratKeluar = SuratKeluar::orderBy('created_at', 'desc')->get();


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
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048', 
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

    public function edit($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id); // Variabel sudah diperbaiki
        if ($suratKeluar->id_user !== Auth::id()) {
            return redirect()->route('surat_keluar.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengupdate surat keluar ini.');
        }
        
        return view('surat-keluar.surat_keluar_edit', compact('suratKeluar'));
    }



    public function update(Request $request, $id)
    {
        // Temukan surat keluar berdasarkan ID
        $suratKeluar = SuratKeluar::findOrFail($id);

        // Pastikan hanya pengguna yang memiliki akses yang sesuai yang dapat mengedit surat keluar
        // Misalnya, hanya pengguna yang memiliki izin khusus atau hanya pemilik surat keluar yang dapat mengeditnya.
        // Anda dapat menyesuaikan logika akses sesuai dengan kebutuhan aplikasi Anda.
        // Contoh logika akses sederhana:
        if ($suratKeluar->id_user !== Auth::id()) {
            return redirect()->route('surat_keluar.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit surat keluar ini.');
        }

        // Validasi request
        $validatedData = $request->validate([
            'tujuan_surat' => 'required',
            'no_surat' => 'required',
            'tgl_terbit' => 'nullable|date',
            'isi' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048', // File boleh kosong atau diisi
        ]);

        // Update data surat keluar
        $suratKeluar->tujuan_surat = $validatedData['tujuan_surat'];
        $suratKeluar->no_surat = $validatedData['no_surat'];
        $suratKeluar->tgl_terbit = $validatedData['tgl_terbit'];
        $suratKeluar->isi = $validatedData['isi'];

        // Upload file jika ada
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

        return redirect()->route('surat_keluar.index')
            ->with('success', 'Surat keluar berhasil diperbarui.');
    }

    // Menghapus data surat masuk
    public function destroy($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        $suratKeluar->delete();

        return redirect()->route('surat_keluar.index')
            ->with('success', 'Data surat masuk berhasil dihapus.');
    }
}

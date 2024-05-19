<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function index()
    {
        $suratMasuk = SuratMasuk::orderBy('created_at', 'desc')->get();
        return view('surat-masuk.surat_masuk', compact('suratMasuk'));
    }

    public function create()
    {
        return view('surat-masuk.surat_masuk_create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'asal_surat' => 'required',
            'no_surat' => 'required',
            'tgl_terima' => 'nullable|date',
            'isi' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048', // File boleh kosong atau diisi
        ]);

        $validatedData['penerima'] = Auth::user()->name;
        $validatedData['id_user'] = Auth::id();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('surat_masuk', $fileName, 'public');
            $validatedData['file_path'] = $fileName;
        } else {
            $validatedData['file_path'] = null;
        }

        SuratMasuk::create($validatedData);

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        return view('surat-masuk.surat_masuk_edit', compact('suratMasuk'));
    }

    public function update(Request $request, $id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);

        $validatedData = $request->validate([
            'asal_surat' => 'required',
            'no_surat' => 'required',
            'tgl_terima' => 'nullable|date',
            'isi' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048', // File boleh kosong atau diisi
        ]);

        $suratMasuk->asal_surat = $validatedData['asal_surat'];
        $suratMasuk->no_surat = $validatedData['no_surat'];
        $suratMasuk->tgl_terima = $validatedData['tgl_terima'];
        $suratMasuk->isi = $validatedData['isi'];

        if ($request->hasFile('file')) {
            if ($suratMasuk->file_path) {
                Storage::delete('public/surat_masuk/' . $suratMasuk->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('surat_masuk', $fileName, 'public');
            $suratMasuk->file_path = $fileName;
        }

        $suratMasuk->save();

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        if ($suratMasuk->file_path) {
            Storage::delete('public/surat_masuk/' . $suratMasuk->file_path);
        }
        $suratMasuk->delete();

        return redirect()->route('surat_masuk.index')
            ->with('success', 'Surat masuk berhasil dihapus.');
    }
}

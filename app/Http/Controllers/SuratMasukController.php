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
        $file->storeAs('public/surat_masuk', $file->hashName());
        $data['file_path'] = $file->hashName();
    }

    SuratMasuk::create($data);

    return redirect()->route('surat_masuk.index')
        ->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    public function show(SuratMasuk $suratMasuk)
    {
    $filePath = $suratMasuk->file_path;
    return view('surat-masuk.surat_masuk_show', compact('suratMasuk', 'filePath'));
    }



    // Menampilkan form untuk mengedit data surat masuk
    public function edit($id)
    {
        $surat_masuk = SuratMasuk::findOrFail($id);
        return view('surat-masuk.surat_masuk_edit', compact('surat_masuk'));
    }
    

    // Menyimpan perubahan pada data surat masuk yang diedit
    public function update(Request $request, $id)
    {
    // Validasi input
    $request->validate([
        'asal_surat' => 'required|string',
        'no_surat' => 'required|string',
        'tgl_terima' => 'required|date',
        'isi' => 'required|string',
        'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Optional: validasi untuk file
    ]);

    // Menemukan instance SuratMasuk yang akan diperbarui berdasarkan ID
    $surat_masuk = SuratMasuk::findOrFail($id);

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

    // Memperbarui data surat masuk dengan data yang baru
    $surat_masuk->update($data);

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

// public function disposisi()
// {
//     $users = User::all(); // Mengambil semua data pengguna

//     // Mengembalikan tampilan disposisi dan mengirimkan data pengguna ke tampilan
//     return view('surat-masuk.disposisi', compact('users'));
// }
}

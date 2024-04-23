<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratMasuk;
use App\Models\DisposisiSm;
use Illuminate\Http\Request;

class DisposisiSmController extends Controller
{
    /**
     * Menampilkan semua data disposisi_sm.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disposisi_sm = DisposisiSm::paginate(10);
        return view('disposisi_sm.disposisi_sm', compact('disposisi_sm'));
    }

    /**
     * Menampilkan formulir untuk membuat disposisi_sm baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suratMasukList = SuratMasuk::all();
        $users = User::all();
        return view('disposisi_sm.disposisi_sm_create', compact('users', 'suratMasukList'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tujuan' => 'required|array',
            'tujuan.*' => 'exists:users,id', // Pastikan semua tujuan adalah ID pengguna yang valid
            'catatan' => 'nullable',
            'surat_masuk_id' => 'required|exists:surat_masuk,id',
        ]);

        // Simpan disposisi baru
        foreach ($request->tujuan as $user_id) {
            DisposisiSm::create([
                'id_user' => auth()->user()->id,
                'id_surat_masuk' => $request->surat_masuk_id,
                'tujuan' => $user_id,
                'catatan' => $request->catatan,
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('disposisi_sm.index')->with('success', 'Disposisi berhasil ditambahkan.');
    }
    
    /**
     * Menampilkan data disposisi_sm dengan id tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disposisi_sm = DisposisiSm::findOrFail($id);
        return view('disposisi_sm.show', compact('disposisi_sm'));
    }

    /**
     * Menampilkan formulir untuk mengedit disposisi_sm yang ada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disposisi_sm = DisposisiSm::findOrFail($id);
        return view('disposisi_sm.edit', compact('disposisi_sm'));
    }

    /**
     * Memperbarui disposisi_sm yang ada dalam penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input jika diperlukan
        // ...

        // Lakukan penyimpanan pembaruan
        // ...

        // Redirect dengan pesan sukses
        // ...
    }

    /**
     * Menghapus disposisi_sm yang ada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disposisi_sm = DisposisiSm::findOrFail($id);
        $disposisi_sm->delete();
        return redirect()->route('disposisi_sm.disposisi_sm')->with('success', 'Disposisi berhasil dihapus.');
    }
}

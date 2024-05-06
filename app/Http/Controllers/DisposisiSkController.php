<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratKeluar;
use App\Models\DisposisiSk; // Menggunakan model DisposisiSk
use Illuminate\Http\Request;

class DisposisiSkController extends Controller
{
    /**
     * Menampilkan semua data disposisi_sk.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disposisi_sk = DisposisiSk::orderBy('created_at', 'desc')->paginate(10);
        $jumlahSelesaiSk = DisposisiSk::where('status', true)->count();
        return view('disposisi_sk.disposisi_sk', compact('disposisi_sk', 'jumlahSelesaiSk')); // Menggunakan view 'disposisi_sk.index'
    }

    /**
     * Menampilkan formulir untuk membuat disposisi_sk baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suratKeluarList = SuratKeluar::all();
        $users = User::all();
        return view('disposisi_sk.disposisi_sk_create', compact('users', 'suratKeluarList')); // Menggunakan view 'disposisi_sk.create'
    }

    /**
     * Menyimpan disposisi_sk baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tujuan' => 'required|array',
            'tujuan.*' => 'exists:users,id', // Pastikan semua tujuan adalah ID pengguna yang valid
            'catatan' => 'nullable',
            'id_surat_keluar' => 'required|exists:surat_keluar,id',
        ]);

        foreach ($request->tujuan as $user_id) {
            DisposisiSk::create([
                'id_user' => auth()->user()->id,
                'id_surat_keluar' => $request->id_surat_keluar,
                'tujuan' => $user_id,
                'catatan' => $request->catatan,
                'read' => false,
            ]);

            // Panggil metode untuk menambah jumlah disposisi yang belum dibaca
            $this->incrementUnreadDisposisiskCount($user_id);
        }

        return redirect()->route('disposisi_sk.index')->with('success', 'Disposisi surat keluar berhasil disimpan.');
    }

    /**
     * Menandai disposisi sebagai selesai.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAsCompleted($id)
    {
        // Temukan disposisi berdasarkan ID
        $disposisi = DisposisiSk::findOrFail($id);

        // Periksa apakah pengguna yang mencoba menandai disposisi selesai adalah pengguna yang sesuai dengan tujuan disposisi
        if ($disposisi->tujuan != auth()->user()->id) {
            // Jika bukan, kembalikan dengan pesan kesalahan
            return redirect()->route('disposisi_sk.index')->with('error', 'Anda tidak memiliki izin untuk menandai disposisi ini sebagai selesai.');
        }

        // Periksa apakah disposisi sudah selesai sebelumnya
        if ($disposisi->status) {
            // Jika sudah selesai, kembalikan dengan pesan kesalahan
            return redirect()->route('disposisi_sk.index')->with('error', 'Disposisi telah ditandai sebagai selesai sebelumnya.');
        }

        // Tandai disposisi sebagai selesai
        $disposisi->update(['status' => true]);

        // Kurangi jumlah disposisi yang belum dibaca dari sesi pengguna yang bersangkutan
        $this->decrementUnreadDisposisiskCount(auth()->user()->id);

        // Redirect kembali ke halaman index disposisi
        return redirect()->route('disposisi_sk.index')->with('success', 'Disposisi telah ditandai sebagai selesai.');
    }

    /**
     * Menambah jumlah disposisi yang belum dibaca dari sesi pengguna.
     *
     * @param  int  $user_id
     * @return void
     */
    private function incrementUnreadDisposisiskCount($user_id)
    {
        $user = User::find($user_id);
        $user->incrementUnreadDisposisiskCount();
    }

    /**
     * Mengurangi jumlah disposisi yang belum dibaca dari sesi pengguna.
     *
     * @param  int  $user_id
     * @return void
     */
    private function decrementUnreadDisposisiskCount($user_id)
    {
        $user = User::find($user_id);
        $user->decrementUnreadDisposisiskCount();
    }
}

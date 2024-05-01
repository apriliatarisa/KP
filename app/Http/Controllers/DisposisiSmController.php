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
        $disposisi_sm = DisposisiSm::orderBy('created_at', 'desc')->paginate(10);
        $jumlahSelesai = DisposisiSm::where('status', true)->count();
        return view('disposisi_sm.disposisi_sm', compact('disposisi_sm', 'jumlahSelesai'));
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

    /**
     * Menyimpan disposisi_sm baru ke database.
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
            'id_surat_masuk' => 'required|exists:surat_masuk,id',
        ]);

        foreach ($request->tujuan as $user_id) {
            DisposisiSm::create([
                'id_user' => auth()->user()->id,
                'id_surat_masuk' => $request->id_surat_masuk,
                'tujuan' => $user_id,
                'catatan' => $request->catatan,
                'read' => false,
            ]);

            // Panggil metode untuk menambah jumlah disposisi yang belum dibaca
            $this->incrementUnreadDisposisiCount($user_id);
        }

        return redirect()->route('disposisi_sm.index')->with('success', 'Disposisi surat masuk berhasil disimpan.');
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
        $disposisi = DisposisiSm::findOrFail($id);

        // Periksa apakah pengguna yang mencoba menandai disposisi selesai adalah pengguna yang sesuai dengan tujuan disposisi
        if ($disposisi->tujuan != auth()->user()->id) {
            // Jika bukan, kembalikan dengan pesan kesalahan
            return redirect()->route('disposisi_sm.index')->with('error', 'Anda tidak memiliki izin untuk menandai disposisi ini sebagai selesai.');
        }

        // Periksa apakah disposisi sudah selesai sebelumnya
        if ($disposisi->status) {
            // Jika sudah selesai, kembalikan dengan pesan kesalahan
            return redirect()->route('disposisi_sm.index')->with('error', 'Disposisi telah ditandai sebagai selesai sebelumnya.');
        }

        // Tandai disposisi sebagai selesai
        $disposisi->update(['status' => true]);

        // Kurangi jumlah disposisi yang belum dibaca dari sesi pengguna yang bersangkutan
        $this->decrementUnreadDisposisiCount(auth()->user()->id);

        // Redirect kembali ke halaman index disposisi
        return redirect()->route('disposisi_sm.index')->with('success', 'Disposisi telah ditandai sebagai selesai.');
    }

    // /**
    //  * Menghapus disposisi_sm yang ada.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $disposisi_sm = DisposisiSm::findOrFail($id);
    //     $disposisi_sm->delete();

    //     return redirect()->route('disposisi_sm.index')->with('success', 'Disposisi surat masuk berhasil dihapus.');
    // }

    /**
     * Menambah jumlah disposisi yang belum dibaca dari sesi pengguna.
     *
     * @param  int  $user_id
     * @return void
     */
    private function incrementUnreadDisposisiCount($user_id)
    {
        $user = User::find($user_id);
        $user->incrementUnreadDisposisiCount();
    }

    /**
     * Mengurangi jumlah disposisi yang belum dibaca dari sesi pengguna.
     *
     * @param  int  $user_id
     * @return void
     */
    private function decrementUnreadDisposisiCount($user_id)
    {
        $user = User::find($user_id);
        $user->decrementUnreadDisposisiCount();
    }
}

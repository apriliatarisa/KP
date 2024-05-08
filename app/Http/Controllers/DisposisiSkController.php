<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratKeluar;
use App\Models\DisposisiSk; // Menggunakan model DisposisiSk
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisposisiSkController extends Controller
{
    /**
     * Menampilkan semua data disposisi_sk.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the logged-in user
        $user = Auth::user();

        // If user is not 'kakancab', retrieve only disposisi_sk for the logged-in user
        if ($user->usertype !== 'kakancab') {
            // Example of fetching DisposisiSk records for the logged-in user
            $disposisi_sk = DisposisiSk::where('tujuan', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            // If user is 'kakancab', retrieve all disposisi_sk
            $disposisi_sk = DisposisiSk::orderBy('created_at', 'desc')->paginate(10);
        }

        $jumlahSelesaiSk = DisposisiSk::where('status', true)->count();

        return view('disposisi_sk.disposisi_sk', compact('disposisi_sk', 'jumlahSelesaiSk'));
    }

    /**
     * Menampilkan formulir untuk membuat disposisi_sk baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // // Get the logged-in user
        // $user = auth()->user();

        // // Check if the user is 'kakancab'
        // if ($user->usertype === 'kakancab') {
        //     // Retrieve all surat keluar
        //     $suratKeluarList = SuratKeluar::all();
        // } else {
        //     // Retrieve only the surat keluar associated with the logged-in user
        //     $suratKeluarList = SuratKeluar::where('id_user', $user->id)->get();
        // }

        // $suratKeluarList = SuratKeluar::all();
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
            $this->incrementUnreadDisposisiCount($user_id);
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
        $this->decrementUnreadDisposisiCount(auth()->user()->id);

        // Redirect kembali ke halaman index disposisi
        return redirect()->route('disposisi_sk.index')->with('success', 'Disposisi telah ditandai sebagai selesai.');
    }

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

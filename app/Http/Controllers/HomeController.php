<?php

namespace App\Http\Controllers;

use App\Models\DisposisiSk;
use App\Models\DisposisiSm;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $usertype=Auth()->user()->usertype;

            if($usertype=='adum')
            {
                $totalSuratMasuk = SuratMasuk::count();
                $totalSuratKeluar = SuratKeluar::count();
                $totalDisposisiSuratMasuk = DisposisiSm::count();
                $totalDisposisiSuratKeluar = DisposisiSk::count();
                // dd($totalSuratMasuk);
                // Mengirim data ke view
                return view('dashboard', compact('totalSuratMasuk', 'totalSuratKeluar', 'totalDisposisiSuratMasuk', 'totalDisposisiSuratKeluar'));
        
            }

            else if ($usertype=='kakancab')
            {
                return view('kakancab.kakancabhome');
            }

            else
            {
                return redirect()->back();
            }
        }
    }
    public function post()
    {
        return view('post');
    }
}

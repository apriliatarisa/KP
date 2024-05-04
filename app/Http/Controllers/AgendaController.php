<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    /**
     * Menampilkan daftar agenda.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = Agenda::orderBy('created_at','desc');
        return view('agenda.agenda', compact('agendas'));
    }
}

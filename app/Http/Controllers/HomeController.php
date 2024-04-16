<?php

namespace App\Http\Controllers;

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
                return view('dashboard');
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

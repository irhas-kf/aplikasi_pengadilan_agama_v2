<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $level = Auth::user()->level;
        if($level == 'pimpinan'){
          return redirect('backend_pimpinan_dashboard');
        }else if($level == 'admin'){
          return redirect('backend_admin_dashboard');
        }else if($level == 'operator'){
          return redirect('backend_operator_dashboard');
        }
    }
}

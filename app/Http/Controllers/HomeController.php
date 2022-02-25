<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

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
	public function welcome()
    {
		if(Auth()){			
			return redirect()->route('dashboard');
		}
		else{
			return view('auth.login');
		}
    }
	
    public function index()
    {
		activity()->log('Masuk ke halaman dashboard');
		$totalData = Data::count();
		
        return view('dashboard', compact('totalData'));
    }
}

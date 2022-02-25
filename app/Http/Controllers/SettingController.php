<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
		activity()->log('Masuk ke halaman Pengaturan');
		
        return view('setting.index');
    }

    public function saveUser(Request $request)
    {
        $request->validate([
            'name' => 'string|required|min:4',
            'email' => 'email|required'
        ]);

        $act = User::where('id', Auth()->user()->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

        if ($act) {
			activity()->log('Mengubah data akun');
			
            return redirect()->back()->with('success', 'Berhasil mengubah data');
        } else {
            return redirect()->back()->with('error', 'Gagal merubah data');
        }
    }

    public function savePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'same:new_password|min:6|different:old_password'
        ]);

        $user = User::where('id', Auth()->user()->id)->first();

        if (Hash::check($request->old_password, $user->password)) {
            User::where('id', Auth()->user()->id)->update([
				'password' => Hash::make($request->new_password)
			]);
			
			activity()->log('Mengubah password akun');
			
            return redirect()->back()->with('success', 'Berhasil mengubah password');
        } else {
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
        }
    }
}

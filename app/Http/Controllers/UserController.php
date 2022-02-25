<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class UserController extends Controller
{
    public function index()
    {
		activity()->log('Masuk ke halaman Kelola User');
		
		return view('user.index');
    }

    public function list()
    {
        $data = User::latest()->get();
		
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<div class='btn-group'>
                        <button class='btn btn-primary btn-sm detailButton' data-id='$data->id'>
                            <i class='anticon anticon-search'></i>
                        </button>
                        <button class='btn btn-danger btn-sm deleteButton' data-id='$data->id'>
                            <i class='anticon anticon-delete'></i>
                        </button>
                    </div>";
            })
			->addColumn('is_admin', function($data) {
				if($data->is_admin == 1){
					return 'Administrator';
				}
				else{
					return 'User';
				}
			})
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function update(Request $request)
    {
        $act =	User::where('id', $request->id)->update([
					'name' => $request->name,
					'email' => $request->email
				]);

        if ($act) {
			activity()->log('Mengupdate user dengan ID = ' . $request->id);
			
            return redirect()->back()->with('success', 'Berhasil mengubah user');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah user');
        }
    }

    public function detail(Request $request)
    {
        $act = User::where('id', $request->id)->first();
		activity()->log('Melihat detail user dengan ID = ' . $request->id);
		
        return response()->json($act);
    }

    public function delete(Request $request)
    {
        $act = User::where('id', $request->id)->delete();
		
        if ($act) {
			activity()->log('Menghapus user dengan ID = ' . $request->id);
			
            return $this->sendNotificiation('success', 'Berhasil menghapus user');
        } else {
            return $this->sendNotificiation('error', 'Gagal menghapus user');
        }
    }

    public function create()
    {
		return view('user.create');
    }

    public function store(Request $request)
    {
		$request->validate([
			'name' => 'required',
			'email' => 'required',
			'is_admin' => 'required',
			'password' => 'required'
		]);
		
		$act = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'is_admin' => $request->is_admin,
			'password' => Hash::make($request->password)
		]);
		
		activity()->log('Menambahkan user baru');

        if ($act) {
            return redirect()->route('user_page')->with('success', 'Berhasil menambahkan user');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan user');
        }
    }
}

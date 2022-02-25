<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use PDF;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use File;
use Illuminate\Support\Facades\Storage;
use LogActivity;

class DataController extends Controller
{
	public function index()
	{
		activity()->log('Masuk ke halaman Data KTP');
		return view('data.index');
	}
	
	public function create()
	{
		return view('data.create');
	}
	
	public function list(Request $request)
	{
		$data = Data::select('id', 'nik', 'nama', 'tgl_lahir', 'alamat')->orderBy('nik')->latest();
		
		return DataTables::of($data)
            ->addColumn('action', function ($data) {
				if(auth()->user()->is_admin == 1){
					return "<div class='btn-group'>
								<form method='POST' action='" . route('detail_data') . "'>".
									csrf_field()."
									<input name='id_data' id='id_data' value='" . $data->id . "' hidden></input>
									<button class='btn btn-primary btn-sm' type='submit'><i class='anticon anticon-search'></i></button>
								</form>
								<button class='btn btn-danger btn-sm deleteButton' data-id='$data->id'>
									<i class='anticon anticon-delete'></i>
								</button>
							</div>";
				}
				else{
					return "<form method='POST' action='" . route('detail_data') . "'>".
								csrf_field()."
								<input name='id_data' id='id_data' value='" . $data->id . "' hidden></input>
								<button class='btn btn-primary btn-sm' type='submit'><i class='anticon anticon-search'></i></button>
							</form>
							";
				}
            })
			->addColumn('tgl_lahir', function($data) {
				return Carbon::parse($data->tgl_lahir)->age." tahun";
			})
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
	}
	
	public function detail(Request $request)
	{
		Carbon::setLocale('id');
		$id = $request->id_data;
		$data = Data::where('id', $id)->first();
		
        activity()->log('Melihat detail data ID = ' . $id);
		
		return view('data.detail', compact('data'));
	}
	
	public function delete(Request $request)
    {
        $act = Data::where('id', $request->id)->delete();
		
        if ($act) {
			activity()->log('Menghapus data dengan ID = ' . $request->id);
			
            return $this->sendNotificiation('success', 'Berhasil menghapus data');
        } else {
            return $this->sendNotificiation('error', 'Gagal menghapus data');
        }
    }
	
	public function store(Request $request)
    {
		if($request->foto != ''){
			$request->validate([
				'nik' => 'required',
				'nama' => 'required',
				'tempat' => 'required',
				'tgl' => 'required',
				'foto' => 'mimes:jpeg,bmp,png|max:1024',
				'jenis_kelamin' => 'required',
				'gol_darah' => 'required',
				'alamat' => 'required',
				'rt' => 'required',
				'rw' => 'required',
				'kelurahan' => 'required',
				'kecamatan' => 'required',
				'agama' => 'required',
				'status' => 'required',
				'pekerjaan' => 'required',
				'kewarganegaraan' => 'required'
			]);
			
			$image = $request->file('foto');
			$filename = 'Foto-' . $request->nama . "-" . time() . "." . $request->file('foto')->getClientOriginalExtension();
			$image->move(public_path('foto'), $filename);
			
			$act = Data::create([
				'nik' => $request->nik,
				'nama' => $request->nama,
				'tempat_lahir' => $request->tempat,
				'tgl_lahir' => $request->tgl,
				'foto' => $filename,
				'jenis_kelamin' => $request->jenis_kelamin,
				'gol_darah' => $request->gol_darah,
				'alamat' => $request->alamat,
				'rt' => $request->rt,
				'rw' => $request->rw,
				'kelurahan' => $request->kelurahan,
				'kecamatan' => $request->kecamatan,
				'agama' => $request->agama,
				'status' => $request->status,
				'pekerjaan' => $request->pekerjaan,
				'kewarganegaraan' => $request->kewarganegaraan
			]);
		}
		
		else{
			$request->validate([
				'nik' => 'required',
				'nama' => 'required',
				'tempat' => 'required',
				'tgl' => 'required',
				'jenis_kelamin' => 'required',
				'gol_darah' => 'required',
				'alamat' => 'required',
				'rt' => 'required',
				'rw' => 'required',
				'kelurahan' => 'required',
				'kecamatan' => 'required',
				'agama' => 'required',
				'status' => 'required',
				'pekerjaan' => 'required',
				'kewarganegaraan' => 'required'
			]);
			
			$act = Data::create([
				'nik' => $request->nik,
				'nama' => $request->nama,
				'tempat_lahir' => $request->tempat,
				'tgl_lahir' => $request->tgl,
				'jenis_kelamin' => $request->jenis_kelamin,
				'gol_darah' => $request->gol_darah,
				'alamat' => $request->alamat,
				'rt' => $request->rt,
				'rw' => $request->rw,
				'kelurahan' => $request->kelurahan,
				'kecamatan' => $request->kecamatan,
				'agama' => $request->agama,
				'status' => $request->status,
				'pekerjaan' => $request->pekerjaan,
				'kewarganegaraan' => $request->kewarganegaraan
			]);
		}
		
		if($act){
			activity()->log('Membuat data KTP baru');
			
			return redirect()->route('data')->with('success','Berhasil menambahkan data.');
		}
		else{
			return redirect()->route('data')->with(['error' => 'Gagal menambahkan data.']);
        }
    }
	
	public function edit($id, Request $request)
	{
		$data = Data::where('id', $id)->first();
		
        return view('data.edit', compact('data'));
	}
	
	public function editProcess($id, Request $request)
	{
		if($request->foto != ''){
			$request->validate([
				'nik' => 'required',
				'nama' => 'required',
				'tempat' => 'required',
				'tgl' => 'required',
				'foto' => 'mimes:jpeg,bmp,png|max:1024',
				'jenis_kelamin' => 'required',
				'gol_darah' => 'required',
				'alamat' => 'required',
				'rt' => 'required',
				'rw' => 'required',
				'kelurahan' => 'required',
				'kecamatan' => 'required',
				'agama' => 'required',
				'status' => 'required',
				'pekerjaan' => 'required',
				'kewarganegaraan' => 'required'
			]);
			
			$old = Data::where('id', $id)->first()->foto;
			unlink(storage_path(('../public/foto/'.$old)));
			
			$filename = 'Foto-' . $request->nama . "-" . time() . "." . $request->file('foto')->getClientOriginalExtension();
			$request->file('foto')->move(public_path('foto'), $filename);
			
			$act = Data::where('id', $id)->update([
				'nik' => $request->nik,
				'nama' => $request->nama,
				'tempat_lahir' => $request->tempat,
				'tgl_lahir' => $request->tgl,
				'foto' => $filename,
				'jenis_kelamin' => $request->jenis_kelamin,
				'gol_darah' => $request->gol_darah,
				'alamat' => $request->alamat,
				'rt' => $request->rt,
				'rw' => $request->rw,
				'kelurahan' => $request->kelurahan,
				'kecamatan' => $request->kecamatan,
				'agama' => $request->agama,
				'status' => $request->status,
				'pekerjaan' => $request->pekerjaan,
				'kewarganegaraan' => $request->kewarganegaraan
			]);
		}
			
		else{
			$request->validate([
				'nik' => 'required',
				'nama' => 'required',
				'tempat' => 'required',
				'tgl' => 'required',
				'jenis_kelamin' => 'required',
				'gol_darah' => 'required',
				'alamat' => 'required',
				'rt' => 'required',
				'rw' => 'required',
				'kelurahan' => 'required',
				'kecamatan' => 'required',
				'agama' => 'required',
				'status' => 'required',
				'pekerjaan' => 'required',
				'kewarganegaraan' => 'required'
			]);
			
			$act = Data::where('id', $id)->update([
				'nik' => $request->nik,
				'nama' => $request->nama,
				'tempat_lahir' => $request->tempat,
				'tgl_lahir' => $request->tgl,
				'jenis_kelamin' => $request->jenis_kelamin,
				'gol_darah' => $request->gol_darah,
				'alamat' => $request->alamat,
				'rt' => $request->rt,
				'rw' => $request->rw,
				'kelurahan' => $request->kelurahan,
				'kecamatan' => $request->kecamatan,
				'agama' => $request->agama,
				'status' => $request->status,
				'pekerjaan' => $request->pekerjaan,
				'kewarganegaraan' => $request->kewarganegaraan
			]);
		}
		
		if($act){
			activity()->log('Mengubah data dengan ID = ' . $id);
			
			return redirect()->route('data')->with('success','Berhasil mengubah data.');
		}
		else{
			return redirect()->back()->withInput()->with(['error' => 'Gagal mengubah data.']);
        }
	}
	
	public function export(Request $request)
	{
		$request->validate([
			'tipe_file' => 'required',
		]);
		
		if($request->tipe_file == 'pdf'){
			Carbon::setLocale('id');
			$data = Data::latest()->get();
			
			$pdf = PDF::loadView('data.export', ['data' => $data]);
			$pdf->setPaper('legal', 'landscape');
			
			activity()->log('Mengeskpor data KTP tipe file PDF');
			return $pdf->stream('data ktp.pdf');
		}
		
		else if($request->tipe_file == 'csv'){
			activity()->log('Mengeskpor data KTP tipe file CSV');
			return Excel::download(new UsersExport, 'data ktp.csv');
		}
		
		else if($request->tipe_file == 'pdf.detail'){
			Carbon::setLocale('id');
			$id = $request->id_data;
			$data = Data::where('id', $id)->first();
			
			$pdf = PDF::loadView('data.detail_export', ['data' => $data]);
			$pdf->setPaper('A4', 'potrait');
			
			activity()->log('Mengeskpor detail data KTP ID = ' . $id);
			return $pdf->stream('data-' . time() . rand(1000,9999) . '.pdf');
		}
		
		else{
			return redirect()->back()->withInput()->with(['error' => 'Gagal export data.']);
		}
	}
	
	public function import(Request $request){
		$request->validate([
			'file_import' => 'required',
		]);
		
		$path = $request->file('file_import');
		$act = Excel::import(new UsersImport, $path);
		
		if($act){
			activity()->log('Import data KTP ke sistem');
			
			return redirect()->route('data')->with('success','Berhasil import data.');
		}
		else{
			return redirect()->back()->withInput()->with(['error' => 'Gagal import data.']);
        }
	}
}
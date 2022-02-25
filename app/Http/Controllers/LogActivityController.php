<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LogActivityController extends Controller
{
    public function index()
	{
		$act = Activity::all();
		
		return view('log.index');
	}
	
	public function list(Request $request)
	{
		$data = DB::table('activity_log')
            ->join('users', 'users.id', '=', 'activity_log.causer_id')
            ->select('activity_log.id', 'users.name', 'activity_log.description', 'activity_log.created_at')
            ->orderBy('activity_log.created_at', 'DESC')
			->get();
		
		Carbon::setLocale('id');
		
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
			->addColumn('time', function($data) {
				return Carbon::parse($data->created_at)->diffForHumans();
			})
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
	}
	
	public function detail(Request $request)
    {
        Carbon::setLocale('id');
		$act = DB::table('activity_log')
            ->join('users', 'users.id', '=', 'activity_log.causer_id')
            ->select('users.name', 'activity_log.description', 'activity_log.created_at')
			->where('activity_log.id', $request->id)
            ->first();
		
		$act->created_at = Carbon::parse($act->created_at)->diffForHumans();
        return response()->json($act);
    }
	
	public function delete(Request $request)
	{
		$act = Activity::where('id', $request->id)->delete();

        if ($act) {
            return $this->sendNotificiation('success', 'Berhasil menghapus log aktivitas');
        } else {
            return $this->sendNotificiation('error', 'Gagal menghapus log aktivitas');
        }
	}
}

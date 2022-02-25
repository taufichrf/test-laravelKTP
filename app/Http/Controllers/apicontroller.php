<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataKtpModel;

class apicontroller extends Controller
{
    public funcion get_all_data(){
    	return response()->json(DataKtpModel::all(), 200);
    }
}

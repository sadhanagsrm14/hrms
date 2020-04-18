<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AttendanceData;

class TeamLeadController extends Controller
{

	public function getDashboard(){

		return view('teamLead.dashboard');
	}
}
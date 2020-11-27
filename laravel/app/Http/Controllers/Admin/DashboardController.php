<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Library\Vehicle as Library;
class DashboardController extends Controller
{
    public function Page(){
//        $reservations = Booking::with('Vehicles')->with('order')->get();
        $library = new Library;
        $statuses = $library->VehicleStatuses();
		return view('admin.dashboard.dashboard', compact( 'statuses'));
	}
	public function PageHelp(){
		return view('admin.help');
	}

	public function getCalendarList(){
	    $model = Booking::with('Vehicles')->with('order')->get();

	    return response()->json(['data' => $model]);
    }
}

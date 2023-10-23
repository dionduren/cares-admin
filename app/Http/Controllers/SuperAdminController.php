<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    public function activity_history()
    {
        return view('sadmin.activity_history');
    }

    public function data_activity_history()
    {
        $activity_history = ActivityLog::all();
        return response()->json($activity_history);
    }
}

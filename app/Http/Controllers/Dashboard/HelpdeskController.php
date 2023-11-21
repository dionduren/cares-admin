<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HelpdeskController extends Controller
{
    function index_new()
    {
        $nik_user = Auth::user()->nik;
        return view('dashboard.helpdesk.tiket-baru', [
            'user' => $nik_user,
        ]);
    }

    function index_ongoing()
    {
        $nik_user = Auth::user()->nik;
        return view('dashboard.helpdesk.tiket-ongoing', [
            'user' => $nik_user,
        ]);
    }

    function index_resolved()
    {
        $nik_user = Auth::user()->nik;
        return view('dashboard.helpdesk.tiket-resolved', [
            'user' => $nik_user,
        ]);
    }

    function index_all()
    {
        $nik_user = Auth::user()->nik;
        return view('dashboard.helpdesk.all-tiket', [
            'user' => $nik_user,
        ]);
    }
}
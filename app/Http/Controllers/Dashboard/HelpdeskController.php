<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tiket;
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

    function detail_tiket($id)
    {
        $nik_user = Auth::user()->nik;
        $tiket_detail = Tiket::where('id', $id)->first();
        return view('dashboard.helpdesk.ticket-detail', [
            'user' => $nik_user,
            'tiket' => $tiket_detail,
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

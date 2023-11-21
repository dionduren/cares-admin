<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tiket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TechnicalController extends Controller
{
    function index_assigned()
    {
        $nik_user = Auth::user()->nik;
        return view('dashboard.technical.tiket-assigned', [
            'user' => $nik_user,
        ]);
    }

    function ticket_detail($id)
    {
        $nik_user = Auth::user()->nik;
        $data_tiket = Tiket::where('id', $id)->first();
        return view('dashboard.technical.tiket-detail', [
            'user' => $nik_user,
            'tiket' => $data_tiket,
        ]);
    }

    function index_resolved()
    {
        $nik_user = Auth::user()->nik;
        return view('dashboard.technical.tiket-resolved', [
            'user' => $nik_user,
        ]);
    }

    function index_all()
    {
        $nik_user = Auth::user()->nik;
        return view('dashboard.technical.all-tiket', [
            'user' => $nik_user,
        ]);
    }
}

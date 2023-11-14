<?php

namespace App\Http\Controllers\Dsahboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HelpdeskController extends Controller
{
    function index_new()
    {
        $nik_user = Auth::user()->nik;
        return view('helpdesk.tiket-baru', [
            'user' => $nik_user,
        ]);
    }
}

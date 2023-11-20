<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\GrupMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TeamLeadController extends Controller
{
    function index_new()
    {
        $nik_user = Auth::user()->nik;
        $group_id = GrupMember::where('nik_member', $nik_user)->first()->id_group;
        return view('dashboard.teamlead.tiket-baru', [
            'user' => $nik_user,
            'group_id' => $group_id,
        ]);
    }

    function index_ongoing()
    {
        $nik_user = Auth::user()->nik;
        $group_id = GrupMember::where('nik_member', $nik_user)->first()->id_group;
        return view('dashboard.teamlead.tiket-ongoing', [
            'user' => $nik_user,
            'group_id' => $group_id,
        ]);
    }

    function index_resolved()
    {
        $nik_user = Auth::user()->nik;
        $group_id = GrupMember::where('nik_member', $nik_user)->first()->id_group;
        return view('dashboard.teamlead.tiket-resolved', [
            'user' => $nik_user,
            'group_id' => $group_id,
        ]);
    }

    function index_all()
    {
        $nik_user = Auth::user()->nik;
        $group_id = GrupMember::where('nik_member', $nik_user)->first()->id_group;
        return view('dashboard.teamlead.all-tiket', [
            'user' => $nik_user,
            'group_id' => $group_id,
        ]);
    }
}

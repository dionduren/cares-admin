<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create_ticket(Request $request)
    {
        $user = Auth::user();
        return view('ticket.create', [
            'user' => $user,
        ]);
    }

    function index_self()
    {
        $nik_user = Auth::user()->nik;
        return view('dashboard.user.tiket-self', [
            'user' => $nik_user,
        ]);
    }

    public function detail_ticket($id)
    {
        $user = Auth::user()->nik;
        $tiket_detail = Tiket::where('id', $id)->first();
        return view('dashboard.user.ticket-detail', [
            'user' => $user,
            'tiket' => $tiket_detail,
        ]);
    }
}

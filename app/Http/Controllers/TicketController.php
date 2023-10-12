<?php

namespace App\Http\Controllers;

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
}

<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;


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
    public function create_ticket_problem(Request $request)
    {
        $user = Auth::user();
        return view('ticket.create-problem', [
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

    public function revise_ticket($id)
    {
        $user = Auth::user();
        $tiket_detail = Tiket::where('id', $id)->first();
        if ($tiket_detail->status_tiket == 'Canceled' || $tiket_detail->status_tiket == 'Rejected') {
            return view('dashboard.user.ticket-revise', [
                'user' => $user,
                'tiket' => $tiket_detail,
            ]);
        } else {
            return Redirect::to('/');
        }
    }

    public function downloadFile($filename)
    {
        $filePath = 'uploads/' . $filename;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404);
        }

        return Storage::disk('public')->download($filePath);
    }
}

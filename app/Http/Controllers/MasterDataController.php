<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class MasterDataController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function master_kategori()
    {
        // $user = Auth::user();
        // $daftar_tiket = Tiket::all();

        $daftar_kategori = Kategori::all();

        return view('admin.master.kategori', [
            'daftar_kategori' => $daftar_kategori,
        ]);
    }
}

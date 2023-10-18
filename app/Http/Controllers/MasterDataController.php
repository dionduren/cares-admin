<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Subkategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function submit_kategori(Request $request)
    {
        $user = Auth::user()->nama;
        $last_order = Kategori::where('sort_order', '!=', 999)->orderBy('sort_order', 'desc')->first()->sort_order;

        $db_raw_data = [
            'sort_order' => $last_order + 1,
            'nama_kategori' => $request->input('nama_kategori'),
            'updated_by' => $user,
            'created_by' => $user,
        ];

        return Kategori::create($db_raw_data);
    }

    public function edit_kategori(Request $request)
    {
        $user = Auth::user()->nama;

        return Kategori::where('id', $request->input('id_kategori'))->update([
            'nama_kategori' => $request->input('nama_kategori'),
            'updated_by' => $user,
        ]);
    }

    public function delete_kategori(Request $request)
    {
        // TODO: delete history/activity history
        return Kategori::where('id', $request->input('id_kategori'))->delete();
    }
}

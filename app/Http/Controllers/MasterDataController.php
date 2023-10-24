<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\ActivityLog;
use App\Models\Subkategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HelperController;

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
    public function helpdesk_ticket_list()
    {

        return view('admin.master.ticket-list');
    }

    public function master_kategori()
    {

        return view('admin.master.kategori');
    }

    public function submit_kategori(Request $request)
    {
        $user = Auth::user()->nama;
        $nama_kategori = $request->input('nama_kategori');
        $last_order = Kategori::where('sort_order', '!=', 999)->orderBy('sort_order', 'desc')->first()->sort_order;

        $description_string = 'Menambahkan Data Kategori (' . $nama_kategori . ')';
        HelperController::recordActivity('CREATE', 'Master Data - Kategori', $description_string, $user);

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
        $nama_kategori = $request->input('nama_kategori');

        $prev_kategori = Kategori::where('id', $request->input('id_kategori'))->first();
        $description_string = 'Mengubah Nama Kategori (' . $prev_kategori->nama_kategori . ") menjadi (" . $nama_kategori . ')';
        HelperController::recordActivity('UPDATE', 'Master Data - Kategori', $description_string, $user);

        return Kategori::where('id', $request->input('id_kategori'))->update([
            'nama_kategori' => $nama_kategori,
            'updated_by' => $user,
        ]);
    }

    public function delete_kategori(Request $request)
    {
        $user = Auth::user()->nama;

        $kategori = Kategori::where('id', $request->input('id_kategori'))->first();
        $id = $kategori->id;
        $nama_kategori = $kategori->nama_kategori;
        $description_string = 'Menghapus Data Kategori (' . $nama_kategori . ')';
        HelperController::recordActivity('DELETE', 'Master Data - Kategori', $description_string, $user);

        return Kategori::where('id', $id)->delete();
    }

    public function master_sub_kategori()
    {

        return view('admin.master.subkategori');
    }

    public function submit_subkategori(Request $request)
    {
        $user = Auth::user()->nama;
        $id_kategori = $request->input('id_kategori');
        $nama_kategori = $request->input('nama_kategori');
        $nama_subkategori = $request->input('nama_subkategori');

        $description_string = 'Menambahkan Data Subkategori (' . $nama_subkategori . ') untuk Kategori (' . $nama_kategori . ')';
        HelperController::recordActivity('CREATE', 'Master Data - Kategori', $description_string, $user);

        $db_raw_data = [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $nama_kategori,
            'nama_subkategori' => $nama_subkategori,
            'updated_by' => $user,
            'created_by' => $user,
        ];

        return Subkategori::create($db_raw_data);
    }

    public function edit_subkategori(Request $request)
    {
        $user = Auth::user()->nama;
        $id_kategori = $request->input('id_kategori');
        $nama_kategori = $request->input('nama_kategori');
        $nama_subkategori = $request->input('nama_subkategori');

        $prev_subkategori = Subkategori::where('id', $request->input('id_subkategori'))->first();
        $description_string = 'Mengubah Data Subkategori (' . $prev_subkategori->nama_subkategori . ') Kategori (' . $prev_subkategori->nama_kategori . ') Menjadi Subkategori (' . $nama_subkategori . ') di Kategori (' . $nama_kategori . ') ';
        HelperController::recordActivity('UPDATE', 'Master Data - Kategori', $description_string, $user);

        return Subkategori::where('id', $request->input('id_subkategori'))->update([
            'id_kategori' => $id_kategori,
            'nama_kategori' => $nama_kategori,
            'nama_subkategori' => $nama_subkategori,
            'updated_by' => $user,
        ]);
    }

    public function delete_subkategori(Request $request)
    {
        $user = Auth::user()->nama;

        $subkategori = Subkategori::where('id', $request->input('id_subkategori'))->first();
        $id = $subkategori->id;
        $nama_kategori = $subkategori->nama_kategori;
        $nama_subkategori = $subkategori->nama_subkategori;
        $description_string = 'Menghapus Data Subkategori (' . $nama_subkategori . ' [' . $id . ']) dari Kategori (' . $nama_kategori . ')';
        HelperController::recordActivity('DELETE', 'Master Data - Subkategori', $description_string, $user);

        return Subkategori::where('id', $request->input('id_subkategori'))->delete();
    }
}

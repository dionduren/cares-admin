<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tiket;

use Illuminate\Http\Request;
use App\Models\KnowledgeManagement;
use App\Models\Master\TipeSLA;

class APITiket extends Controller
{

    function created_ticket_list($id)
    {
        $list_tiket = Tiket::where('user_id_creator', $id)->get();
        return response()->json($list_tiket);
    }

    function get_sla_type(Request $request)
    {
        $tipe_tiket = $request->input('tipe_tiket');
        $tipe_sla = $request->input('tipe_sla');
        $nama_sla = TipeSLA::where('tipe_sla', $tipe_sla)->where('tipe_tiket', $tipe_tiket)->first();
        return response()->json($nama_sla);
    }

    public function list_all_ticket()
    {
        $list_tiket = Tiket::all();
        return response()->json($list_tiket);
    }

    public function ticket_detail($id)
    {
        $detail_tiket = Tiket::where('id', $id)->first();
        return response()->json($detail_tiket);
    }

    // ==================== HELPDESK ====================

    public function helpdesk_list_submitted()
    {
        // Cek benerin alur request dulu
        $list_tiket = Tiket::where('id_status_tiket', '1')->get();
        // $list_tiket = Tiket::all();
        return response()->json($list_tiket);
    }

    public function helpdesk_list_assigned()
    {
        $list_tiket = Tiket::where('id_status_tiket', '2')->get();
        return response()->json($list_tiket);
    }

    public function helpdesk_list_resolved()
    {
        $list_tiket = Tiket::where('id_status_tiket', '4')->get();
        return response()->json($list_tiket);
    }

    // ==================== TEAMLEAD ====================

    public function teamlead_waiting_list($id)
    {
        $list_tiket = Tiket::where('id_status_tiket', '2')->where('id_group', $id)->get();
        return response()->json($list_tiket);
    }

    public function teamlead_ongoing_list($id)
    {
        $list_tiket = Tiket::where('id_status_tiket', '3')->where('id_group', $id)->get();
        return response()->json($list_tiket);
    }

    public function teamlead_finished($id)
    {
        $list_tiket = Tiket::where('id_status_tiket', '4')->where('id_group', $id)->get();
        return response()->json($list_tiket);
    }

    // ==================== TECHNICAL ====================

    public function technical_ongoing_list($id)
    {
        $list_tiket = Tiket::where('id_status_tiket', '3')->where('id_technical', $id)->get();
        // $list_tiket = Tiket::where('id_technical', $id)->get();
        return response()->json($list_tiket);
    }

    public function technical_finished($id)
    {
        $list_tiket = Tiket::where('id_status_tiket', '4')->where('id_technical', $id)->get();
        return response()->json($list_tiket);
    }

    // ==================== Knowledge Management ====================

    function solution_list($id)
    {
        $id_kategori = Tiket::where('id', $id)->first()->id_kategori;
        $list_solusi = KnowledgeManagement::where('id_kategori', $id_kategori)->get();
        return response()->json($list_solusi);
    }

    function submit_solution(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $id_solusi = $request->input('id_solusi');
        $id_technical = $request->input('nik');
        $nama_technical = User::where('nik', $id_technical)->first()->nama;

        // Perhitungan Action Time = FINISHED
        $info_tiket = Tiket::where('id', $id_tiket)->first();
        $start_time = $info_tiket->updated_at;
        $end_time   = now();
        // TODO: change actiontime to sla
        // $durasi_float = HelperController::hitungBusinessSLA($start_time, $end_time);
        // $durasi = floor($durasi_float);

        Tiket::where('id', $id_tiket)->update([
            'id_solusi' => $id_solusi,
            'status_tiket' => 'Finished',
            'updated_by' => $nama_technical,
        ]);

        // // TODO: change actiontime to SLA
        // ActionTime::create([
        //     'id_tiket' => $id_tiket,
        //     'action' => 'FINISHED',
        //     'start_time' => $start_time,
        //     'end_time' => $end_time,
        //     'durasi_total' => sprintf("%.3f", $durasi_float),
        //     'durasi' => $durasi,
        //     'created_by' => $nama_technical,
        // ]);

        return response()->json([
            'success' => true,
        ], 201);
    }

    function submit_new_solution(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $judul_solusi = $request->input('judul_solusi');
        $detail_solusi = $request->input('detail_solusi');
        $id_technical = $request->input('nik');
        $nama_technical = User::where('nik', $id_technical)->first()->nama;

        $info_tiket = Tiket::where('id', $id_tiket)->first();

        // Perhitungan Action Time = FINISHED
        $start_time = $info_tiket->updated_at;
        $end_time   = now();
        // TODO: change actiontime to sla
        // $durasi_float = HelperController::hitungBusinessSLA($start_time, $end_time);
        // $durasi = floor($durasi_float);

        $id_solusi = KnowledgeManagement::create([
            'tipe_tiket' => $info_tiket->tipe_tiket,
            'id_kategori' => $info_tiket->id_kategori,
            'kategori_tiket' => $info_tiket->kategori_tiket,
            'id_subkategori' => $info_tiket->id_subkategori,
            'subkategori_tiket' => $info_tiket->subkategori_tiket,
            'id_item_kategori' => $info_tiket->id_item_kategori,
            'item_kategori_tiket' => $info_tiket->item_kategori_tiket,
            'judul_solusi' => $judul_solusi,
            'detail_solusi' => $detail_solusi,
            'created_by' => $nama_technical,
            'updated_by' => $nama_technical,
        ]);

        Tiket::where('id', $id_tiket)->update([
            'id_solusi' => $id_solusi->id,
            'status_tiket' => 'Finished',
            'updated_by' => $nama_technical,
        ]);

        // TODO: change actiontime to sla
        // ActionTime::create([
        //     'id_tiket' => $id_tiket,
        //     'action' => 'FINISHED',
        //     'start_time' => $start_time,
        //     'end_time' => $end_time,
        //     'durasi_total' => sprintf("%.3f", $durasi_float),
        //     'durasi' => $durasi,
        //     'created_by' => $nama_technical,
        // ]);

        return response()->json([
            'success' => true,
        ], 201);
    }

    function close_tiket()
    {

        // create metode close tiket
    }
}
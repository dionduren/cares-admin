<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Tiket;
use Illuminate\Http\Request;

use App\Models\Master\TipeSLA;
use Illuminate\Support\Carbon;
use App\Models\Transaction\SLA;
use App\Models\Master\StatusTiket;
use App\Models\KnowledgeManagement;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Master\SAPUserDetail;
use App\Models\Transaction\Attachment;

class APITiket extends Controller
{

    function created_ticket_list($id)
    {
        $list_tiket = Tiket::where('user_id_creator', $id)->get(['id', 'id_status_tiket', 'nomor_tiket', 'tipe_tiket', 'judul_tiket', 'kategori_tiket', 'subkategori_tiket', 'item_kategori_tiket', 'status_tiket', 'created_at', 'updated_at']);
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

    public function ticket_attachments($id)
    {
        $tiket_attachments = Attachment::where('id_tiket', $id)->get(['nama_file_altered', 'file_location']);
        return response()->json($tiket_attachments);
    }

    // ==================== HELPDESK ====================

    public function helpdesk_list_submitted()
    {
        // Cek benerin alur request dulu
        $list_tiket = Tiket::where('id_status_tiket', '1')->get(['id', 'id_status_tiket', 'nomor_tiket', 'tipe_tiket', 'judul_tiket', 'kategori_tiket', 'subkategori_tiket', 'item_kategori_tiket', 'status_tiket', 'created_by',   'created_at', 'updated_at']);
        // $list_tiket = Tiket::all();
        return response()->json($list_tiket);
    }

    public function helpdesk_list_assigned()
    {
        $list_tiket = Tiket::where('id_status_tiket', '2')->orWhere('id_status_tiket', '3')->get(['id', 'id_status_tiket', 'nomor_tiket', 'tipe_tiket', 'judul_tiket', 'kategori_tiket', 'subkategori_tiket', 'item_kategori_tiket', 'status_tiket', 'created_by',   'created_at', 'updated_at']);
        return response()->json($list_tiket);
    }

    public function helpdesk_list_resolved()
    {
        $list_tiket = Tiket::where('id_status_tiket', '4')->get(['id', 'id_status_tiket', 'nomor_tiket', 'tipe_tiket', 'judul_tiket', 'kategori_tiket', 'subkategori_tiket', 'item_kategori_tiket', 'status_tiket',  'created_by',  'created_at', 'updated_at']);
        return response()->json($list_tiket);
    }

    // ==================== TEAMLEAD ====================

    public function teamlead_waiting_list($id)
    {
        $list_tiket = Tiket::where('id_status_tiket', '2')->where('id_group', $id)->get(['id', 'id_status_tiket', 'nomor_tiket', 'tipe_tiket', 'judul_tiket', 'kategori_tiket', 'subkategori_tiket', 'item_kategori_tiket', 'status_tiket',  'created_by',  'created_at', 'updated_at']);
        return response()->json($list_tiket);
    }

    public function teamlead_ongoing_list($id)
    {
        $list_tiket = Tiket::where('id_status_tiket', '3')->where('id_group', $id)->get(['id', 'id_status_tiket', 'nomor_tiket', 'tipe_tiket', 'judul_tiket', 'kategori_tiket', 'subkategori_tiket', 'item_kategori_tiket', 'status_tiket',  'created_by',  'created_at', 'updated_at']);
        return response()->json($list_tiket);
    }

    public function teamlead_finished($id)
    {
        $list_tiket = Tiket::where('id_status_tiket', '4')->where('id_group', $id)->get(['id', 'id_status_tiket', 'nomor_tiket', 'tipe_tiket', 'judul_tiket', 'kategori_tiket', 'subkategori_tiket', 'item_kategori_tiket', 'status_tiket',  'created_by',  'created_at', 'updated_at']);
        return response()->json($list_tiket);
    }

    // ==================== TECHNICAL ====================

    public function technical_ongoing_list($id)
    {
        $list_tiket = Tiket::where('id_status_tiket', '3')->where('id_technical', $id)->get(['id', 'id_status_tiket', 'nomor_tiket', 'tipe_tiket', 'judul_tiket', 'kategori_tiket', 'subkategori_tiket', 'item_kategori_tiket', 'status_tiket', 'created_by',   'created_at', 'updated_at']);
        // $list_tiket = Tiket::where('id_technical', $id)->get();
        return response()->json($list_tiket);
    }

    public function technical_finished($id)
    {
        $list_tiket = Tiket::where('id_status_tiket', '4')->where('id_technical', $id)->get(['id', 'id_status_tiket', 'nomor_tiket', 'tipe_tiket', 'judul_tiket', 'kategori_tiket', 'subkategori_tiket', 'item_kategori_tiket', 'status_tiket', 'created_by',  'created_at', 'updated_at']);
        return response()->json($list_tiket);
    }

    // ==================== SLA List ===========

    public function master_sla_list()
    { // $list_tiket = Tiket::all(['id', 'company_name', 'id_status_tiket', 'nomor_tiket', 'tipe_tiket', 'judul_tiket', 'kategori_tiket', 'subkategori_tiket', 'item_kategori_tiket', 'assigned_group', 'assigned_technical', 'id_solusi', 'status_tiket', 'created_by',  'created_at', 'updated_at']);
        // $detail_requester = SAPUserDetail::where('nama', $list_ticket->created_by)->get(['komp_title', 'org_title', 'pos_title', 'pos_grade', 'pos_kategori']);
        // $sla_response = SLA::where('id_tiket', $list_ticket->id)->where('tipe_sla', 'Response')->get(['sla_hours_target', 'business_elapsed_time',]);
        // $sla_resolve = SLA::where('id_tiket', $list_ticket->id->where('tipe_sla', 'Resolve'))->get([]);
        // return response()->json($list_tiket);

        $list_tiket = Tiket::with([
            'sapUserDetail' => function ($query) {
                $query->select(['emp_no', 'nama', 'komp_title', 'org_title', 'pos_title', 'pos_grade', 'pos_kategori']);
            },
            'slaResponse' => function ($query) {
                $query->where('kategori_sla', 'Response')
                    ->select(['id_tiket', 'sla_hours_target', 'business_elapsed_time', 'business_time_percentage']);
            },
            'slaResolve' => function ($query) {
                $query->where('kategori_sla', 'Resolve')
                    ->select(['id_tiket', 'sla_hours_target', 'business_elapsed_time', 'business_time_percentage']);
            }
        ])->get([
            'id', 'user_id_creator', 'company_name', 'nomor_tiket', 'tipe_tiket', 'judul_tiket',
            'kategori_tiket', 'subkategori_tiket', 'item_kategori_tiket', 'assigned_group',
            'assigned_technical', 'id_solusi', 'detail_solusi', 'status_tiket', 'created_by', 'created_at', 'updated_at'
        ]);

        return response()->json($list_tiket);
    }

    // ==================== Knowledge Management ====================

    function solution_list($id)
    {
        $id_item_kategori = Tiket::where('id', $id)->first()->id_item_kategori;
        if ($id_item_kategori == null) {
            $id_subkategori = Tiket::where('id', $id)->first()->id_subkategori;
            $list_solusi = KnowledgeManagement::where('id_subkategori', $id_subkategori)->get();
        } else {
            $list_solusi = KnowledgeManagement::where('id_item_kategori', $id_item_kategori)->get();
        }

        return response()->json($list_solusi);
    }

    function submit_solution(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $tipe_tiket = Tiket::where('id', $id_tiket)->first()->tipe_tiket;
        $id_solusi = $request->input('id_solusi');
        $id_technical = $request->input('nik');
        $nama_technical = User::where('nik', $id_technical)->first()->nama;

        // set status ticket
        $status_tiket = StatusTiket::where('flow_number', 4)->where('tipe_tiket', $tipe_tiket)->first();

        Tiket::where('id', $id_tiket)->update([
            'id_status_tiket' => $status_tiket->flow_number,
            'status_tiket' => $status_tiket->nama_status,
            'id_solusi' => $id_solusi,
            'updated_by' => $nama_technical,
        ]);

        // Step-1 Update SLA Response
        $sla_response = SLA::where('id_tiket', $id_tiket)->where('kategori_sla', 'Resolve')->first();
        $business_start_time = Carbon::parse($sla_response->business_start_time);
        $actual_start_time = Carbon::parse($sla_response->actual_start_time);
        $end_time   = now();

        // Hitung waktu untuk SLA response
        $businessSLA = HelperController::hitungBusinessSLA($business_start_time, $end_time);
        $businessSLA_string = $businessSLA['days'] . ' Hari ' . $businessSLA['hours'] . ' Jam '  . $businessSLA['minutes'] . ' Menit ' . $businessSLA['seconds'] . ' Detik';
        $actualSLA = HelperController::hitungActualSLA($actual_start_time, $end_time);
        $actualSLA_string = $actualSLA['days'] . ' Hari ' . $actualSLA['hours'] . ' Jam '  . $actualSLA['minutes'] . ' Menit ' . $actualSLA['seconds'] . ' Detik';

        // hitung persentase jam SLA business dan actual
        $durasi_jam = SLA::where('id_tiket', $id_tiket)->where('kategori_sla', 'Resolve')->first()->sla_hours_target;

        $business_total_duration = ($businessSLA['days'] * 86400) + ($businessSLA['hours'] * 3600) + ($businessSLA['minutes'] * 60) + $businessSLA['seconds'];
        $business_percentage = $business_total_duration / ($durasi_jam * 3600) * 100;
        $business_percentage_formatted = number_format($business_percentage, 2, '.', '');

        $actual_total_duration = ($actualSLA['days'] * 86400) + ($actualSLA['hours'] * 3600) + ($actualSLA['minutes'] * 60) + $actualSLA['seconds'];
        $actual_percentage = $actual_total_duration / ($durasi_jam * 3600) * 100;
        $actual_percentage_formatted = number_format($actual_percentage, 2, '.', '');


        SLA::where('id_tiket', $id_tiket)->where('kategori_sla', 'Resolve')->update([
            'business_stop_time' => HelperController::getEndBusinessTime(),
            'business_days' => $businessSLA['days'],
            'business_hours' => $businessSLA['hours'],
            'business_minutes' => $businessSLA['minutes'],
            'business_seconds' => $businessSLA['seconds'],
            'business_elapsed_time' => $businessSLA_string,
            'business_time_percentage' => $business_percentage_formatted,
            'actual_stop_time' => now(),
            'actual_days' => $actualSLA['days'],
            'actual_hours' => $actualSLA['hours'],
            'actual_minutes' => $actualSLA['minutes'],
            'actual_seconds' => $actualSLA['seconds'],
            'actual_elapsed_time' => $actualSLA_string,
            'actual_time_percentage' => $actual_percentage_formatted,
            'updated_by' => $nama_technical,
        ]);

        return response()->json([
            'success' => true,
        ], 201);
    }

    function submit_new_solution(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $tipe_tiket = Tiket::where('id', $id_tiket)->first()->tipe_tiket;
        $id_solusi = $request->input('id_solusi');
        $judul_solusi = $request->input('judul_solusi');
        $detail_solusi = $request->input('detail_solusi');
        $id_technical = $request->input('nik');
        $nama_technical = User::where('nik', $id_technical)->first()->nama;

        $info_tiket = Tiket::where('id', $id_tiket)->first();

        KnowledgeManagement::create([
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

        // set status ticket
        $status_tiket = StatusTiket::where('flow_number', 4)->where('tipe_tiket', $tipe_tiket)->first();

        Tiket::where('id', $id_tiket)->update([
            'id_status_tiket' => $status_tiket->flow_number,
            'status_tiket' => $status_tiket->nama_status,
            'id_solusi' => $id_solusi,
            'judul_solusi' => $judul_solusi,
            'detail_solusi' => $detail_solusi,
            // 'penjelasan_solusi' => $judul_solusi,
            'updated_by' => $nama_technical,
        ]);

        // Step-1 Update SLA Response
        $sla_response = SLA::where('id_tiket', $id_tiket)->where('kategori_sla', 'Resolve')->first();
        $business_start_time = Carbon::parse($sla_response->business_start_time);
        $actual_start_time = Carbon::parse($sla_response->actual_start_time);
        $end_time   = now();

        // Hitung waktu untuk SLA response
        $businessSLA = HelperController::hitungBusinessSLA($business_start_time, $end_time);
        $businessSLA_string = $businessSLA['days'] . ' Hari ' . $businessSLA['hours'] . ' Jam '  . $businessSLA['minutes'] . ' Menit ' . $businessSLA['seconds'] . ' Detik';
        $actualSLA = HelperController::hitungActualSLA($actual_start_time, $end_time);
        $actualSLA_string = $actualSLA['days'] . ' Hari ' . $actualSLA['hours'] . ' Jam '  . $actualSLA['minutes'] . ' Menit ' . $actualSLA['seconds'] . ' Detik';

        // hitung persentase jam SLA business dan actual
        $durasi_jam = SLA::where('id_tiket', $id_tiket)->where('kategori_sla', 'Resolve')->first()->sla_hours_target;

        $business_total_duration = ($businessSLA['days'] * 86400) + ($businessSLA['hours'] * 3600) + ($businessSLA['minutes'] * 60) + $businessSLA['seconds'];
        $business_percentage = $business_total_duration / ($durasi_jam * 3600) * 100;
        $business_percentage_formatted = number_format($business_percentage, 2, '.', '');

        $actual_total_duration = ($actualSLA['days'] * 86400) + ($actualSLA['hours'] * 3600) + ($actualSLA['minutes'] * 60) + $actualSLA['seconds'];
        $actual_percentage = $actual_total_duration / ($durasi_jam * 3600) * 100;
        $actual_percentage_formatted = number_format($actual_percentage, 2, '.', '');


        SLA::where('id_tiket', $id_tiket)->where('kategori_sla', 'Resolve')->update([
            'business_stop_time' => HelperController::getEndBusinessTime(),
            'business_days' => $businessSLA['days'],
            'business_hours' => $businessSLA['hours'],
            'business_minutes' => $businessSLA['minutes'],
            'business_seconds' => $businessSLA['seconds'],
            'business_elapsed_time' => $businessSLA_string,
            'business_time_percentage' => $business_percentage_formatted,
            'status_sla' => "Finished",
            'actual_stop_time' => now(),
            'actual_days' => $actualSLA['days'],
            'actual_hours' => $actualSLA['hours'],
            'actual_minutes' => $actualSLA['minutes'],
            'actual_seconds' => $actualSLA['seconds'],
            'actual_elapsed_time' => $actualSLA_string,
            'actual_time_percentage' => $actual_percentage_formatted,
            'updated_by' => $nama_technical,
        ]);

        return response()->json([
            'success' => true,
        ], 201);
    }

    function close_tiket(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $tipe_tiket = Tiket::where('id', $id_tiket)->first()->tipe_tiket;
        $id_technical = $request->input('nik');
        $nama_technical = User::where('nik', $id_technical)->first()->nama;

        // set status ticket
        $status_tiket = StatusTiket::where('flow_number', 5)->where('tipe_tiket', $tipe_tiket)->first();

        Tiket::where('id', $id_tiket)->update([
            'id_status_tiket' => $status_tiket->flow_number,
            'status_tiket' => $status_tiket->nama_status,
            'rating_kepuasan' => 3,
            'updated_by' => $nama_technical,
        ]);


        return response()->json([
            'success' => true,
        ], 201);
    }

    function close_tiket_comment(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $tipe_tiket = Tiket::where('id', $id_tiket)->first()->tipe_tiket;
        $id_technical = $request->input('nik');
        $nama_technical = User::where('nik', $id_technical)->first()->nama;
        $rating_kepuasan = $request->input('rating_kepuasan');
        $catatan_kepuasan = $request->input('catatan_kepuasan');

        // set status ticket
        $status_tiket = StatusTiket::where('flow_number', 5)->where('tipe_tiket', $tipe_tiket)->first();

        Tiket::where('id', $id_tiket)->update([
            'id_status_tiket' => $status_tiket->flow_number,
            'status_tiket' => $status_tiket->nama_status,
            'rating_kepuasan' => $rating_kepuasan,
            'catatan_kepuasan' => $catatan_kepuasan,
            'updated_by' => $nama_technical,
        ]);


        return response()->json([
            'success' => true,
        ], 201);
    }
}

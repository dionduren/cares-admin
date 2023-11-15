<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tiket;
use App\Models\HariLibur;
use App\Models\GrupMember;
use Illuminate\Http\Request;

use App\Models\GrupTechnical;
use App\Models\Master\TipeSLA;
use Illuminate\Support\Carbon;
use App\Models\Transaction\SLA;
use App\Models\Master\StatusTiket;
use App\Models\KnowledgeManagement;

class APIGroup extends Controller
{
    function technical_group_list()
    {
        $list_group = GrupTechnical::all();
        return response()->json($list_group);
    }

    function technical_list($id)
    {
        $id_group = Tiket::where('id', $id)->first()->id_group;
        $list_technical = GrupMember::where('id_group', $id_group)->get();
        return response()->json($list_technical);
    }

    public function get_group_id($id)
    {
        $group_id = GrupMember::where('nik_member', $id)->first()->id_group;
        return response()->json($group_id);
    }

    public function get_teamlead_status($id)
    {
        $isTeamLead = GrupMember::where('nik_member', $id)->where('role_member', 'Team Leader')->exists();
        return response()->json($isTeamLead);
    }

    function tiket_assign_group(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $tipe_tiket = $request->input('tipe_tiket');
        $level_urgensi = $request->input('tingkat_urgensi');
        $level_dampak = $request->input('tingkat_dampak');
        $level_prioritas = $request->input('tingkat_prioritas');

        $tipe_sla = $request->input('tipe_sla');

        $id_group = $request->input('id_group');
        $nik =  $request->input('nik');
        $nama_group = GrupTechnical::where('id', $id_group)->first()->nama_group;
        $helpdesk_agent = User::where('nik', $nik)->first();

        // set status ticket
        $status_tiket = StatusTiket::where('flow_number', 2)->where('tipe_tiket', $tipe_tiket)->first();

        Tiket::where('id', $id_tiket)->update([
            'level_dampak' => $level_dampak,
            'level_urgensi' => $level_urgensi,
            'level_prioritas' => $level_prioritas,
            'id_group' => $id_group,
            'assigned_group' => $nama_group,
            'id_status_tiket' => $status_tiket->flow_number,
            'status_tiket' => $status_tiket->nama_status,
            'updated_by' => $helpdesk_agent->nama,
        ]);

        // Step-1 Update SLA Response
        $sla_response = SLA::where('id_tiket', $id_tiket)->where('kategori_sla', 'Response')->first();
        $business_start_time = Carbon::parse($sla_response->business_start_time);
        $actual_start_time = Carbon::parse($sla_response->actual_start_time);
        $end_time   = now();

        // Hitung waktu untuk SLA response
        $businessSLA = HelperController::hitungBusinessSLA($business_start_time, $end_time);
        $businessSLA_string = $businessSLA['days'] . ' Hari ' . $businessSLA['hours'] . ' Jam '  . $businessSLA['minutes'] . ' Menit ' . $businessSLA['seconds'] . ' Detik';
        $actualSLA = HelperController::hitungActualSLA($actual_start_time, $end_time);
        $actualSLA_string = $actualSLA['days'] . ' Hari ' . $actualSLA['hours'] . ' Jam '  . $actualSLA['minutes'] . ' Menit ' . $actualSLA['seconds'] . ' Detik';

        SLA::where('id_tiket', $id_tiket)->where('kategori_sla', 'Response')->update([
            'business_stop_time' => HelperController::getEndBusinessTime(),
            'business_days' => $businessSLA['days'],
            'business_hours' => $businessSLA['hours'],
            'business_minutes' => $businessSLA['minutes'],
            'business_seconds' => $businessSLA['seconds'],
            'business_elapsed_time' => $businessSLA_string,
            'actual_stop_time' => now(),
            'actual_days' => $actualSLA['days'],
            'actual_hours' => $actualSLA['hours'],
            'actual_minutes' => $actualSLA['minutes'],
            'actual_seconds' => $actualSLA['seconds'],
            'actual_elapsed_time' => $actualSLA_string,
            'updated_by' => $helpdesk_agent->nama,
        ]);

        // Step-2 Create SLA Resolve
        $sla_resolve = TipeSLA::where('nama_sla', $tipe_sla)->first();

        SLA::create([
            'id_sla' => $sla_resolve->id,
            'kategori_sla' => 'Resolve',
            'tipe_sla' => $sla_resolve->nama_sla,
            'sla_hours_target' => $sla_resolve->durasi_jam,
            'id_tiket' => $id_tiket,
            'business_start_time' => now(),
            'status_sla' => "On Progress",
            'actual_start_time' => now(),
            'updated_by' => $helpdesk_agent->nama,
            'created_by' => $helpdesk_agent->nama,
        ]);


        return response()->json([
            'success' => true,
        ], 201);
    }


    function tiket_assign_technical(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $id_technical = $request->input('id_technical');
        $nama_technical = User::where('nik', $id_technical)->first()->nama;
        $id_teamlead = $request->input('nik');
        $nama_teamlead = User::where('nik', $id_teamlead)->first()->nama;

        // Perhitungan Action Time = TECHNICAL ASSIGNED
        $info_tiket = Tiket::where('id', $id_tiket)->first();
        $start_time = $info_tiket->updated_at;
        $end_time   = now();
        $businessSLA = HelperController::hitungBusinessSLA($start_time, $end_time);
        $businessSLA_string = sprintf(
            "%02d days %02d hours %02d minutes %02d seconds",
            $businessSLA['days'],
            $businessSLA['hours'],
            $businessSLA['minutes'],
            $businessSLA['seconds']
        );
        // $businessSLA_string = $businessSLA['days'] + ' Hari ' + $businessSLA['hours'] + ' Jam '  + $businessSLA['minutes'] + ' Menit' + $businessSLA['minutes'] + ' Detik';
        $actualSLA = HelperController::hitungActualSLA($start_time, $end_time);
        // $actualSLA_string = $actualSLA['days'] + ' Hari ' + $actualSLA['hours'] + ' Jam '  + $actualSLA['minutes'] + ' Menit' + $actualSLA['minutes'] + ' Detik';
        $actualSLA_string = sprintf(
            "%02d days %02d hours %02d minutes %02d seconds",
            $actualSLA['days'],
            $actualSLA['hours'],
            $actualSLA['minutes'],
            $actualSLA['seconds']
        );

        \dd($businessSLA_string);
        \dd($actualSLA_string);


        // $durasi_float = HelperController::hitungBusinessSLA($start_time, $end_time);
        // $durasi = floor($durasi_float);

        Tiket::where('id', $id_tiket)->update([
            'id_technical' => $id_technical,
            'assigned_technical' => $nama_technical,
            'updated_by' => $nama_teamlead,
        ]);

        // ActionTime::create([
        //     'id_tiket' => $id_tiket,
        //     'action' => 'TECHNICAL ASSIGNED',
        //     'start_time' => $start_time,
        //     'end_time' => $end_time,
        //     'durasi_total' => sprintf("%.3f", $durasi_float),
        //     'durasi' => $durasi,
        //     'created_by' => $nama_teamlead,
        // ]);

        return response()->json([
            'success' => true,
        ], 201);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tiket;
use App\Models\HariLibur;
use App\Models\GrupMember;
use Illuminate\Http\Request;

use App\Models\GrupTechnical;
use Illuminate\Support\Carbon;
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
        $id_group = $request->input('id_group');
        $nik =  $request->input('nik');
        $nama_group = GrupTechnical::where('id', $id_group)->first()->nama_group;
        $helpdesk_agent = User::where('nik', $nik)->first();

        // Tiket::where('id', $id_tiket)->update([
        //     'id_group' => $id_group,
        //     'assigned_group' => $nama_group,
        //     'status_tiket' => 'Assigned',
        //     'updated_by' => $helpdesk_agent->nama,
        // ]);

        $info_tiket = Tiket::where('id', $id_tiket)->first();
        $start_time = $info_tiket->created_at;
        $end_time   = now();

        // Hitung waktu untuk SLA
        $businessSLA = HelperController::hitungBusinessSLA($start_time, $end_time);
        $businessSLA_string = $businessSLA['days'] . ' Hari ' . $businessSLA['hours'] . ' Jam '  . $businessSLA['minutes'] . ' Menit ' . $businessSLA['seconds'] . ' Detik';
        $actualSLA = HelperController::hitungActualSLA($start_time, $end_time);
        $actualSLA_string = $actualSLA['days'] . ' Hari ' . $actualSLA['hours'] . ' Jam '  . $actualSLA['minutes'] . ' Menit ' . $actualSLA['seconds'] . ' Detik';

        // \dd($businessSLA_string);
        // \dd($actualSLA_string);


        // TODO: change actiontime to sla
        // $durasi_float = HelperController::hitungBusinessSLA($start_time, $end_time);
        // $durasi = floor($durasi_float);

        // TODO: change actiontime to sla
        // ActionTime::create([
        //     'id_tiket' => $id_tiket,
        //     'action' => 'ASSIGNED',
        //     'start_time' => $start_time,
        //     'end_time' => $end_time,
        //     // 'durasi_total' => $durasi_float,
        //     'durasi_total' => sprintf("%.3f", $durasi_float),
        //     'durasi' => $durasi,
        //     'created_by' => $helpdesk_agent->nama,
        // ]);

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

<?php

namespace App\Http\Controllers;

use App\Models\ActionTime;
use App\Models\GrupMember;
use App\Models\KnowledgeManagement;
use App\Models\Tiket;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class APITiket extends Controller
{

    function created_ticket_list($id)
    {
        $list_tiket = Tiket::where('user_id_creator', $id)->get();
        return response()->json($list_tiket);
    }

    public function helpdesk_list_submitted()
    {
        $list_tiket = Tiket::where('status_tiket', 'Submitted')->get();
        return response()->json($list_tiket);
    }

    public function helpdesk_list_assigned()
    {
        $list_tiket = Tiket::where('status_tiket', 'Assigned')->get();
        return response()->json($list_tiket);
    }

    public function helpdesk_detail($id)
    {
        $detail_tiket = Tiket::where('id', $id)->first();
        return response()->json($detail_tiket);
    }

    public function teamlead_waiting_list($id)
    {
        $list_tiket = Tiket::where('id_group', $id)->whereNull('id_technical')->get();
        return response()->json($list_tiket);
    }

    public function teamlead_ongoing_list($id)
    {
        $list_tiket = Tiket::where('id_group', $id)->whereNotNull('id_technical')->get();
        return response()->json($list_tiket);
    }

    public function teamlead_finished($id)
    {
        $list_tiket = Tiket::where('id_group', $id)->whereNotNull('id_technical')->where('status_tiket', "Closed")->get();
        return response()->json($list_tiket);
    }


    public function technical_ongoing_list($id)
    {
        $list_tiket = Tiket::where('id_technical', $id)->whereNotIn('status_tiket',['Finished','Closed'])->get();
        // $list_tiket = Tiket::where('id_technical', $id)->get();
        return response()->json($list_tiket);
    }

    public function technical_finished($id)
    {
        $list_tiket = Tiket::where('id_technical', $id)->where('status_tiket', "Closed")->get();
        return response()->json($list_tiket);
    }

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
        $nama_technical = User::where('nik',$id_technical)->first()->nama;

        // Perhitungan Action Time = FINISHED
        $info_tiket = Tiket::where('id', $id_tiket)->first();
        $start_time = $info_tiket->updated_at;
        $end_time   = now();
        $durasi_float = $this->hitungDurasiAction($start_time, $end_time);
        $durasi = floor($durasi_float);

        Tiket::where('id', $id_tiket)->update([
            'id_solusi' => $id_solusi,
            'status_tiket' => 'Finished',
            'updated_by' => $nama_technical,
        ]);

        ActionTime::create([
            'id_tiket' => $id_tiket,
            'action' => 'FINISHED',
            'start_time' => $start_time,
            'end_time' => $end_time,
            'durasi_total' => sprintf("%.3f", $durasi_float),
            'durasi' => $durasi,
            'created_by' => $nama_technical,
        ]);

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
        $nama_technical = User::where('nik',$id_technical)->first()->nama;

        $info_tiket = Tiket::where('id', $id_tiket)->first();
        
        // Perhitungan Action Time = FINISHED
        $start_time = $info_tiket->updated_at;
        $end_time   = now();
        $durasi_float = $this->hitungDurasiAction($start_time, $end_time);
        $durasi = floor($durasi_float);

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
            'created_by' => 'Technical',
            'updated_by' => 'Technical',
        ]);

        Tiket::where('id', $id_tiket)->update([
            'id_solusi' => $id_solusi->id,
            'status_tiket' => 'Finished',
            'updated_by' => 'Technical',        //Todo: Ganti jadi user technical
        ]);

        ActionTime::create([
            'id_tiket' => $id_tiket,
            'action' => 'FINISHED',
            'start_time' => $start_time,
            'end_time' => $end_time,
            'durasi_total' => sprintf("%.3f", $durasi_float),
            'durasi' => $durasi,
            'created_by' => $nama_technical,
        ]);

        return response()->json([
            'success' => true,
        ], 201);
    }

    function close_tiket()
    {

        // create metode close tiket
    }

    private function hitungDurasiAction(Carbon $start, Carbon $end)
    {
        // Set Jam kerja Mulai
        $workStartHour = 7;

        // Set Jam kerja Akhir
        $workEndHour = 19;

        $totalHours = 0;

        // Clone to avoid modifying original
        $current = $start->copy();

        while ($current->lessThan($end)) {
            // If the day is a weekend, skip the entire day
            if (in_array($current->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                $current->addDay()->startOfDay();
                continue;
            }

            // Set the start time of the working day
            $workStart = $current->copy()->hour($workStartHour)->minute(0)->second(0);

            // If current time is before work hours, move it to the start of work hours
            if ($current->lessThan($workStart)) {
                $current = $workStart;
            }

            // Set the end time of the working day
            $workEnd = $current->copy()->hour($workEndHour)->minute(0)->second(0);

            // If the end time is after work hours and on the same day, set to work end time
            if ($end->greaterThan($workEnd) && $end->isSameDay($current)) {
                $end = $workEnd;
            }

            // If current time is after work hours, move to the next working day
            if ($current->greaterThanOrEqualTo($workEnd)) {
                $current->addDay()->startOfDay();
                continue;
            }

            // If the end time is on the same day, add the difference in hours to the total
            if ($end->isSameDay($current)) {
                $totalHours += $current->floatDiffInHours($end);
            } else {
                // If the end time is on a different day, add the remaining hours of the current day
                $totalHours += $current->floatDiffInHours($workEnd);
            }

            // Move to the next day
            $current->addDay()->startOfDay();
        }

        return $totalHours;
    }
}

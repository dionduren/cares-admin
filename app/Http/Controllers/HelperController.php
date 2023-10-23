<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HelperController extends Controller
{
    public static function GetNomorTiket($tipe_tiket)
    {
        $kode_perusahaan = 'PIH';
        $pemilik_layanan = 'TI';
        $jenis_tiket = $tipe_tiket == 'INCIDENT' ? 'INC' : 'REQ';

        $get_nomor = Penomoran::where('tipe_nomor', $tipe_tiket)->first();

        // Get nomor tiket and update
        if ($get_nomor == null) {
            $last_number = 0;
            $current_number = 1;
            Penomoran::create([
                'tipe_nomor' => $tipe_tiket,
                'angka_terakhir' => $current_number,
            ]);
        } else {
            $last_number = $get_nomor->angka_terakhir;
            $current_number = $last_number + 1;

            Penomoran::where('tipe_nomor', $tipe_tiket)->first()->update([
                'angka_terakhir' => $current_number
            ]);
        }


        if ($current_number < 10) {
            $nomor_tiket = '0000' . $current_number;
        } elseif ($current_number < 100) {
            $nomor_tiket = '000' . $current_number;
        } elseif ($current_number < 1000) {
            $nomor_tiket = '00' . $current_number;
        } elseif ($current_number < 10000) {
            $nomor_tiket = '0' . $current_number;
        } else {
            $nomor_tiket = $current_number;
        }

        $format_nomor_tiket = $jenis_tiket . '-' . $kode_perusahaan . '-' . $pemilik_layanan . '-' . $nomor_tiket;

        return $format_nomor_tiket;
    }

    public static function hitungDurasiAction(Carbon $start, Carbon $end)
    {
        // Set Jam kerja Mulai
        $workStartHour = 7;

        // Set Jam kerja Akhir
        $workEndHour = 19;

        $totalHours = 0;

        // Clone to avoid modifying original
        $current = $start->copy();

        // Get public holidays
        $publicHolidays = HariLibur::pluck('date')->all();

        while ($current->lessThan($end)) {
            // If the day is a weekend, skip the entire day
            if (in_array($current->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                $current->addDay()->startOfDay();
                continue;
            }

            // If the day is a public holiday, skip the entire day
            if (in_array($current->toDateString(), $publicHolidays)) {
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

    public static function recordActivity($activity, $object, $description, $user)
    {
        ActivityLog::create([
            'activity' => $activity,
            'object' => $object,
            'description' => $description,
            'created_by' => $user,
        ]);
    }
}

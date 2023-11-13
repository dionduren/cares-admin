<?php

namespace App\Http\Controllers;

use App\Models\HariLibur;
use App\Models\Penomoran;
use App\Models\ActivityLog;
use App\Models\Master\JamKerja;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    public static function GetNomorTiket($kode_perusahaan, $unit_layanan, $tipe_tiket)
    {
        // $kode_perusahaan = 'PIH';
        // $unit_layanan = 'TI';
        $jenis_tiket = $tipe_tiket == 'INCIDENT' ? 'INC' : 'REQ';

        $get_nomor = Penomoran::where('tipe_nomor', $tipe_tiket)->where('kode_perusahaan', $kode_perusahaan)->where('unit_layanan', $unit_layanan)->first();

        // Get nomor tiket and update
        if ($get_nomor == null) {
            $last_number = 0;
            $current_number = 1;
            Penomoran::create([
                'kode_perusahaan' => $kode_perusahaan,
                'unit_layanan' => $unit_layanan,
                'tipe_nomor' => $tipe_tiket,
                'angka_terakhir' => $current_number,
            ]);
        } else {
            $last_number = $get_nomor->angka_terakhir;
            $current_number = $last_number + 1;

            Penomoran::where('tipe_nomor', $tipe_tiket)->where('kode_perusahaan', $kode_perusahaan)->where('unit_layanan', $unit_layanan)->first()->update([
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

        $format_nomor_tiket = $jenis_tiket . '-' . $kode_perusahaan . '-' . $unit_layanan . '-' . $nomor_tiket;

        return $format_nomor_tiket;
    }

    // public function getSLAMatrix($dampak, $urgensi)
    // {

    //     // Matriks
    //     $matriks = [
    //         3 => [ // High
    //             3 => '1', // High
    //             2 => '2', // Medium
    //             1 => '3', // Low
    //         ],
    //         2 => [ // Medium
    //             3 => '2', // High
    //             2 => '3', // Medium
    //             1 => '4', // Low
    //         ],
    //         1 => [ // Low
    //             3 => '3', // High
    //             2 => '4', // Medium
    //             1 => '4', // Low
    //         ],
    //     ];

    //     // Mengambil score berdasarkan dampak dan urgensi
    //     $score = $matriks[$dampak][$urgensi];

    //     // Tentukan hasil berdasarkan score
    //     $hasil = '';
    //     switch ($score) {
    //         case '1':
    //             $hasil = 'Critical';
    //             break;
    //         case '2':
    //             $hasil = 'High';
    //             break;
    //         case '3':
    //             $hasil = 'Medium';
    //             break;
    //         case '4':
    //             $hasil = 'Low';
    //             break;
    //     }

    //     return $hasil;
    // }

    public static function getStartBusiness()
    {
        $now = now();

        // Ambil data jam kerja
        $workHours = JamKerja::first();

        if ($workHours) {
            // Set jam kerja mulai dan berhenti
            $workStartHour = Carbon::parse($workHours->start_hour)->hour;
            $workEndHour = Carbon::parse($workHours->end_hour)->hour;
        } else {
            // Set manual jam kerja kalau db kosong
            $workStartHour = 8;
            $workEndHour = 17;
        }

        // Set today's business start time
        $businessStartToday = $now->copy()->hour($workStartHour)->minute(0)->second(0);

        // Set today's business end time
        $businessEndToday = $now->copy()->hour($workEndHour)->minute(0)->second(0);

        // If the current time is before today's business start time, return today's business start time
        if ($now->lt($businessStartToday)) {
            return $businessStartToday;
        }
        // If the current time is after today's business end time, return the next business day's start time
        elseif ($now->gt($businessEndToday)) {
            return $businessStartToday->addDay();
        }
        // If the current time is during business hours, return the current time
        else {
            return $now;
        }
    }

    public static function hitungBusinessSLA(Carbon $start, Carbon $end)
    {
        // Ambil data jam kerja
        $workHours = JamKerja::first();

        if ($workHours) {
            // Set jam kerja mulai dan berhenti
            $workStartHour = Carbon::parse($workHours->start_hour)->hour;
            $workEndHour = Carbon::parse($workHours->end_hour)->hour;
        } else {
            // Set manual jam kerja kalau db kosong
            $workStartHour = 8;
            $workEndHour = 17;
        }

        $totalSeconds = 0;

        // Ambil variable untuk menghitung jumlah waktu
        $current = $start->copy();

        // Ambil data hari libur
        $publicHolidays = HariLibur::pluck('date')->all();

        while ($current->lessThan($end)) {
            // Cek apakah termasuk weekend, kalau iya, jangan dihitung durasi
            if (in_array($current->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                $current->addDay()->startOfDay();
                continue;
            }

            // Cek apakah termasuk hari libur nasional, kalau iya, jangan dihitung durasi
            if (in_array($current->toDateString(), $publicHolidays)) {
                $current->addDay()->startOfDay();
                continue;
            }

            // Set Jam menjadi di variable awal jam kerja
            $workStart = $current->copy()->hour($workStartHour)->minute(0)->second(0);

            // kalau nilai jam activity start di bawah jam kerja, mundurkan ke jam kerja
            if ($current->lessThan($workStart)) {
                $current = $workStart;
            }

            // Set batas akhir jam kerja di hari itu
            $workEnd = $current->copy()->hour($workEndHour)->minute(0)->second(0);

            // kalau nilai jam activity end di atas jam kerja, majukan ke akhir jam kerja
            if ($end->greaterThan($workEnd) && $end->isSameDay($current)) {
                $end = $workEnd;
            }

            // jika nilai jam activity start melebihi jam kerja akhir, pindahkan value hari ke hari kerja berikutnya
            if ($current->greaterThanOrEqualTo($workEnd)) {
                $current->addDay()->startOfDay();
                continue;
            }

            // Jika setelah perhitungan waktu activity end dan current berada di hari yang sama, lakukan perhitungan selisih
            if ($end->isSameDay($current)) {
                $totalSeconds += $current->diffInSeconds($end);
            } else {
                // Jika setelah perhitungan, tanggal tetap berbeda, tambahkan selisih jam ke variabel total jam kerja
                $totalSeconds += $current->diffInSeconds($workEnd);
            }

            // lanjutkan perhitungan ke jam selanjutnya
            $current->addDay()->startOfDay();
        }

        // Konversi waktu menjadi masing-masing variabel
        $diffInDays = floor($totalSeconds / (60 * 60 * 24));
        $diffInHours = floor(($totalSeconds % (60 * 60 * 24)) / (60 * 60));
        $diffInMinutes = floor(($totalSeconds % (60 * 60)) / 60);
        $diffInSeconds = $totalSeconds % 60;

        $duration = [
            'days' => $diffInDays,
            'hours' => $diffInHours,
            'minutes' => $diffInMinutes,
            'seconds' => $diffInSeconds,
        ];

        return $duration;
    }


    public static function hitungActualSLA(Carbon $start, Carbon $end)
    {
        $diffInSeconds = $end->diffInSeconds($start);
        $diffInDays = floor($diffInSeconds / (60 * 60 * 24));
        $diffInHours = floor(($diffInSeconds % (60 * 60 * 24)) / (60 * 60));
        $diffInMinutes = floor(($diffInSeconds % (60 * 60)) / 60);
        $diffInSeconds = $diffInSeconds % 60;

        $duration = [
            'days' => $diffInDays,
            'hours' => $diffInHours,
            'minutes' => $diffInMinutes,
            'seconds' => $diffInSeconds,
        ];

        return $duration;
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

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tiket;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\ItemCategory;
use App\Models\Penomoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APITiketCreate extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Random antara Incident dan Request
        // $randomNumber = rand(1, 2);
        // $randomValue = $randomNumber === 1 ? "Incident" : "Request";
        // $tipe_tiket = strtoupper($randomValue);

        // Define the validation rules
        $rules = [
            'kategori_tiket' => 'required',
            // 'nama_kategori' => 'required',
            'subkategori_tiket' => 'required',
            // 'nama_subkategori' => 'required',
            'item_kategori_tiket' => 'sometimes|required', // only validate when present
            // 'nama_item_kategori' => 'sometimes|required', // only validate when present
            'judul_tiket' => 'required',
            'detail_tiket' => 'required',
            // 'attachment' => 'sometimes|required', // only validate when present
        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Validation fails

            // Identify empty fields
            $emptyFields = [];
            foreach ($rules as $field => $rule) {
                if (empty($request[$field])) {
                    $emptyFields[] = $field;
                }
            }

            return response()->json([
                'success' => false,
                'reason' => 'Ada kolom kosong',
                'empty_fields' => $emptyFields,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user_id_creator = 1180041;
            $id_kategori = $request->input('kategori_tiket');
            $nama_kategori = $request->input('nama_kategori');
            $id_subkategori = $request->input('subkategori_tiket');
            $nama_subkategori = $request->input('nama_subkategori');
            $id_item_kategori = $request->input('item_kategori_tiket');
            $nama_item_kategori = $request->input('nama_item_kategori');
            $judul_tiket = $request->input('judul_tiket');
            $detail_tiket = $request->input('detail_tiket');

            //randomized matriks prioritas insiden
            // $level_dampak = rand(1, 3);
            // $level_prioritas = rand(1, 3);

            // Set Level Dampak & Prioritas
            if ($id_item_kategori != null) {
                $item_kategori = ItemCategory::where('id', $id_item_kategori)->first();
                $level_dampak = $item_kategori->level_dampak;
                $level_prioritas = $item_kategori->level_urgensi;
                $tipe_tiket = $item_kategori->tipe_tiket;
            } else {
                $subkategori = Subkategori::where('id', $id_subkategori)->first();
                $level_dampak = $subkategori->level_dampak;
                $level_prioritas = $subkategori->level_urgensi;
                $tipe_tiket = $subkategori->tipe_tiket;
            }

            $tingkat_matriks = (int)$level_dampak * (int)$level_prioritas;

            if ($tingkat_matriks < 5) {
                $tipe_matriks = 'LOW';
            } else if ($tingkat_matriks < 8) {
                $tipe_matriks = 'MEDIUM';
            } else {
                $tipe_matriks = 'HIGH';
            }

            $db_raw_data = [
                'user_id_creator' => $user_id_creator,
                'tipe_tiket' => $tipe_tiket,
                'nomor_tiket' => $this->GetNomorTiket($tipe_tiket),
                'id_kategori' => $id_kategori,
                'kategori_tiket' => $nama_kategori,
                'id_subkategori' => $id_subkategori,
                'subkategori_tiket' => $nama_subkategori,
                'id_item_kategori' => $id_item_kategori,
                'item_kategori_tiket' => $nama_item_kategori,
                'judul_tiket' => $judul_tiket,
                'detail_tiket' => $detail_tiket,
                'status_tiket' => "Submitted",
                'attachment' => null,
                'level_dampak' => $level_dampak,
                'level_prioritas' => $level_prioritas,
                'tingkat_matriks' => $tingkat_matriks,
                'tipe_matriks' => $tipe_matriks,
                'updated_by' => 'User Test',
                'created_by' => 'User Test',
            ];

            Tiket::create($db_raw_data);

            return response()->json([
                'success' => true,
                // 'data' => $db_raw_data,
            ], 201);
        } catch (\Exception $e) {
            // Catch any error during the storing process
            return response()->json([
                'success' => false,
                'reason' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store_mobile(Request $request)
    {
        // Random antara Incident dan Request
        // $randomNumber = rand(1, 2);
        // $randomValue = $randomNumber === 1 ? "Incident" : "Request";
        // $tipe_tiket = strtoupper($randomValue);
        $nama_item_kategori = null;

        try {
            $user_id_creator = $request->input('user_id_creator');
            $nama_user = User::where('nik', $user_id_creator)->first()->nama;
            $id_kategori = $request->input('id_kategori');
            $nama_kategori = Kategori::where('id', $request->input('id_kategori'))->first()->nama_kategori;
            $id_subkategori = $request->input('id_subkategori');
            $nama_subkategori = Subkategori::where('id', $request->input('id_subkategori'))->first()->nama_subkategori;
            $id_item_kategori = $request->input('id_item_kategori');
            if ($id_item_kategori != null) {
                $nama_item_kategori = ItemCategory::where('id', $request->input('id_item_kategori'))->first()->nama_item_kategori;
            }
            $judul_tiket = $request->input('judul_tiket');
            $detail_tiket = $request->input('detail_tiket');

            //randomized matriks prioritas insiden
            // $level_dampak = rand(1, 3);
            // $level_prioritas = rand(1, 3);

            if ($id_item_kategori != null) {
                $item_kategori = ItemCategory::where('id', $id_item_kategori)->first();
                $level_dampak = $item_kategori->level_dampak;
                $level_prioritas = $item_kategori->level_urgensi;
                $tipe_tiket = $item_kategori->tipe_tiket;
            } else {
                $subkategori = Subkategori::where('id', $id_subkategori)->first();
                $level_dampak = $subkategori->level_dampak;
                $level_prioritas = $subkategori->level_urgensi;
                $tipe_tiket = $subkategori->tipe_tiket;
            }

            $tingkat_matriks = (int)$level_dampak * (int)$level_prioritas;

            if ($tingkat_matriks < 5) {
                $tipe_matriks = 'LOW';
            } else if ($tingkat_matriks < 8) {
                $tipe_matriks = 'MEDIUM';
            } else {
                $tipe_matriks = 'HIGH';
            }

            if ($id_kategori == null) {
                $db_raw_data = [
                    'user_id_creator' => $user_id_creator,
                    'tipe_tiket' => $tipe_tiket,
                    'nomor_tiket' => $this->GetNomorTiket($tipe_tiket),
                    'id_kategori' => $id_kategori,
                    'kategori_tiket' => $nama_kategori,
                    'id_subkategori' => $id_subkategori,
                    'subkategori_tiket' => $nama_subkategori,
                    'judul_tiket' => $judul_tiket,
                    'detail_tiket' => $detail_tiket,
                    'status_tiket' => "Submitted",
                    // 'attachment' => null,
                    'level_dampak' => $level_dampak,
                    'level_prioritas' => $level_prioritas,
                    'tingkat_matriks' => $tingkat_matriks,
                    'tipe_matriks' => $tipe_matriks,
                    'updated_by' => $nama_user,
                    'created_by' => $nama_user,
                ];
            } else {
                $db_raw_data = [
                    'user_id_creator' => $user_id_creator,
                    'tipe_tiket' => $tipe_tiket,
                    'nomor_tiket' => $this->GetNomorTiket($tipe_tiket),
                    'id_kategori' => $id_kategori,
                    'kategori_tiket' => $nama_kategori,
                    'id_subkategori' => $id_subkategori,
                    'subkategori_tiket' => $nama_subkategori,
                    'id_item_kategori' => $id_item_kategori,
                    'item_kategori_tiket' => $nama_item_kategori,
                    'judul_tiket' => $judul_tiket,
                    'detail_tiket' => $detail_tiket,
                    'status_tiket' => "Submitted",
                    // 'attachment' => null,
                    'level_dampak' => $level_dampak,
                    'level_prioritas' => $level_prioritas,
                    'tingkat_matriks' => $tingkat_matriks,
                    'tipe_matriks' => $tipe_matriks,
                    'updated_by' => $nama_user,
                    'created_by' => $nama_user,
                ];
            }




            Tiket::create($db_raw_data);

            return response()->json([
                'success' => true,
                // 'data' => $db_raw_data,
            ], 201);
        } catch (\Exception $e) {
            // Catch any error during the storing process
            return response()->json([
                'success' => false,
                'reason' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tiket $tiket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tiket $tiket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tiket $tiket)
    {
        //
    }

    public function list_kategori()
    {
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    public function list_subkategori($id)
    {
        $subkategori = Subkategori::where('id_kategori', $id)->get();
        return response()->json($subkategori);
    }

    public function list_item_kategori($id)
    {
        $item_kategori = ItemCategory::where('id_subkategori', $id)->get();
        return response()->json($item_kategori);
    }

    private function GetNomorTiket($tipe_tiket)
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
}

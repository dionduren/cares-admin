<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Tiket;
use App\Models\Kategori;
use App\Models\Subkategori;
use App\Models\ItemCategory;
use App\Models\Master\StatusTiket;
use App\Models\Master\TipeSLA;
use App\Models\Transaction\SLA;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APITiketCreate extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company_code = 'A000';
        $company_name = 'PI';
        $kode_perusahaan = 'PIH';
        $id_unit_layanan = 1;
        $unit_layanan = 'TI';

        // Define the validation rules
        $rules = [
            'kategori_tiket' => 'required',
            'subkategori_tiket' => 'required',
            'item_kategori_tiket' => 'sometimes|required',
            'judul_tiket' => 'required',
            'detail_tiket' => 'required',
            // 'attachment' => 'sometimes|required', // only validate when present
        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

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
            $user_id_creator = $request->input('user_id');
            $user_creator = User::where('nik', $user_id_creator)->first()->nama;

            $id_kategori = $request->input('kategori_tiket');
            $nama_kategori = $request->input('nama_kategori');
            $id_subkategori = $request->input('subkategori_tiket');
            $nama_subkategori = $request->input('nama_subkategori');
            $id_item_kategori = $request->input('item_kategori_tiket');
            $nama_item_kategori = $request->input('nama_item_kategori');
            $judul_tiket = $request->input('judul_tiket');
            $detail_tiket = $request->input('detail_tiket');

            // Get Value from Subkategori atau Item Kategori
            if ($id_item_kategori != null) {
                $item_kategori = ItemCategory::where('id', $id_item_kategori)->first();
                $level_dampak = $item_kategori->level_dampak;
                $level_urgensi = $item_kategori->level_urgensi;
                $tipe_tiket = $item_kategori->tipe_tiket;
            } else {
                $subkategori = Subkategori::where('id', $id_subkategori)->first();
                $level_dampak = $subkategori->level_dampak;
                $level_urgensi = $subkategori->level_urgensi;
                $tipe_tiket = $subkategori->tipe_tiket;
            }

            // set status ticket
            $status_tiket = StatusTiket::where('flow_number', 1)->where('tipe_tiket', $tipe_tiket)->first();


            $db_raw_data = [
                'company_code' => $company_code,            // Set Model setelah sudah fix akan jadi multi company
                'company_name' => $company_name,            // Set Model setelah sudah fix akan jadi multi company
                'id_unit_layanan' => $id_unit_layanan,      // Set Model setelah sudah fix akan multi unit layanan
                'unit_layanan' => $unit_layanan,            // Set Model setelah sudah fix akan multi unit layanan
                'user_id_creator' => $user_id_creator,
                'tipe_tiket' => $tipe_tiket,
                'nomor_tiket' => HelperController::GetNomorTiket($kode_perusahaan, $unit_layanan, $tipe_tiket),
                'id_kategori' => $id_kategori,
                'kategori_tiket' => $nama_kategori,
                'id_subkategori' => $id_subkategori,
                'subkategori_tiket' => $nama_subkategori,
                'id_item_kategori' => $id_item_kategori,
                'item_kategori_tiket' => $nama_item_kategori,
                'judul_tiket' => $judul_tiket,
                'detail_tiket' => $detail_tiket,
                'id_status_tiket' => $status_tiket->flow_number,
                'status_tiket' => $status_tiket->nama_status,
                'attachment' => null,
                'level_dampak' => $level_dampak,
                'level_urgensi' => $level_urgensi,
                'updated_by' => $user_creator,
                'created_by' => $user_creator,
            ];

            $ticket = Tiket::create($db_raw_data);

            // Get Tipe SLA and create SLA Response
            $sla_response = TipeSLA::where('tipe_sla', 'Response')->where('tipe_tiket', $tipe_tiket)->first();

            SLA::create([
                'id_sla' => $sla_response->id,
                'kategori_sla' => 'Response',
                'tipe_sla' => $sla_response->nama_sla,
                'sla_hours_target' => $sla_response->durasi_jam,
                'id_tiket' => $ticket->id,
                'business_start_time' => HelperController::getStartBusiness(),
                'status_sla' => "On Progress",
                'actual_start_time' => now(),
                'updated_by' => $user_creator,
                'created_by' => $user_creator,
            ]);

            return response()->json([
                'success' => true,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'reason' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store_mobile(Request $request)
    {
        $company_code = 'A000';
        $company_name = 'PI';
        $kode_perusahaan = 'PIH';
        $id_unit_layanan = 1;
        $unit_layanan = 'TI';
        $nama_item_kategori = null;

        try {
            $user_id_creator = $request->input('user_id_creator');
            $user_creator = User::where('nik', $user_id_creator)->first()->nama;

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

            if ($id_item_kategori != null) {
                $item_kategori = ItemCategory::where('id', $id_item_kategori)->first();
                $level_dampak = $item_kategori->level_dampak;
                $level_urgensi = $item_kategori->level_urgensi;
                $tipe_tiket = $item_kategori->tipe_tiket;
            } else {
                $subkategori = Subkategori::where('id', $id_subkategori)->first();
                $level_dampak = $subkategori->level_dampak;
                $level_urgensi = $subkategori->level_urgensi;
                $tipe_tiket = $subkategori->tipe_tiket;
            }

            // set status ticket
            $status_tiket = StatusTiket::where('flow_number', 1)->where('tipe_tiket', $tipe_tiket)->first();


            if ($id_kategori == null) {
                $db_raw_data = [
                    'company_code' => $company_code,            // Set Model setelah sudah fix akan jadi multi company
                    'company_name' => $company_name,            // Set Model setelah sudah fix akan jadi multi company
                    'id_unit_layanan' => $id_unit_layanan,      // Set Model setelah sudah fix akan multi unit layanan
                    'unit_layanan' => $unit_layanan,            // Set Model setelah sudah fix akan multi unit layanan
                    'user_id_creator' => $user_id_creator,
                    'tipe_tiket' => $tipe_tiket,
                    'nomor_tiket' => HelperController::GetNomorTiket($kode_perusahaan, $unit_layanan, $tipe_tiket),
                    'id_kategori' => $id_kategori,
                    'kategori_tiket' => $nama_kategori,
                    'id_subkategori' => $id_subkategori,
                    'subkategori_tiket' => $nama_subkategori,
                    'judul_tiket' => $judul_tiket,
                    'detail_tiket' => $detail_tiket,
                    'id_status_tiket' => 1,
                    'status_tiket' => $status_tiket->nama_status,
                    // 'attachment' => null,
                    'level_dampak' => $level_dampak,
                    'level_urgensi' => $level_urgensi,
                    'updated_by' => $user_creator,
                    'created_by' => $user_creator,
                ];
            } else {
                $db_raw_data = [
                    'company_code' => $company_code,            // Set Model setelah sudah fix akan jadi multi company
                    'company_name' => $company_name,            // Set Model setelah sudah fix akan jadi multi company
                    'id_unit_layanan' => $id_unit_layanan,      // Set Model setelah sudah fix akan multi unit layanan
                    'unit_layanan' => $unit_layanan,            // Set Model setelah sudah fix akan multi unit layanan
                    'user_id_creator' => $user_id_creator,
                    'tipe_tiket' => $tipe_tiket,
                    'nomor_tiket' => HelperController::GetNomorTiket($kode_perusahaan, $unit_layanan, $tipe_tiket),
                    'id_kategori' => $id_kategori,
                    'kategori_tiket' => $nama_kategori,
                    'id_subkategori' => $id_subkategori,
                    'subkategori_tiket' => $nama_subkategori,
                    'id_item_kategori' => $id_item_kategori,
                    'item_kategori_tiket' => $nama_item_kategori,
                    'judul_tiket' => $judul_tiket,
                    'detail_tiket' => $detail_tiket,
                    'id_status_tiket' => 1,
                    'status_tiket' => $status_tiket->nama_status,
                    // 'attachment' => null,
                    'level_dampak' => $level_dampak,
                    'level_urgensi' => $level_urgensi,
                    'updated_by' => $user_creator,
                    'created_by' => $user_creator,
                ];
            }

            $ticket = Tiket::create($db_raw_data);

            // Get Tipe SLA and create SLA Response
            $sla_response = TipeSLA::where('tipe_sla', 'Response')->where('tipe_tiket', $tipe_tiket)->first();

            SLA::create([
                'id_sla' => $sla_response->id,
                'tipe_sla' => $sla_response->nama_sla,
                'id_tiket' => $ticket->id,
                'business_start_time' => HelperController::getStartBusiness(),
                'status_sla' => "On Progress",
                'actual_start_time' => now(),
                'updated_by' => $user_creator,
                'created_by' => $user_creator,
            ]);

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
        $kategori = Kategori::orderBy('sort_order', 'asc')->get();
        return response()->json($kategori);
    }

    public function list_subkategori_all()
    {
        $kategori = Subkategori::orderBy('nama_kategori', 'asc')->get();
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
}

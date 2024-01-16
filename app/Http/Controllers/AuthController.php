<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Master\SAPUserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $result,
        ];

        return response()->json($response, 200);
    }

    public function sendError($errorMessages = [], $statusCode)
    {
        $response = [
            'status' => false,
            'message' => 'Error occurred',
            'error' => [
                'code' => $statusCode,
                'description' => $errorMessages
            ]
        ];

        return response()->json($response, $statusCode);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['nik' => $request->nik, 'password' => $request->password])) {
            return $this->createSuccessResponse(Auth::user());
        } elseif ($user = $this->attemptSSOLogin(['nik' => $request->nik, 'password' => $request->password])) {
            return $this->createSuccessResponse($user);
        } else {
            return $this->sendError('Invalid credentials or unauthorized access.', 401);
        }
    }

    protected function createSuccessResponse($user)
    {
        $success['id'] =  $user->id;
        $success['nik'] =  $user->nik;
        $success['nama'] =  $user->nama;
        $success['email'] =  $user->email;
        $success['role_id'] =  $user->role_id;
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;

        return $this->sendResponse($success, 'User login successfully.');
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function login_test()
    {
        return view('auth.login-test');
    }

    // public function passwordLogin(Request $request)
    public function main_login(Request $request)
    {
        $credentials = $request->only(['nik', 'password']);
        $remember = $request->has('remember_me');

        // Try local authentication first
        if (Auth::attempt($credentials)) {

            $id = User::where('nik', $request->input('nik'))->first()->id;

            Auth::loginUsingId($id);

            return response()->json([
                'path' => '/',
                'status' => 200,
            ]);
        } else {
            if ($user = $this->attemptSSOLogin($credentials)) {
                // SSO authentication successful
                try {
                    Auth::login($user, $remember);

                    return response()->json([
                        'path' => '/',
                        'status' => 200,
                    ]);
                } catch (\Exception $e) {
                    Log::error('login failed: ' . $e->getMessage());
                }
            } else {

                return response()->json([
                    'password' => 'User \ Password yang anda masukkan salah',
                    'status' => 403,
                ]);
            }
        }
    }

    protected function attemptSSOLogin(array $credentials)
    {
        $sso_username = 'AP130';
        $sso_password = '1ASjhbjAs87ddsd9ASdbhjbdPOWdbh2m';

        // URL of your SSO API endpoint
        $ssoApiUrl = 'https://sso.pupuk-Indonesia.com/api/login/users';

        try {
            // Use Laravel's HTTP client or another HTTP client to send a POST request
            $response = Http::asForm()->withBasicAuth($sso_username, $sso_password)
                ->post($ssoApiUrl, [
                    'uid' => $credentials['nik'],
                    'password' => $credentials['password'],
                ]);

            $body = $response->getBody();
            $login_info = json_decode($body, true);

            // Cek apakah data user terdaftar di  SAP
            if ($response->successful() && $response['status']) {
                // Cek apakah data user terdaftar di Lokal
                $user = $this->findOrCreateUser($login_info);

                return $user;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::error('SSO login failed: ' . $e->getMessage());
            return false;
        }
    }

    protected function findOrCreateUser($ssoUser)
    {
        $user = User::where('nik', $ssoUser['emp_no'])->first();

        if ($user == null) {

            try {
                $karyawan_detail = $this->getKaryawanDetail($ssoUser['emp_no']);

                if ($karyawan_detail['pos_level'] <= 2) {
                    $role_id = 7;
                } else {
                    $role_id = 6;
                }

                $user = User::create([
                    'nik' => $ssoUser['emp_no'],
                    'nama' => $karyawan_detail['nama'],
                    'email' => $ssoUser['email'],
                    'token' => $ssoUser['token'],
                    'role_id' => $role_id,
                    'updated_by' => 'SAP SSO',
                    'created_by' => 'SAP SSO',
                ]);

                SAPUserDetail::create([
                    'emp_no' => $karyawan_detail['emp_no'],
                    'nama' => $karyawan_detail['nama'],
                    'gender' => $karyawan_detail['gender'] ?? null,
                    'emp_grade' => $karyawan_detail['emp_grade'] ?? null,
                    'emp_grade_title' => $karyawan_detail['emp_grade_title'] ?? null,
                    'area' => $karyawan_detail['area'] ?? null,
                    'area_title' => $karyawan_detail['area_title'] ?? null,
                    'sub_area' => $karyawan_detail['sub_area'] ?? null,
                    'sub_area_title' => $karyawan_detail['sub_area_title'] ?? null,
                    'company' => $karyawan_detail['company'] ?? null,
                    'lokasi' => $karyawan_detail['lokasi'] ?? null,
                    'email' => $karyawan_detail['email'] ?? null,
                    'hp' => $karyawan_detail['hp'] ?? null,
                    'pos_id' => $karyawan_detail['pos_id'] ?? null,
                    'pos_title' => $karyawan_detail['pos_title'] ?? null,
                    'pos_grade' => $karyawan_detail['pos_grade'] ?? null,
                    'pos_kategori' => $karyawan_detail['pos_kategori'] ?? null,
                    'pos_level' => $karyawan_detail['pos_level'] ?? null,
                    'org_id' => $karyawan_detail['org_id'] ?? null,
                    'org_title' => $karyawan_detail['org_title'] ?? null,
                    'dept_id' => $karyawan_detail['dept_id'] ?? null,
                    'dept_title' => $karyawan_detail['dept_title'] ?? null,
                    'komp_id' => $karyawan_detail['komp_id'] ?? null,
                    'komp_title' => $karyawan_detail['komp_title'] ?? null,
                    'dir_id' => $karyawan_detail['dir_id'] ?? null,
                    'dir_title' => $karyawan_detail['dir_title'] ?? null,
                    'sup_emp_no' => $karyawan_detail['sup_emp_no'] ?? null,
                    'sup_pos_id' => $karyawan_detail['sup_pos_id'] ?? null,
                    'bag_id' => $karyawan_detail['bag_id'] ?? null,
                    'bag_title' => $karyawan_detail['bag_title'] ?? null,
                    'updated_by' => 'SAP SSO',
                    'created_by' => 'SAP SSO',
                ]);

                return $user;
            } catch (\Exception $e) {
                Log::error('findOrCreateUser failed: ' . $e->getMessage());
            }
        } else {
            return $user;
        }
    }

    protected function getKaryawanDetail($nik)
    {
        $sso_username = 'AP130';
        $sso_password = '1ASjhbjAs87ddsd9ASdbhjbdPOWdbh2m';

        $ssoApiUrl = 'https://sso.pupuk-indonesia.com/api/login/masterkary?badge=' . $nik;

        try {

            $response = Http::withBasicAuth($sso_username, $sso_password)->get($ssoApiUrl);

            // Cek apakah data user terdaftar di  SAP
            if ($response->successful() && $response['status']) {

                $body = $response->getBody();
                $detail_karyawan = json_decode($body, true);

                return $detail_karyawan;
            }
            return false;
        } catch (\Exception $e) {
            // Handle exceptions (like network issues)
            Log::error('SSO get Karyawan Detail failed: ' . $e->getMessage());
            return false;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['nik' => $request->nik, 'password' => $request->password])) {
            $user = Auth::user();
            $success['id'] =  $user->id;
            $success['nik'] =  $user->nik;
            $success['nama'] =  $user->nama;
            $success['email'] =  $user->email;
            $success['role_id'] =  $user->role_id;
            $success['unit_kerja'] =  $user->unit_kerja;
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function login_test()
    {
        return view('auth.login-test');
    }

    public function passwordLogin(Request $request)
    {
        $credentials = $request->only(['nik', 'password']);

        // Try local authentication first
        if (Auth::attempt($credentials)) {
            $id = User::where('nik', $request->input('nik'))->first()->id;
            Auth::loginUsingId($id);
            return response()->json([
                'path' => '/',
                'status' => 200,
            ]);
        } else {
            // If local authentication fails, try SSO authentication
            if ($this->attemptSSOLogin($credentials)) {
                // SSO authentication successful
                // Perform necessary actions after SSO login (e.g., creating/updating user record)
                // Redirect or return a response as needed
            } else {
                // Both local and SSO authentication failed
                //todo: Failed Login Log
                return response()->json([
                    'password' => 'Password yang anda masukkan salah',
                    'status' => 403,
                ]);
            }
        }
    }

    protected function attemptSSOLogin(array $credentials)
    {
        // URL of your SSO API endpoint
        $ssoApiUrl = 'https://sso.example.com/api/authenticate';

        try {
            // Use Laravel's HTTP client or another HTTP client to send a POST request
            $response = Http::post($ssoApiUrl, [
                'nik' => $credentials['nik'],
                'password' => $credentials['password'],
            ]);

            // Check if the response indicates successful authentication
            if ($response->successful() && $response['authenticated']) {
                // Here, handle what to do after successful authentication.
                // For instance, you might want to find or create a user record in your database.
                $user = $this->findOrCreateUser($response['user']);

                // Login the user into your application
                Auth::login($user);

                return true;
            }

            return false;
        } catch (\Exception $e) {
            // Handle exceptions (like network issues)
            Log::error('SSO login failed: ' . $e->getMessage());
            return false;
        }
    }

    protected function findOrCreateUser(array $ssoUser)
    {
        // Assuming the SSO returns a unique identifier for the user
        return User::firstOrCreate(
            ['sso_id' => $ssoUser['id']],
            [
                'nik' => $ssoUser['nik'],
                'name' => $ssoUser['name'],
                // other fields...
            ]
        );
    }
}

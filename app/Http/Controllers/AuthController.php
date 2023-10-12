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

    public function passwordLogin(Request $request)
    {
        // $username = $request->input('username');
        // $password = $request->input('password');

        $credentials = $request->only(['nik', 'password']);

        if (Auth::attempt($credentials)) {
            $id = User::where('nik', $request->input('nik'))->first()->id;
            Auth::loginUsingId($id);
            return response()->json([
                'path' => '/',
                'status' => 200,
            ]);
            return redirect('/');
        } else {
            //todo: Failed Login Log
            return response()->json([
                'password' => 'Password yang anda masukkan salah',
                'status' => 403,
            ]);
        }
    }
}

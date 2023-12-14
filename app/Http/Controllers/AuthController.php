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

    public function main_login(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'password' => 'required'
        ]);

        $nik = $request->input('nik');
        $password = $request->input('password');

        $url = 'http://sap-pi-prd.pupuk-indonesia.com:58300/XISOAPAdapter/MessageServlet?senderParty=&senderService=BC_UTILITIES&receiverParty=&receiverService=&interface=SI_CheckLogin_OB&interfaceNamespace=urn:CheckUserLogin';
        $CREDENTIALS = 'support_pi:activate300';
        $auth = base64_encode($CREDENTIALS);
        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
                                <soapenv:Header/>
                                <soapenv:Body>
                                <urn:ZFM_CHECKLOGIN>
                                    <!--You may enter the following 2 items in any order-->
                                    <IV_PASSWORD>' . $password . '</IV_PASSWORD>
                                    <IV_USERID>' . $nik . '</IV_USERID>
                                </urn:ZFM_CHECKLOGIN>
                                </soapenv:Body>
                            </soapenv:Envelope>';

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Authorization: Basic " . $auth,
            "SOAPAction:urn: sap-com:document:sap:rfc:functions",
            "Content-length: " . strlen($xml_post_string),
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        $err = curl_error($ch);
        curl_close($ch);

        // \dd($err);

        if ($err) {
            # Code Login via lokal data?
            # show error
        } else {

            // Check if any user exists with the given credentials
            $user_login = array(
                'user' => $nik,
                'password' => $password,
                'domain' => 'pupuk-indonesia.com'
            );

            $url =  'http://' . $user_login['domain'];
            $subdomain = 'www.';
            $host = parse_url($url, PHP_URL_HOST);
            $host = str_ireplace($subdomain, '', $host);
            $tld = strstr($host, '.');
            $dc1 = strstr($host, '.', true);
            $dc2 = substr(strstr($tld, '.'), 1);

            $ldaphost = "ldap://10.210.0.242";
            $ldapport = 389;
            $ds = ldap_connect($ldaphost, $ldapport) or die("Could not connect to $ldaphost");
            ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

            // \dd($ds);

            if ($ds) {
                $binddn = 'OU=people,DC=' . $dc1 . ',DC=' . $dc2; //cn=admin or whatever you use to login by phpldapadmin
                $ldapbind = @ldap_bind($ds, 'uid=' . $user_login['user'] . ',' . $binddn, $user_login['password']);

                \dd($binddn);
                // \dd($ldapbind);


                //check if ldap was sucessfull 
                if ($ldapbind) {
                    $token = $this->set_cookies($nik);
                    return response()->json(
                        [
                            'status' => TRUE,
                            'message' => 'Login LDAP successful',
                            'nik' => $nik,
                            'token' => $token
                        ],
                        // REST_Controller::HTTP_OK
                    );
                } else {
                    // Set the response and exit
                    //BAD_REQUEST (400) being the HTTP response code
                    return response()->json(
                        [
                            'status' => FALSE,
                            'message' => 'Wrong NIK or Password. '
                        ],
                        // REST_Controller::HTTP_BAD_REQUEST
                    );
                }
            } else {
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                return response()->json(
                    [
                        'status' => FALSE,
                        'message' => 'LDAP Server Connection Error.'
                    ],
                    // REST_Controller::HTTP_BAD_REQUEST
                );
            }
        }
    }

    public function set_cookies($nik)
    {
        $user = User::where('nik', $nik)->first();

        $key = Str::random(250);
        $keyExp = now()->addHours(6);

        $user->update([
            'token' => $key,
            'token_exp' => $keyExp->timestamp,
            'token_exp_date' => $keyExp
        ]);

        Cookie::queue('ssoPIHC', $key, 60 * 6); // 360 minutes (6 hours)
        return $key;
    }

    public function token_get()
    {
        $token = $this->get('token');

        // If the id parameter doesn't exist return all the users
        if ($token === NULL) {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No token were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        } else {
            $data = $this->apilogin_model->get_token_by_cookie($token);
            // print_r($data);

            if (!empty($data)) {
                $data['status'] = TRUE;
                $data['message'] = 'Token validated';
                $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Token could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
}

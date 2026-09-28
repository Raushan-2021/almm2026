<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feedback;
use App\Models\State;
use App\Models\District;
use App\Models\Village;
use App\Traits\General;
use App\Utils\EmailSmsNotifications;
use App\Models\Consumer;
use App\Models\SubDistrict;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use Hash;
use DB;

// namespace App\Http\Controllers\Auth;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use App\Models\SessionToken;
use App\Models\RlmmUser;
use App\Models\RlmmNiwe;

// use App\Models\User;
use Carbon\Carbon;
// use App\Traits\General;
// use Session;


class HomeController extends Controller
{
    use General;

    /**
     * Create a new controller instance.
     * 
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function registerUser(Request $request)
    {
        if ($request->isMethod('get')) {
            $countries = Country::all();
            $state = State::all();
            //dd($state);
            $auditData = array('action_type' => 'Register', 'description' => 'User View Register Page', 'user_type' => 'USER');
            $this->auditTrail($auditData);
            return view('auth.register', compact('countries', 'state'));
        } else {
            // $key = hex2bin("0123456789abcdef0123456789abcdef");
            // $iv = hex2bin("abcdef9876543210abcdef9876543210");

            // $decryptedPan = openssl_decrypt($request->pan, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            // $decryptedPan = trim($decryptedPan);
            // $request->merge(['pan' => $decryptedPan,]);

            // $decryptedGst = openssl_decrypt($request->pan, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            // $decryptedGst = trim($decryptedPan);
            // $request->merge(['gst' => $decryptedGst,]);

            $key = hex2bin("0123456789abcdef0123456789abcdef");
            $iv = hex2bin("abcdef9876543210abcdef9876543210");

            // Decrypt PAN
            $decryptedPan = openssl_decrypt($request->pan, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $decryptedPan = rtrim($decryptedPan, "\0");
            $request->merge(['pan' => $decryptedPan]);

            // Decrypt GST
            $decryptedGst = openssl_decrypt($request->gst, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $decryptedGst = rtrim($decryptedGst, "\0");
            $request->merge(['gst' => $decryptedGst]);


            $request->validate(
                [
                    'name' => 'required|string|regex:/^[a-zA-Z ]*$/|max:20',
                    'email' => 'required|email|unique:manufacturer_users,email',
                    'phone' => 'required|numeric|digits:10|unique:manufacturer_users,phone',
                    'pan' => 'required|regex:/[A-Za-z]{5}[0-9]{4}[A-Za-z]/|unique:manufacturer_users,pan',
                    'gst' => 'required|unique:manufacturer_users,gst',
                    'address' => 'required',
                    'country_id' => 'required',
                    'state_id' => 'required_if:country_id,99',
                    'district_id' => 'required_if:country_id,99',
                    'pincode' => 'required'
                ],
                [
                    'phone.required' => 'Please enter mobile number',
                    'phone.numeric' => 'The mobile number be a number.',
                    'phone.digits:10' => 'The mobile number must be 10 digits.',
                    'pan.required' => 'The PAN number field is required.',
                    'pan.regex' => 'The PAN number format is not valid',
                    'gst.required' => 'The GST number field is required.',
                    'country_id.required' => 'Please choose your country.'
                ]
            );
            //dd($request->all());
            //$password=$this->generateRandomString(8);
            $password = '123456';

            $email = $request->input('email');
            $name = $request->input('name');
            $user = new User;
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->pan = $request->input('pan');
            $user->gst = $request->input('gst');
            $user->address = $request->input('address');
            $user->country_id = $request->input('country_id');
            $user->state_id = $request->input('state_id');
            $user->district_id = $request->input('district_id');
            $user->pin_code = $request->input('pincode');
            //dd($user);
            $user->save();
            try {
                $auditData = array('action_type' => 'Register', 'description' => 'User Register Successfuly', 'user_type' => 'USER');
                $this->auditTrail($auditData);
                $this->emailSmsNotifications->notifyManufacturerRegistration($email, $password, $name);

            } catch (\Throwable $th) {
                //throw $th;
                $auditData = array('action_type' => 'Register', 'description' => $th->getMessage(), 'user_type' => 'USER');
                $this->auditTrail($auditData);
                dd($th->getMessage());
            }

            return redirect('/login')->with('status', 'Your account has been registered successfully. Please check your email for cridentials');
        }
    }
    public function test_email()
    {
        try {
            //code...
            $this->emailSmsNotifications->notifyManufacturerRegistration('ankush.mukati2603@gmail.com', '123456', 'MNF-MP-34', 'Ankush');
            dd('Testing Email');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }

    }
    public function get_distictbystate(Request $request)
    {

        $state_id = $request->state_id;
        $distict = District::getDistictByState($request->state_id);
        return response()->json($distict);
    }
    public function checkuserlogin(Request $request)
    {
        return view('auth.multiuseraccess');
    }

    public function getState()
    {
        $districts = State::all();
        return json_encode($districts);
    }
    public function getDistrictsByState($state)
    {
        $districts = District::getDistictByState($state);
        return $districts;
    }
    public function getCounters()
    {
        $hits = $this->get_hits_count();
        return response()->json(["hits" => $hits], 200);
    }
    function get_hits_count()
    {
        $uniqueCount = DB::table('customer_visitors_tbl')->count(DB::raw('DISTINCT ipaddress'));
        $totalCount = DB::table('customer_visitors_tbl')->count();
        return array('totalHits' => ($totalCount), 'uniqueHits' => ($uniqueCount));
    }
    function site_visit_counter()
    {
        $visitor_data['visting_time'] = date('m-d-y H:i:s');
        $visitor_data['ipaddress'] = $_SERVER['REMOTE_ADDR'];
        DB::table('customer_visitors_tbl')->insert($visitor_data);
    }



    public function curl_consumer_validation(Request $request)
    {
        try {
            $input = ['consumerNumber' => '1123148693'];

            $plain_data = json_encode($input);
            $key = "stMKEmf3DCZemNTXmsltkK26FJSL97ak";  //Key file

            //Set the method
            $method = 'aes-256-cbc';
            $ivlen = 16;
            $iv = substr($key, 0, $ivlen);
            $encrypted = base64_encode(openssl_encrypt($plain_data, $method, $key, OPENSSL_RAW_DATA, $iv));


            $data = ['payload' => $encrypted];

            $url = "http://IP:port/fgcis-ms-2.0.0/v1/meterRelease/minrService";
            //var_dump($url);exit;
            $content = json_encode($data);
            //var_dump($content);exit;
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

            $json_response = curl_exec($curl);
            //var_dump(curl_error($curl));exit;
            //var_dump($json_response);exit;

            //$key = "a6c6814c0db6094e697a0cc50ad64f59";  //Key file
            //$method = 'aes-256-cbc';
            $data_de = base64_decode($json_response);
            $data_de = openssl_decrypt($data_de, $method, $key, OPENSSL_RAW_DATA, $iv);
            $data = json_decode($data_de);
            dd($data);
            //------
            $data = (array) $data;


            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status['status_code'] == 200) {
                dd($status['message']);
            } else {
                echo 'Status Code :' . $status['status_code'] . '<br>Message:' . $status['message'] . '<br>Error Details :' . $status['error_details'];
                exit;
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }

    }

    public function curl_decrypt_mobile()
    {
        $encrypted_data = "A0SBROPmEl3uzy3p4sfKEb4nVVTfkj8J4Uyng+qLhr4IdDNr7IYGQpOuJsjqC6VB3zRaNNjJ51hvLXLOcHsVMSVUspudpKI2eipknlwX7nHLJMHdHp5Lvp88ZgmkAx9wrKeaVc14evEApqAlqJn52A==";

        //====Decrypt POST data=========
        $key = '184130ab4a665b9d594a181163144edb';  //Key file  

        $method = 'aes-128-cbc';
        $data_de = base64_decode($encrypted_data);
        //$data_de = $post_data['encrypted_data'];
        $ivlen = 16;//length of key
        $iv = substr($key, 0, $ivlen);
        $data_de = openssl_decrypt($data_de, $method, $key, OPENSSL_RAW_DATA, $iv);
        $data = json_decode($data_de);
        var_dump($data);
        exit;
    }


    public function submitFeedback(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|regex:/^[a-zA-Z ]*$/|max:20',
                'email' => [
                    'required',
                        'email',
                        function ($attribute, $value, $fail) {
                            if ($value !== strip_tags($value)) {
                                $fail('HTML tags are not allowed.');
                            }
                        },
                ],
                'phone' => 'required|numeric|digits:10',
                'type' => 'required',
                'message' => [
                        'required',
                        'max:255',
                        function ($attribute, $value, $fail) {
                            if ($value !== strip_tags($value)) {
                                $fail('HTML tags are not allowed.');
                            }
                        },
                ],
            ],
            [
                'phone.required' => 'Please enter mobile number',
                'phone.numeric' => 'The mobile number be a number.',
                'phone.digits:10' => 'The mobile number must be 10 digits.',
                'type.required' => 'Please select Feedback/Query'
            ]
        );


        $feedback = new Feedback;
        $feedback->name = $request->input('name');
        $feedback->email = $request->input('email');
        $feedback->phone = $request->input('phone');
        $feedback->type = $request->input('type');
        $feedback->message = $request->input('message');
        $feedback->save();

        $status = $request->input('type') == '1' ? 'Your feedback has been sent successfully' : 'Your query has been raised successfully';
        return redirect('/feedback')->with('status', $status);

    }

    public function rmllogin(Request $request)
    {
        // echo "hello";die;
        return view('auth.rlmmlogin');
    }
    // For niwe login 
    // public function niwelogin(Request $request)
    // {
    //      echo "hello";die;
    //     return view('auth.rlmmlogin');
    // }

    private function validator(Request $request)
    {
        //validation rules.//email|exists:mnre_users|
        switch ($request->user_type) {
            case 'MNRE':
                $rules = [
                    'email'    => 'required|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;
           
            case 'MANUFACTURER':
                $rules = [
                    'email'    => 'required|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;

            case 'NISE':
                $rules = [
                    'email'    => 'required|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                    'user_type' => 'required',
                ];
                break;
            
            default:
                $rules = [
                    'email'    => 'required|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                    'user_type' => 'required',
                ];
                break;
        }

        if(!env('DEV_ENVIRONMENT'))
            $rules['captcha'] = 'required|captcha';

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
            'captcha.captcha' => 'Invalid captcha'
        ];

        //validate the request.
        $request->validate($rules, $messages);
    }


    public function registerUserRlmm (Request $request)
    {
        if ($request->isMethod('get')) {
            $countries = Country::all();
            $state = State::all();
            $auditData = array('action_type' => 'Register', 'description' => 'User View Register Page', 'user_type' => 'USER');
            $this->auditTrail($auditData);
            return view('auth.rlmmregister', compact('countries', 'state'));
        } else {
            // print_r($_POST);DIE;
            $key = hex2bin("0123456789abcdef0123456789abcdef");
            $iv = hex2bin("abcdef9876543210abcdef9876543210");
            // $request->validate(
            //         [
            //             'name' => 'required|string|regex:/^[a-zA-Z ]*$/|max:20',
            //             'email' => 'required|email|unique:rlmm_manufacturer_users,email',
            //             'phone' => 'required|numeric|digits:10|unique:rlmm_manufacturer_users,phone',
            //             'pan' => 'required|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/i|unique:rlmm_manufacturer_users,pan',
            //             'gst' => 'required|regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/|unique:rlmm_manufacturer_users,gst',
            //             'address' => 'required',
            //             'country_id' => 'required',
            //             'state_id' => 'required_if:country_id,99',
            //             'district_id' => 'required_if:country_id,99',
            //             'pincode' => 'required'
            //         ],
            //         [
            //             'name.regex' => 'The name must only contain letters and spaces.',
            //             'name.max' => 'The name must not exceed 20 characters.',
            //             'email.required' => 'Please enter an email address.',
            //             'email.email' => 'Please enter a valid email.',
            //             'email.unique' => 'This email is already registered.',
            //             'phone.required' => 'Please enter mobile number.',
            //             'phone.numeric' => 'The mobile number must be numeric.',
            //             'phone.digits' => 'The mobile number must be 10 digits.',
            //             'phone.unique' => 'This mobile number is already registered.',
            //             'pan.required' => 'The PAN number field is required.',
            //             'pan.regex' => 'The PAN number format is not valid.',
            //             'pan.unique' => 'This PAN is already registered.',
            //             'gst.required' => 'The GST number field is required.',
            //             'gst.regex' => 'The GST number format is not valid.',
            //             'gst.unique' => 'This GST number is already registered.',
            //             'country_id.required' => 'Please choose your country.',
            //             'state_id.required_if' => 'State is required for selected country.',
            //             'district_id.required_if' => 'District is required for selected country.',
            //             'address.required' => 'Please enter your address.',
            //             'pincode.required' => 'Please enter the pincode.',
            //         ]
            //     );
            // Step 1: Validate required fields except PAN
            $basicValidationRules = [
                'name' => 'required|string|regex:/^[a-zA-Z ]*$/|max:20',
                'email' => 'required|email|unique:rlmm_manufacturer_users,email',
                'phone' => 'required|numeric|digits:10|unique:rlmm_manufacturer_users,phone',
                // 'gst' => 'required|regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/|unique:rlmm_manufacturer_users,gst',
                'address' => 'required',
                'country_id' => 'required',
                'state_id' => 'required_if:country_id,99',
                'district_id' => 'required_if:country_id,99',
                'pincode' => 'required|digits:6',
            ];

            // Validate initial set
            $validated = $request->validate($basicValidationRules);

            // Now safely decrypt PAN
            // $decryptedPan = openssl_decrypt($request->pan, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            // $decryptedPan = trim($decryptedPan);

            // if (!$decryptedPan || !preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/i', $decryptedPan)) {
            //     return back()->withErrors(['pan' => 'The PAN number is invalid or corrupted.'])->withInput();
            // }

            // $request->merge(['pan' => $decryptedPan]);

            $key = hex2bin("0123456789abcdef0123456789abcdef");
            $iv  = hex2bin("abcdef9876543210abcdef9876543210");

            // ---- DECRYPT PAN ----
            $decryptedPan = openssl_decrypt(
                $request->pan,
                'AES-128-CBC',
                $key,
                OPENSSL_ZERO_PADDING,
                $iv
            );
            $decryptedPan = trim($decryptedPan);

            if (!$decryptedPan || !preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]$/i', $decryptedPan)) {
                return back()->withErrors(['pan' => 'The PAN number is invalid or corrupted.'])->withInput();
            }

            $request->merge(['pan' => $decryptedPan]);


            // ---- DECRYPT GST ----
            $decryptedGst = openssl_decrypt(
                $request->gst,
                'AES-128-CBC',
                $key,
                OPENSSL_ZERO_PADDING,
                $iv
            );
            $decryptedGst = trim($decryptedGst);

            if (!$decryptedGst || !preg_match('/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z][1-9A-Z]Z[0-9A-Z]$/i', $decryptedGst)) {
                return back()->withErrors(['gst' => 'The GST number is invalid or corrupted.'])->withInput();
            }

            $request->merge(['gst' => $decryptedGst]);


            // Now validate PAN separately
            $request->validate([
                'pan' => 'required|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/i|unique:rlmm_manufacturer_users,pan',
                 'gst' => 'required|regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/|unique:rlmm_manufacturer_users,gst'
            ]);


            //dd($request->all());
            //$password=$this->generateRandomString(8);
            $password = '123456';

            $email = $request->input('email');
            $name = $request->input('name');
            $user = new RlmmUser;
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->pan = $request->input('pan');
            $user->gst = $request->input('gst');
            $user->address = $request->input('address');
            $user->country_id = $request->input('country_id');
            $user->state_id = $request->input('state_id');
            $user->district_id = $request->input('district_id');
            $user->pin_code = $request->input('pincode');
            //dd($user);
            $user->save();
            try {
                $auditData = array('action_type' => 'Register', 'description' => 'User Register Successfuly', 'user_type' => 'USER');
                $this->auditTrail($auditData);
                $this->emailSmsNotifications->notifyManufacturerRegistration($email, $password, $name);

            } catch (\Throwable $th) {
                //throw $th;
                $auditData = array('action_type' => 'Register', 'description' => $th->getMessage(), 'user_type' => 'USER');
                $this->auditTrail($auditData);
                dd($th->getMessage());
            }

            return redirect('/rmllogin')->with('status', 'Your account has been registered successfully. Please check your email for credentials');
        }
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Attendees;
use App\Libraries\CommonClass;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $common;

    public function __construct()
    {
        $this->common = new CommonClass();
    }

    public function index()
    {
        if (session()->get('is_verified')) {
            // return redirect('countdown');
            return redirect('conference');

        }
        $event =  DB::table('event')->where('ae_id', env('EVENT_ID'))->first();
        $speakers = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company', 'ap_id')->where('ap_as_id', '=', env('EVENT_ID'))->get();

        // dd($event);
        return $this->common->front_view('pages.home', compact('event', 'speakers'));
    }

    public function login(Request $request)
    {
        try {
            // update user status
            $user = Attendees::select('au_id', 'au_unique_id', 'au_email', 'au_phone', 'au_fname', 'au_lname', 'au_company', 'au_job_title')->where('au_forms', '=', env('EVENT_SLUG'))->where('au_email', '=', $request->email)->orWhere('au_phone', '=', $request->email)->get()->first();


            if (!empty($user)) {
                $request->session()->put('username', $user->au_fname.' '.$user->au_lname);
                $request->session()->put('useremail', $user->au_email);
                $request->session()->put('userphone', $user->au_phone);
                $request->session()->put('userid', $user->au_unique_id);
                $request->session()->put('job_title', $user->au_job_title);
                $request->session()->put('company', $user->au_company);
                $request->session()->put('daid', $user->au_id);
                $request->session()->put('is_verified', 1);

                $this->common->session_start_tracking($user->au_id, 'login', $request->ip());

                // return redirect('countdown');
                return redirect('conference');
            } else {
                return redirect()->back()->with('msg', 'You have not registered for event.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('msg', $e->getMessage());
        }
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            
            try {
                $fname = $request->fname;
                $lname = $request->lname;
                $email = $request->email;
                $phone = $request->phone;
                $company = $request->company;
                $job_title = $request->job_title;
                $address = $request->address;
                $city = $request->city;
                $country = $request->country;
                $form_id = $request->form;
                $source = $request->source;
                $pincode = $request->pincode;
                $sessionData = $request->sessions;

                // create unique key
                $unique_id = $this->common->getToken(10);

                $is_exists = Attendees::select('au_id')->where('au_email', '=', $email)->where('au_forms', '=', $form_id)->get()->first();
                // dd($is_exists);
                if (!empty($is_exists)) {
                    $attendee_id = $is_exists->au_id;
                } else {
                    DB::enableQueryLog();
                    $data = Attendees::create(
                    [
                        'au_name' => $fname.' '.$lname,
                        'au_fname' => $fname,
                        'au_lname' => $lname,
                        'au_email' => $email,
                        'au_phone' => $phone,
                        'au_company' => $company,
                        'au_job_title' => $job_title,
                        'au_address' => $address,
                        'au_city' => $city,
                        'au_country' => $country,
                        'au_forms' => $form_id,
                        'au_unique_id' => $unique_id,
                        'au_source' => $source,
                        'au_pincode' => $pincode,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]
                );

                    $query = DB::getQueryLog();

                    $attendee_id = $data->id;
                }

            //     if(!empty($sessionData)){
            //     foreach ($sessionData as $row) {
            //         DB::enableQueryLog();
            //         $is_added = DB::table('session_attendees_mappings')
            //         ->select( 'asam_id')
            //         ->where('asam_au_id', '=', $attendee_id)->where('asam_as_id', '=', $row['key'])->get()->first();

            //         if (empty($is_added)) {
                        
            //                 DB::table('session_attendees_mappings')->insert([
            //                     'asam_au_id' => $attendee_id,
            //                     'asam_as_id' => $row['key'],
            //                     'asam_login_url' => $row['join_url'],
            //                     'asam_created_at' => date('Y-m-d H:i:s')
            //                 ]);
                        
            //         } else {
            //             DB::table('session_attendees_mappings')->where('asam_id', '=', $is_added->asam_id)->update([
            //                 'asam_au_id' => $attendee_id,
            //                 'asam_as_id' => $row['key'],
            //                 'asam_login_url' => $row['join_url'],
            //                 'asam_updated_at' => date('Y-m-d H:i:s')
            //             ]);
            //         }
            //     }
            // }

                return  response()->json([
                'status' => 200,
                'msg' => 'User Registered',
            ], 200);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 304);
            }
        } else {
            return  response()->json([
                'status' => 400,
                'msg' => 'Wrong Request',
            ], 400);
        }
    }

    public function logout()
    {
        session()->forget('username');
        session()->forget('useremail');
        session()->forget('userphone');
        session()->forget('userid');
        session()->forget('job_title');
        session()->forget('company');
        session()->forget('daid');
        session()->forget('is_verified');

        $this->common->session_end_tracking(session()->get('session_id'));

        return redirect('/');
    }

    public function view_profile(Request $request)
    {
        // get attendees details
        $user = Attendees::where('au_id', '=', $request->session()->get('daid'))->get()->first();

        // get attendees session details
        $sessions = DB::table('session_speakers_mapping')->select('session_attendees_mappings.asam_login_url', 'session_speakers_mapping.assm_title')->join('session_attendees_mappings', 'session_attendees_mappings.asam_as_id', '=', 'session_speakers_mapping.assm_webinar_id')->where('session_attendees_mappings.asam_au_id', '=', session()->get('daid'))->get();

        //dd($sessions);
        

        // return view
        return $this->common->front_view('pages.profile', compact('user', 'sessions'));
    }

    public function edit_profile(Request $request)
    {
        // get attendees details
        $user = Attendees::where('au_id', '=', $request->session()->get('daid'))->get()->first();
        // update on post
        if ($request->isMethod('post')) {
            Attendees::where('au_id', '=', $request->session()->get('daid'))->update([
                'au_fname' => $request->fname,
                'au_lname' => $request->lname,
               'au_phone' => $request->phone,
                'au_company' => $request->organization,
                'au_job_title' => $request->job_title,
                'au_address' => $request->address,
                'au_city' => $request->city,
                'au_pincode' => $request->zipCode,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->back();
        } else {
            return $this->common->front_view('auth.edit-profile', compact('user'));
        }
    }

    public function ajaxlogin(Request $request)
    {
        try {
            // update user status
            $user = Attendees::select('au_id', 'au_unique_id', 'au_email', 'au_phone', 'au_fname', 'au_lname', 'au_company', 'au_job_title')->where('au_forms', '=', env('EVENT_SLUG'))->where('au_email', '=', $request->email)->orWhere('au_phone', '=', $request->email)->get()->first();


            if (!empty($user)) {
                return  response()->json([
                    'status' => 200,
                    'msg' => 'User Registered',
                ], 200);
            } else {
                return  response()->json([
                    'status' => 300,
                    'msg' => 'User not Registered',
                ], 200);
            }
        } catch (Exception $e) {
            return  response()->json([
                'status' => 500,
                'msg' =>  $e->getMessage(),
            ], 500);
        }
    }

    
    public function mass_user_login($page, $event_id = '', Request $request){
        try {
            $limit = 25;
            $start = ($page - 1) * $limit;
            $users = Attendees::select('au_id', 'au_unique_id', 'au_email', 'au_phone', 'au_fname', 'au_lname', 'au_company', 'au_job_title')->where('au_forms', '=', env('EVENT_SLUG'))->offset($start)->limit($limit)->get();


            if (!empty($users)) {
              //  print_r($users); exit;
              echo '  <script type="text/javascript" src="https://dev.expressbpd.in/socket.io/socket.io.js"></script>
              <script type="text/javascript">           
const socket = io("https://dev.expressbpd.in");    </script>';
                foreach($users as $user){
                    $request->session()->put('username', $user->au_fname.' '.$user->au_lname);
                    $request->session()->put('useremail', $user->au_email);
                    $request->session()->put('userphone', $user->au_phone);
                    $request->session()->put('userid', $user->au_unique_id);
                    $request->session()->put('job_title', $user->au_job_title);
                    $request->session()->put('company', $user->au_company);
                    $request->session()->put('daid', $user->au_id);
                    $request->session()->put('is_verified', 1);
    
                    $this->common->session_start_tracking($user->au_id, 'login', $request->ip());


                //     DB::table('total_attendees')->insert(
                //         array(
                //                'ta_id'     =>   $user->au_id, 
                //                'ta_event'   =>   '16',
                //                'ta_name'   =>   $user->au_fname.' '.$user->au_lname,
                //                'ta_email'   =>   $user->au_email,
                //                'ta_unique_name'   =>   $user->au_email,
                //                'ta_company'   =>   $user->au_company,
                //                'ta_jobtitle'   =>   $user->au_job_title,
                //                'ta_join_time'   =>   date('Y-m-d H:i:s'),
                //                'ta_created_on'   =>   date('Y-m-d H:i:s'),
                //         )
                //    );
                   
                echo '
              
                <script type="text/javascript">
    
//Live Attendees Count
socket.emit("attendeesCount", {
  name: "'. $user->au_fname.' '.$user->au_lname.'",
  email: "'.$user->au_email.'",
  jobtitle: "'.$user->au_job_title.'",
  company: "'.$user->au_company.'",
  page: "agenda",
  events: 16,
  userId: "'.$user->au_id.'",
});';

if($event_id != ''){

echo 'socket.emit("liveAttendeesCount", {
    name: "'. $user->au_fname.' '.$user->au_lname.'",
    email: "'.$user->au_email.'",
    jobtitle: "'.$user->au_job_title.'",
    company: "'.$user->au_company.'",
    page: "lobby",
    events: '.$event_id.',
    userId: "'.$user->au_id.'",
  });'; 
} 
  echo '              </script>
                ';
    
                  
                }
               
            } else {
                return redirect()->back()->with('msg', 'You have not registered for event.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('msg', $e->getMessage());
        }
    }

}

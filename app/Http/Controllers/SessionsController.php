<?php

namespace App\Http\Controllers;

use App\Libraries\CommonClass;
use DB;

class SessionsController extends Controller
{
    public $common;

    public function __construct()
    {
        $this->common = new CommonClass();
    }

    public function index()
    {
        
    
        // get event details
        $event_details = DB::table('event')->select('ae_title', 'ae_details')->where('ae_id', env('EVENT_ID'))->first();

            // get speakers and title from mapping table
            $sessions = DB::table('session_speakers_mapping')
            ->join('sessions', 'sessions.as_id', '=', 'session_speakers_mapping.assm_as_id')
            ->select('assm_id', 'assm_title', 'assm_ap_id', 'assm_start_time', 'assm_as_id', 'assm_end_time', 'assm_webinar_id', 'assm_asp_id', 'assm_status', 'assm_moderator_id', 'assm_panelists_id', 'assm_url')
            ->where('sessions.as_ae_id', '=',  env('EVENT_ID'))->orderBy('assm_status', 'DESC')->orderBy('assm_start_time', 'ASC')->limit(3)->get();
        //    dd( $sessions);
            foreach ($sessions as $sp) {

                // 
                
                $seakersArr = explode(',', $sp->assm_ap_id);
                $panelistsArr = explode(',', $sp->assm_panelists_id);

                // speakers
                $sp->speakers = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->whereIn('ap_id', $seakersArr)->get();

                // Panalist
                if (!empty($panelistsArr)) {
                    $sp->panelists = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->whereIn('ap_id', $panelistsArr)->get();
                }

                // moderator
                if ($sp->assm_moderator_id) {
                    $sp->moderator = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->where('ap_id', '=', $sp->assm_moderator_id)->get()->first();
                }
                DB::enableQueryLog();
                $url = DB::table('session_attendees_mappings')
                ->select('asam_login_url')
                ->where('asam_au_id', '=', session()->get('daid'))
                ->where('asam_as_id', '=', $sp->assm_webinar_id)
                ->get()->first();

                $query = DB::getQueryLog();

                //  dd($query);

                $sp->login_url = (!empty($url)) ? $url->asam_login_url : '#';

               
            }

            $speakers = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company', 'ap_id')->where('ap_as_id', '=', env('EVENT_ID'))->get();

        $bgImgClass = 'conferencebg';
        return $this->common->front_view('pages.conference', compact('bgImgClass', 'sessions', 'speakers', 'event_details'));
    }


    public function countdown()
    {
        return $this->common->front_view('layouts.countdown');
    }
    
    public function agenda()
    {
       
        $sessions = DB::table('sessions')
        ->select('as_date', 'as_start_time', 'as_end_time', 'as_status', 'as_id')
        ->where('as_ae_id', '=', env('EVENT_ID'))
        ->get();

        $activeSessions = $pastSessions = [];
        $i = 0;
        foreach ($sessions  as $session) {

            // get speakers and title from mapping table
            $session->individual_sessions = DB::table('session_speakers_mapping')
            ->select('assm_id', 'assm_title', 'assm_ap_id', 'assm_start_time', 'assm_as_id', 'assm_end_time', 'assm_webinar_id as login_url', 'assm_asp_id', 'assm_status', 'assm_moderator_id', 'assm_panelists_id', 'assm_url')
            ->where('assm_as_id', $session->as_id)->orderBy('assm_status', 'DESC')->orderBy('assm_start_time', 'ASC')->get();
           // dd( $session->individual_sessions);
            foreach ($session->individual_sessions as $sp) {

                // if($sp->assm_status == 2){

                //    // dd(session()->get('daid'));

                //     $is_exists = DB::table('session_trackings')->select('st_id')->where('st_au_id', '=', session()->get('daid'))->where('st_as_id', '=', $sp->assm_id)->where('st_track_type', '=', 'session_tracking')->get()->first();
                //     // dd($sp->assm_id);
                //     if(empty($is_exists) && session()->get('daid')){
                //      $this->session_start_tracking(session()->get('daid'), 'session_tracking', '', $sp->assm_id, '');
                //     }
                //     setcookie('event_id', $sp->assm_id,  (86400 * 30), '/' );
                //     // $_COOKIE['event_id'] = $sp->assm_id;
                // }
                
                $seakersArr = explode(',', $sp->assm_ap_id);
                $panelistsArr = explode(',', $sp->assm_panelists_id);

                // speakers
                $sp->speakers = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->whereIn('ap_id', $seakersArr)->get();

                // Panalist
                if (!empty($panelistsArr)) {
                    $sp->panelists = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->whereIn('ap_id', $panelistsArr)->get();
                }

                // moderator
                if ($sp->assm_moderator_id) {
                    $sp->moderator = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->where('ap_id', '=', $sp->assm_moderator_id)->get()->first();
                }
                DB::enableQueryLog();
                $url = DB::table('session_attendees_mappings')
                ->select('asam_login_url')
                ->where('asam_au_id', '=', session()->get('daid'))
               // ->where('asam_as_id', '=', $sp->assm_webinar_id)
                ->get()->first();

                $query = DB::getQueryLog();

                //  dd($query);

                // $sp->login_url = (!empty($url)) ? $url->asam_login_url : '#';

                // sponsors
                $sponsorsArr = explode(',', $sp->assm_asp_id);

                $sp->sponsors = DB::table('sponsors')->select('asp_slug', 'asp_logo')->whereIn('asp_id', $sponsorsArr)->get();
            }


            ++$i;
        }

        return $this->common->front_view('layouts.agenda', compact('sessions'));
    }

    public function assets()
    {
        $pdfs = DB::table('downloads')->select('ad_url', 'ad_title', 'ad_id')->where('ad_type', '=', 'agile-content-management')->get();

        $videos = DB::table('downloads')->select('ad_url', 'ad_title', 'ad_id')->where('ad_asp_slug', '=', 'data-driven-insights')->get();

        $speakers = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company', 'ap_id')->where('ap_company', '=', 'LogMeIn')->get();

        return $this->common->front_view('auth.assets', compact('pdfs', 'videos', 'speakers'));
    }

    public function lobby($session_id)
    {

        $id = $this->base64url_decode($session_id);
        $live_session = DB::table('session_speakers_mapping')
        ->select('assm_id', 'assm_title', 'assm_ap_id', 'assm_start_time', 'assm_as_id', 'assm_end_time', 'assm_webinar_id', 'assm_asp_id', 'assm_status', 'assm_moderator_id', 'assm_panelists_id', 'assm_url', 'assm_description')->where('assm_id', $id)->first(); 
        
        $sessions = DB::table('session_speakers_mapping')
            ->join('sessions', 'sessions.as_id', '=', 'session_speakers_mapping.assm_as_id')
            ->select('assm_id', 'assm_title', 'assm_ap_id', 'assm_start_time', 'assm_as_id', 'assm_end_time', 'assm_webinar_id', 'assm_asp_id', 'assm_status', 'assm_moderator_id', 'assm_panelists_id', 'assm_url')
            ->where('sessions.as_ae_id', '=',  env('EVENT_ID'))->orderBy('assm_status', 'DESC')->orderBy('assm_start_time', 'ASC')->limit(3)->get();
        //    dd( $sessions);
            foreach ($sessions as $sp) {

                // 
                
                $seakersArr = explode(',', $sp->assm_ap_id);
                $panelistsArr = explode(',', $sp->assm_panelists_id);

                // speakers
                $sp->speakers = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->whereIn('ap_id', $seakersArr)->get();

                // Panalist
                if (!empty($panelistsArr)) {
                    $sp->panelists = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->whereIn('ap_id', $panelistsArr)->get();
                }

                // moderator
                if ($sp->assm_moderator_id) {
                    $sp->moderator = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->where('ap_id', '=', $sp->assm_moderator_id)->get()->first();
                }
                DB::enableQueryLog();
                $url = DB::table('session_attendees_mappings')
                ->select('asam_login_url')
                ->where('asam_au_id', '=', session()->get('daid'))
                ->where('asam_as_id', '=', $sp->assm_webinar_id)
                ->get()->first();

                $query = DB::getQueryLog();

                //  dd($query);

                $sp->login_url = (!empty($url)) ? $url->asam_login_url : '#';

               
            }
       $speakers = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company', 'ap_id')->where('ap_as_id', '=', env('EVENT_ID'))->get();


       $bgImgClass = 'conferencebg';
        return $this->common->front_view('pages.lobby', compact('bgImgClass', 'sessions', 'live_session', 'speakers'));
    }

    public function session($session_id)
    {

        $id = $this->base64url_decode($session_id);
        $live_session = DB::table('session_speakers_mapping')
        ->select('assm_id', 'assm_title', 'assm_ap_id', 'assm_start_time', 'assm_as_id', 'assm_end_time', 'assm_webinar_id', 'assm_asp_id', 'assm_status', 'assm_moderator_id', 'assm_panelists_id', 'assm_url', 'assm_description')->where('assm_id', $id)->first(); 

        // dd($live_session);
        
       $bgImgClass = 'conferencebg';
        return $this->common->front_view('pages.session', compact('bgImgClass', 'live_session'));
    }

    function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

  
    public function awards()
    {
        return $this->common->front_view('pages.awards');
    }

    
    public function survey()
    {
        $bgImgClass = 'mainscreensurvay';
        return $this->common->front_view('pages.survey', compact('bgImgClass'));
    }

    public function save_response(Request $request)
    {
        if ($request->isMethod('post')) {
            
            try {
                $form = 'crn_channel_leadership';
                $name = session()->get('username');
                $cname = session()->get('company');
                $email = session()->get('useremail');
                $objectives = $request->objectives;
                $session_useful = implode(', ',$request->session_useful);
                $area_research = implode(', ',$request->area_research);
                $technologies = $request->technologies;
                $instruments = $request->instruments;
                $rd_developing = $request->rd_developing;
                $chk_interested = implode(', ',$request->chk_interested);
                $rd_timeframe = $request->rd_timeframe;
                $marketing = $request->marketing;
                $tas_know_instrument = $request->rd_software;
                $rd_developing_others = $request->rd_developing_others;
                $rd_developing = $rd_developing . $rd_developing_others;
                $chk_interested_others = $request->chk_interested_others;
                $chk_interested = $chk_interested . $chk_interested_others;
                $tas_know_instrument_others= $request->rd_software_others;

                DB::table('aligent_survey')->insert([
                    'tas_forms' => $form,
                    'tas_au_id' => session()->get('daid'),
                    'tas_webinar_adjective' => $objectives,
                    'tas_useful_session' => $session_useful,
                    'tas_area_of_research' => $area_research,
                    'tas_technologies_frequently_use' => $technologies,
                    'tas_instruments_research' => $instruments,
                    'tas_developing' => $rd_developing,
                    'tas_timeframe' => $rd_timeframe,
                    'tas_purchase_instrument' => $chk_interested,
                    'tas_purchase_others' => $chk_interested_others,
                    'tas_know_instrument' => $tas_know_instrument,
                    'tas_know_instrument_others' => $tas_know_instrument_others,
                    'tas_developing_other' => $rd_developing_others,
                    'tas_ip' => $request->ip(),
                    'tas_created_on' => date('Y-m-d H:i:s'),
                ]);


                // send message to admin

                $subject = 'Survey Feedback for Omics and its relevance in understanding disease mechanisms';

                $headers = '<p style="font-weight: normal; color: #000; font-size: 13px;font-family: Verdana, \'sans-serif\', Calibri, Arial; margin: 10px 7px 0 3px;word-spacing:0px;padding:8px 0;font-weight:600;">Survey Data for Omics and its relevance in understanding disease mechanisms as follows: - </p><br>';
              
                $headers .= '<p style="color:#000;margin:0 auto;padding:8px 0 0; margin: 0 7px 0 5px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;"> <strong>(1)Did the webinar meet your objective?: </strong> - ' . $objectives . "</p>";
                $headers .= '<p style="color:#000;margin:0 auto;padding:8px 0 0; margin: 0 7px 0 5px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;"> <strong>(2) Which session was most useful for you?: -  </strong>' . $session_useful . "</p>";
                $headers .= '<p style="color:#000;margin:0 auto;padding:8px 0 0; margin: 0 7px 0 5px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;"> <strong>(3)What is your area of research?: -  </strong>' . $area_research . "</p>";
                $headers .= '<p style="color:#000;margin:0 auto;padding:8px 0 0; margin: 0 7px 0 5px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;"> <strong>(4) Which omics technologies you frequently use?: -  </strong>' . $technologies . "</p>";
                $headers .= '<p style="color:#000;margin:0 auto;padding:8px 0 0; margin: 0 7px 0 5px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;"> <strong>(5) Please specify instruments you currently use for your research.: -  </strong>' . $instruments . "</p>";
                $headers .= '<p style="color:#000;margin:0 auto;padding:8px 0 ; margin: 0 7px 0 5px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;"> <strong>(6) Do you need help in developing any of your applications? If yes, please specify: -  </strong>' . $rd_developing . "</p>";
                $headers .= '<p style="color:#000;margin:0 auto;padding:8px 0 ; margin: 0 7px 0 5px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;"> <strong>(7) Please specify instruments that you would be interested to purchase: -  </strong>' . $chk_interested . "</p>";
                $headers .= '<p style="color:#000;margin:0 auto;padding:8px 0 ; margin: 0 7px 0 5px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;"> <strong>(8) Buying time frame: -  </strong>' . $rd_timeframe . "</p>";
                $headers .= '<p style="color:#000;margin:0 auto;padding:8px 0 ; margin: 0 7px 0 5px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;"> <strong>(9) Would you like to know more about any particular Agilent instrument/software? If yes, please specify: -  </strong>' . $tas_know_instrument . "</p>";
                $headers .= '<p style="color:#000;margin:0 auto;padding:8px 0 ; margin: 0 7px 0 5px;font-family: Verdana, \'sans-serif\', Calibri, Arial; font-size: 13px;font-weight:normal;"> <strong>Yes, This is co-hosted by Express Healthcare and Agilent Technologies: -  </strong>' . $marketing . "</p>";

                
                $this->common->send_mail('Sangita Kendre', 'sangita.kendre@indianexpress.com', $headers, $subject, 'mail');
                $this->common->send_mail('pavneet sahni', 'pavneet.sahni@indianexpress.com', $html, $subject, 'mail');


                return  response()->json([
                    'status' => 200,
                    'msg' =>  'Responses added',
                ], 200);
            } catch (Exception $e) {
                return response()->json(['status' => 201, 'error' => $e->getMessage()], 201);
            }
        } else {
            return  response()->json([
                'status' => 202,
                'msg' => 'Wrong Request',
            ], 202);
        }
    }

    public function ajax_agenda(){
        $html = '';
        $sessions = DB::table('sessions')
        ->select('as_date', 'as_start_time', 'as_end_time', 'as_status', 'as_id')
        ->where('as_ae_id', '=', env('EVENT_ID'))
        ->get();
        
        if(!empty($sessions) ):
        foreach($sessions as $session):
   $html .= '<div class="agendacol1">
        <div class="agendadate">
            <h3>Live Day</h3>
            <h6>'.date("d F, Y D", strtotime($session->as_date)).'</h6>
        </div>
    </div>
    <div class="agendacol2">';

    $individual_sessions = DB::table('session_speakers_mapping')
    ->select('assm_id', 'assm_title', 'assm_ap_id', 'assm_start_time', 'assm_as_id', 'assm_end_time', 'assm_webinar_id as login_url', 'assm_asp_id', 'assm_status', 'assm_moderator_id', 'assm_panelists_id', 'assm_url')
    ->where('assm_as_id', $session->as_id)->orderBy('assm_status', 'DESC')->orderBy('assm_start_time', 'ASC')->get();
        foreach ($individual_sessions as $row):

       $html .= ' <div class="popconfbox "> <div class="popconfboxcol1">';
                if($row->assm_status == 1 || $row->assm_status == 2):
               $html .= '<h6 class="countdown" id="'.$row->assm_id.'"
                    data-date="'. date('M d, Y', strtotime($session->as_date)) .'"
                    data-time="'.date('H:i:s', strtotime($row->assm_start_time)) .'"
                    data-end-time="'. date('H:i:s', strtotime($row->assm_start_time)) .'"
                    data-title="'.$row->assm_title.'" data-url="'. url('lobby/'.$this->base64url_encode($row->assm_id)) .'"><img src="images/clock.png"   alt=""></h6>
                <a href="javascript:" class="live_link" style="display: none" id="live-'.$row->assm_id.'">Live Now<i class="fas fa-video"></i></a>
                <a href="javascript:" data-url="'. url('lobby/'.$this->base64url_encode($row->assm_id)) .'" data-id="'.$row->assm_id.'"
                    data-date="'. date('M d, Y', strtotime($session->as_date)) .'"
                    data-time="'. date('h:i A', strtotime($row->assm_start_time)).'"
                    class="joinNowLink join_link conboxbtn" id="join-'.$row->assm_id.'" data-timeLeft="10"
                    style="display: none;" target="_blank">Watch Session</a>';
                endif;

                if($row->assm_url):
                    $html .= '<a href="'.url('session/'.$this->base64url_encode($row->assm_id)).'"  class="join_link conboxbtn" >Watch
                    Now</a>';
                endif;
                $html .= ' </div>
            <div class="popconfboxcol2">
                
                <div class="popconfboxcol2main">
                    <div class="popconfboxcol2maincol1">
                        <h3>'.date('h:i A', strtotime($row->assm_start_time)).' -
                            '.date('h:i A', strtotime($row->assm_end_time)).'<span>'.$row->assm_title.'</span></h3>';
                            $speakerImgs = [];
                            $seakersArr = explode(',', $row->assm_ap_id);

                            $speakers = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->whereIn('ap_id', $seakersArr)->get();
                if(!empty($speakers) && count($speakers) > 0):

                $html .='    <p><span>Speaker: </span>';

                        foreach ($speakers as $sp):
                            $html .='   <p> <span>'.$sp->ap_name.',</span> '.$sp->ap_designation.', '.$sp->ap_company.'</p>';

                        $speakerImgs[] = '<img src="'.$sp->ap_image.'" alt="" />';
                        endforeach;
                        $html .='  </p>';
                    endif;

                    if ($row->assm_moderator_id) {
                        $moderator = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->where('ap_id', '=', $sp->assm_moderator_id)->get()->first();
                    

                        $html .='     <p><span>Moderator: </span>

                    <p>
                        <span>'.$moderator->ap_name.',</span> '.$row->moderator->ap_designation.',
                        '.$row->moderator->ap_company.'</p>';

                    $speakerImgs[] = '<img src="'.$moderator->ap_image.'" alt="" />';

                    $html .='   </p>';
            }
            $panelistsArr = ($row->assm_panelists_id != '') ? explode(',', $row->assm_panelists_id): [];
                if (!empty($panelistsArr) && count($panelistsArr) > 0) {
                    $panelists = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company')->whereIn('ap_id', $panelistsArr)->get();
                
                    $html .='     <p><span>Panelists: </span>';

                    foreach ($panelists as $sp):
                        $html .='   <p> <span>'.$sp->ap_name.',</span> '.$sp->ap_designation.', '.$sp->ap_company.'
                    </p>';
                  
                    $speakerImgs[] = '<img src="'.$sp->ap_image.'" alt="" />';
                  
                    endforeach;
                    $html .='  </p>';
                }                        
                $html .='  </div>
                    
                    <div class="popconfboxcol2maincol3">';
                        foreach ($speakerImgs as $img):
                            $html .= $img;
                        endforeach;
                      
                        $html .='    </div>
                </div>
                
            </div>
        </div>';
                    endforeach;
 
                    $html .='     </div>';
                endforeach;
            endif;

            echo $html; exit;
    }

    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
      }
}

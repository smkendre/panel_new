<?php

namespace App\Libraries;

use App\Models\SessionTracking;
use DB;
use Mail;

class CommonClass
{
    public function __construct()
    {
        // $options = [
        //     'context' => [
        //         'ssl' => [
        //             'verify_peer' => false,
        //              'verify_peer_name' => false,
        //         ],
        //     ],
        // ];
        //echo 'echo'; exit;
        // $version = new Version2X('http://dev.expressbpd.in:3001');
        //   $version = new Version2X('https://staging.expresstravel.in:3001');
        //print_r($version); exit;
       // $this->client = new Client(new Version2X('https://staging.expresstravel.in:3001', $options));
    }

    public function generateNumericOTP($n)
    {
        // Take a generator string which consist of
        // all numeric digits
        $generator = '1357902468';

        // Iterate for n-times and pick a single character
        // from generator and append it to $result

        // Login for generating a random character from generator
        //     ---generate a random number
        //     ---take modulus of same with length of generator (say i)
        //     ---append the character at place (i) from generator to result

        $result = '';

        for ($i = 1; $i <= $n; ++$i) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        // Return result
        return $result;
    }

    public function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) {
            return $min;
        } // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);

        return $min + $rnd;
    }

    public function getToken($length)
    {
        $token = '';
        $codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codeAlphabet .= 'abcdefghijklmnopqrstuvwxyz';
        $codeAlphabet .= '0123456789';
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; ++$i) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];
        }

        return $token;
    }

    public function send_mail($name, $email, $message, $subject, $template='mailtemplate')
    {
        try {
            $data = ['name' => $name, 'content' => $message];

            Mail::send(['html' => 'layouts.'.$template], $data, function ($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
                $message->from(env('MAIL_FROM_ADDRESS'), session()->get('username'));
            });
        } catch (\Exception $e) {
            dd($e);

            return $e;
        }
    }

    public function getDateDifference($d1, $d2, $format)
    {
        $return = '';

        // Declare and define two dates
        $date1 = strtotime($d1);
        $date2 = strtotime($d2);

        // Formulate the Difference between two dates
        $diff = abs($date2 - $date1);

        // To get the year divide the resultant date into
        // total seconds in a year (365*60*60*24)
        $years = floor($diff / (365 * 60 * 60 * 24));

        // To get the month, subtract it with years and
        // divide the resultant date into
        // total seconds in a month (30*60*60*24)
        $months = floor(($diff - $years * 365 * 60 * 60 * 24)
                               / (30 * 60 * 60 * 24));

        // To get the day, subtract it with years and
        // months and divide the resultant date into
        // total seconds in a days (60*60*24)
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
             $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        // To get the hour, subtract it with years,
        // months & seconds and divide the resultant
        // date into total seconds in a hours (60*60)
        $hours = floor(($diff - $years * 365 * 60 * 60 * 24
       - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)
                                   / (60 * 60));

        // To get the minutes, subtract it with years,
        // months, seconds and hours and divide the
        // resultant date into total seconds i.e. 60
        $minutes = floor(($diff - $years * 365 * 60 * 60 * 24
         - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
                          - $hours * 60 * 60) / 60);

        // To get the minutes, subtract it with years,
        // months, seconds, hours and minutes
        $seconds = floor(($diff - $years * 365 * 60 * 60 * 24
         - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
                - $hours * 60 * 60 - $minutes * 60));

        switch ($format) {
          case 'year': $return = $years; break;
          case 'month': $return = $months; break;
          case 'day': $return = $days; break;
          case 'minute': $return = $minutes; break;
          case 'hour': $return = $hours; break;
          case 'second': $return = $seconds; break;
          default:  $return = $minutes; break;
        }

        return $return;
    }

    public function formatString($text)
    {
        if (!empty($text)) {
            $text = trim($text);
            $text = filter_var($text, FILTER_SANITIZE_STRING);
        //  $text = preg_replace(array('/\s+/', '/[\x00-\x1F\x80-\xFF]/'), array(' ', ''), $text);
        } else {
            $text = '';
        }

        return $text;
    }

    public function session_start_tracking($attendee, $type, $ip, $session_id = 0, $value = '')
    {
        $data = SessionTracking::create([
            'st_au_id' => $attendee,
            'st_as_id' => $session_id,
            'st_track_type' => $type,
            'st_start_datetime' => date('Y-m-d H:i:s'),
            'st_ip' => $ip,
            'st_values' => $value,
            'st_created_at' => date('Y-m-d H:i:s'),
            'st_updated_at' => date('Y-m-d H:i:s'),
        ]);
        //  session()->put('session_id', $data->id);

        return  $data->id;
    }

    public function session_end_tracking($id)
    {
        SessionTracking::where('st_id', '=', $id)->update(['st_end_datetime' => date('Y-m-d H:i:s')]);
    }

    public function get_channel_id($id, $type = 'event')
    {
        if ($type == 'event') {
            $data = DB::table('event')->select('ae_chat_channel')->where('ae_id', '=', $id)->get()->first();

            $return = (!empty($data)) ? $data->ae_chat_channel : '';
        }

        if ($type == 'sponsor') {
            $data = DB::table('sponsors')->select('asp_chat_channel')->where('asp_slug', '=', $id)->get()->first();

            $return = (!empty($data)) ? $data->asp_chat_channel : '';
        }

        return $return;
    }

    public function front_view($view, $data = [], $id = '', $type = 'event')
    {
        // get loggedin users details
        $data['user'] = DB::table('attendees')->where('au_id', '=', session()->get('daid'))->get()->first();

        // get agenda

        $sessions = DB::table('sessions')
        ->select('as_date', 'as_start_time', 'as_end_time', 'as_status', 'as_id')
        ->where('as_ae_id', '=', env('EVENT_ID'))
        ->get();

        $activeSessions = $pastSessions = [];
        $i = 0;
        foreach ($sessions  as $session) {

            // get speakers and title from mapping table
            $session->individual_sessions = DB::table('session_speakers_mapping')
            ->select('assm_id', 'assm_title', 'assm_ap_id', 'assm_start_time', 'assm_as_id', 'assm_end_time', 'assm_webinar_id', 'assm_asp_id', 'assm_status', 'assm_moderator_id', 'assm_panelists_id', 'assm_url')
            ->where('assm_as_id', $session->as_id)->orderBy('assm_status', 'DESC')->orderBy('assm_start_time', 'ASC')->get();
           // dd( $session->individual_sessions);
            foreach ($session->individual_sessions as $sp) {

                if($sp->assm_status == 2){

                   // dd(session()->get('daid'));

                    $is_exists = SessionTracking::select('st_id')->where('st_au_id', '=', session()->get('daid'))->where('st_as_id', '=', $sp->assm_id)->where('st_track_type', '=', 'session_tracking')->get()->first();
                    // dd($sp->assm_id);
                    if(empty($is_exists) && session()->get('daid')){
                        $this->session_start_tracking(session()->get('daid'), 'session_tracking', '', $sp->assm_id, '');
                    }
                    setcookie('event_id', $sp->assm_id,  (86400 * 30), '/' );
                    // $_COOKIE['event_id'] = $sp->assm_id;
                }
                
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

                // sponsors
                $sponsorsArr = explode(',', $sp->assm_asp_id);

                $sp->sponsors = DB::table('sponsors')->select('asp_slug', 'asp_logo')->whereIn('asp_id', $sponsorsArr)->get();
            }


            ++$i;
        }
        $data['agenda'] = $sessions;

       // dd($data);

        // event chat channel id
        $data['chat_channel'] = $this->get_channel_id(env('EVENT_ID'));

        // sponsor chat channel id
        if ($id) {
            $data['sponsor_chat_channel'] = $this->get_channel_id($id, 'sponsor');
        }

        // help desk channel id
        $data['help_chat_channel'] = env('HELP_DESK_CHAT_CHANNEL');

        // get logged in users data
        $data['now_attending'] = DB::table('attendees')
        ->join('session_trackings', 'session_trackings.st_au_id', '=', 'attendees.au_id')
        ->where('st_track_type', '=', 'login')
        ->where('st_start_datetime', '>', date('Y-m-d 00:00:00'))
        ->groupBy('session_trackings.st_au_id')
        ->orderBy('st_start_datetime', 'DESC')->get();

        if (session()->get('is_verified')) {
            $sess_id = $this->session_start_tracking(session()->get('daid'), 'page_visit', request()->ip(), 0, $view);
            if (session()->get('current_page')) {
                // first end last session
                $this->session_end_tracking(session()->get('current_page'));

                // now set new
                session()->put('current_page', $sess_id);
            } else {
                session()->put('current_page', $sess_id);
            }
        }

        $data['event'] = DB::table('event')->where('ae_id', env('EVENT_ID'))->first();

        return view($view, $data);
    }
}

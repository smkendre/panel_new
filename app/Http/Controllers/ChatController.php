<?php

namespace App\Http\Controllers;

use App\Libraries\CommonClass;
use DB;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public $common;

    public function __construct()
    {
        $this->common = new CommonClass();
    }

    public function index()
    {
        $bgImgClass = 'networkingbg';
        return $this->common->front_view('pages.networking', compact('bgImgClass'));
    }

    public function helpdesk()
    {
        return $this->common->front_view('pages.helpdesk');
    }

    public function emailConnect(Request $request)
    {
        if ($request->isMethod('POST')) {
            // dd($request->email);
            $to_id = $request->to_id;
           // $email = $request->email;
            $subject = $request->subject;
            $message = $request->message;
            $receiver_name = $request->receiver_name;
            $from_id = session()->get('daid');
            $username = session()->get('username');

            $user = DB::table('attendees')->select('au_email')->where('au_id', '=', $to_id)->get()->first();
            $email = $user->au_email;

            

            $this->common->send_mail($receiver_name, $email, $message, $subject, 'mail');
            // $user = 
            DB::table('email_connect')->insert([
                      'ec_to_id' => $to_id,
                      'ec_from_id' => $from_id,
                      'ec_email' => $email,
                      'ec_subject' => $subject,
                      'ec_body' => $message,
                      'ec_created_at' => date('Y-m-d H:i:s'),
                  ]);
        }

        return redirect()->back()->with('success', 'Message Sent Successfully');
     
    }

    public function requestmeeting(Request $request)
    {
        return view('pages.requestmeeting');
    }
}

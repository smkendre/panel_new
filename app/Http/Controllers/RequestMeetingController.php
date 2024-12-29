<?php

namespace App\Http\Controllers;

use App\Models\RequestMeeting;
use Illuminate\Http\Request;
use App\Libraries\CommonClass;

class RequestMeetingController extends Controller
{
    public $common;

    public function __construct()
    {
        $this->common = new CommonClass();
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            if ($request->isMethod('post')) {
                $date = $request->sdate;
                $time = $request->stime;
                $msg = $request->msg;
                $sponsor = $request->sponsor;
                $user_id =  $request->session()->get('daid');
    
                RequestMeeting::create(
                    [
                        'rm_au_id' => $user_id,
                        'rm_meeting_date' => date('Y-m-d', strtotime($date)),
                        'rm_meeting_time' => $time,
                        'rm_message' => $msg,
                        'rm_sponsor' => $sponsor,
                        'rm_created_at' => date('Y-m-d H:i:s'),
                    ]
                );

                $html = '	<p
                style="color:#000;margin:0 auto;padding:8px 0;margin:0 7px 0 5px;line-height:24px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:13px;font-weight:normal">
                <span>'.session()->get('username').' has sent meeting request on '.$sponsor.' Data Breaches in the Pandemic World and Beyond
                .</p>
                <p
                style="font-weight:normal;color:#000;font-size:13px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;margin:0 7px 0 3px;word-spacing:0px;padding:8px 0;line-height:25px;">
                Meeting request details are as follows - </p>
         

            <p
                style="color:#000;margin:0 auto;padding:8px 0;margin:0 7px 0 5px;line-height:20px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:13px">
                <span style="color:#4b5aa3;font-weight:bold">Meeting Date: - </span> <a href="javascript:"
                    style="text-decoration:none;color:#000;font-weight:bold">'.date('d F, Y', strtotime($date)).'</a> </p>

            <p
                style="color:#000;margin:0 auto;padding:8px 0;margin:0 7px 0 5px;line-height:20px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:13px">
                <span style="color:#4b5aa3;font-weight:bold">Time: - </span> <a href="javascript:"
                    style="text-decoration:none;color:#000;font-weight:bold">'.date('H:i A', strtotime($time)).'</a></p>

            <p
                style="color:#000;margin:0 auto;padding:8px 0;margin:0 7px 0 5px;line-height:20px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:13px">
                <span style="color:#4b5aa3;font-weight:bold">Message: - </span> <a href="javascript:"
                    style="text-decoration:none;color:#000;font-weight:bold">'.$msg.'</a></p>';


                $subject = 'Meeting Request Received - Data Breaches in the Pandemic World and Beyond                ';

                $this->common->send_mail('Sangita Kendre', 'sangita.kendre@indianexpress.com', $html, $subject, 'mail');
                $this->common->send_mail('pavneet sahni', 'pavneet.sahni@indianexpress.com', $html, $subject, 'mail');
                $this->common->send_mail('Vikram Vora', 'vikram.vora@indianexpress.com', $html, $subject, 'mail');
                $this->common->send_mail('Rohit Divekar', 'rohit.divekar@indianexpress.com', $html, $subject, 'mail');
                $this->common->send_mail('Mansha Pais', 'mansha.pais@indianexpress.com', $html, $subject, 'mail');


                return  response()->json([
                    'status' => 200,
                    'msg' => 'Meeting request sent successfully',
                ], 200);
                
            }else {
                return  response()->json([
                    'status' => 201,
                    'msg' => 'Wrong Request',
                ], 200);
            }
        }
        catch (Exception $e) {
            return response()->json([ 'status' => 304, 'msg' => $e->getMessage()], 200);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequestMeeting  $requestMeeting
     * @return \Illuminate\Http\Response
     */
    public function show(RequestMeeting $requestMeeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestMeeting  $requestMeeting
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestMeeting $requestMeeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestMeeting  $requestMeeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestMeeting $requestMeeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestMeeting  $requestMeeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestMeeting $requestMeeting)
    {
        //
    }
}

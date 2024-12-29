<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\CommonClass;
use DB;
use App\SessionTracking;

class SessionTrackingController extends Controller
{
    public $common;

    public function __construct()
    {
        $this->common = new CommonClass();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track_session(Request $request)
    {
        $id = $this->common->session_start_tracking($request->session()->get('daid'), $request->type, $request->ip(), $request->session_id, $request->value);

        return  response()->json([
            'status' => 200,
            'id' => $id,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function track_close_session(Request $request)
    {
        $this->common->session_end_tracking($request->value);
    }

    public function track_live_session(Request $request)
    {
        try{

            $input = $request->all();
           // dd($request->all());
            $users = $input['users'];

            $event = $input['event'];
            $userArr = explode(',', $users);
            foreach($userArr as $user){
                DB::enableQueryLog();
                $is_exists = SessionTracking::select('st_id')->where('st_au_id', '=', $user)->where('st_as_id', '=', $event)->where('st_track_type', '=', 'session_tracking')->get()->first();
                $query = DB::getQueryLog();

               // dd($query);
                if(empty($is_exists)){
                    // dd('no entry');
                    $data = SessionTracking::create([
                        'st_au_id' => $user,
                        'st_as_id' => $event,
                        'st_track_type' => 'session_tracking',
                        'st_start_datetime' => date('Y-m-d H:i:s'),
                        'st_ip' => '',
                        'st_values' => '',
                        'st_created_at' => date('Y-m-d H:i:s'),
                        'st_updated_at' => date('Y-m-d H:i:s'),
                    ]);

                   //$id = $this->common->session_start_tracking($user, 'session_tracking', $request->ip(), $event, '');
                //    dd($data->id);
                }else{
                    // dd('user already exists');
                }
                
            }
                
    
            return  response()->json([
                'status' => 200,
                'message' => 'success',
            ], 200);
        }catch(Exception $e){
            return  response()->json([
                'status' => 300,
                'message' => $e->getMessage(),
            ], 300);
        }
       
    }
}

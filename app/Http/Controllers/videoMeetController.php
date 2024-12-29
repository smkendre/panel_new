<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\CommonClass;
use App\videoMeetModel;
use Illuminate\Support\Str;
use Auth;
use DB;

class videoMeetController extends Controller
{

  public function __construct() {
    $this->common = new CommonClass();
  }

  public function meeting($Id) {

    $da_id = session()->get('daid');
    $data['meeting'] = DB::table('dts_video_meet')
          ->leftjoin('dts_attendee_video_meet_mapping', 'dvm_id', '=', 'davm_dvm_id')
          ->select('dvm_topic as topic', 'dvm_meet_id as meet_id', 'dvm_password as password', 'dvm_invite_all as invite', 'dvm_created_by as creator', 'dvm_created_on as datetime', 'dvm_id as id', 'dvm_moderator_name as moderator')
          ->where('dvm_id', '=', $Id)
          ->get()->toArray();
    $data['meeting'] = array_shift($data['meeting']);
// dd($data);
    return $this->common->front_view('pages.networking', $data);

  }

  public function createmeet(Request $request) {
    try {
      $input = $request->all();
      $input = json_decode(json_encode($input, false));

      $meet_id = $input->meetid;
      $topic = $this->common->formatString($input->topic);
      $da_id = session()->get('daid');
      $name = session()->get('username');
      $password = $input->password;
      $invite_type = $input->invite;
      $attendee = $input->attendee;

      $meetcount = $this->duplicateMeeting($meet_id);

      if ($meetcount > 0) {
        $response = json_encode(array('message' => 'duplicate'));
        return $response;

      } else {
        $videomeet = array('dvm_meet_id' => $meet_id, 'dvm_topic' => $topic, 'dvm_password' => $password, 'dvm_invite_all' => $invite_type, 'dvm_created_by' => $da_id, 'dvm_moderator_name' => $name);
        // dd($videomeet);
        videoMeetModel::insert($videomeet);
        $id = DB::getPDO()->lastInsertId();

        $meetMapping = array('davm_dvm_id' => $id, 'davm_created_by' => $da_id, 'davm_da_id' => $attendee, 'davm_user_type' => 'A');
        \App\userVideomeetMapping::insert($meetMapping);

        $response = array('message' => 'success', 'id' => $id);
        return $response;
        // return redirect()->route('videomeet')->with('success', "Video Meet Created Successfully.");
      }
      // ->with('data', $response);
    } catch (\Exception $e) {
      // dd($e);
      $response = array('message' => 'failure');
      return $response;
      // return redirect()->back()->with('error', $e->getMessage());
    }
  }

  // public function updateAttendee(Request $request)
  // {
  //   try {
  //       $meetMapping = array('davm_dvm_id' => $id, 'davm_created_by' => $da_id, 'davm_da_id' => $attendee, 'davm_user_type' => 'A');
  //       \App\userVideomeetMapping::WHERE('')->insert($meetMapping);
  //
  //       $response = array('message' => 'success', 'id' => $id);
  //
  //       return $response;
  //   } catch (\Exception $e) {
  //       $response = array('message' => 'failure');
  //       return $response;
  //   }
  //
  // }

  public function duplicateMeeting($meet_id) {

     $wordlist = videoMeetModel::where('dvm_meet_id', '=', $meet_id)->get();
     $wordCount = $wordlist->count();

     return $wordCount;
  }
}

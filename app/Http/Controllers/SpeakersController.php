<?php

namespace App\Http\Controllers;

use App\Libraries\CommonClass;
use DB;

class SpeakersController extends Controller
{
    public $common;

    public function __construct()
    {
        $this->common = new CommonClass();
    }

    public function index()
    {
        $speakers = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company', 'ap_id')->where('ap_as_id', '=', env('EVENT_ID'))->get();

        return $this->common->front_view('pages.speakers', compact('speakers'));
    }
}

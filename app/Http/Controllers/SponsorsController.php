<?php

namespace App\Http\Controllers;

use App\Libraries\CommonClass;
use DB;

class SponsorsController extends Controller
{
    public $common;

    public function __construct()
    {
        $this->common = new CommonClass();
    }

    public function index()
    {
        $sponsors = DB::table('sponsors')->where('asp_ae_id', '=', env('EVENT_ID'))->orderBy('asp_order')->get();
    //    dd($sponsors);

        return $this->common->front_view('pages.sponsors', compact('sponsors'));
    }

    public function resources()
    {
        $pdfs = DB::table('downloads')->select('ad_url', 'ad_title', 'ad_id', 'ad_description', 'ad_image')->where('ad_type', '=', 'PDF')->where('ad_asp_slug', '=', env('EVENT_SLUG'))->get();

        $videos = DB::table('downloads')->select('ad_url', 'ad_title', 'ad_id')->where('ad_type', '=', 'VIDEO')->where('ad_asp_slug', '=', env('EVENT_SLUG'))->get();

        $speakers = DB::table('speakers')->select('ap_image', 'ap_name', 'ap_designation', 'ap_company', 'ap_id', 'ap_description')->where('ap_as_id', '=', env('EVENT_ID'))->get();

        $bgImgClass = 'resourcebg';

        return $this->common->front_view('pages.resources', compact('pdfs', 'videos', 'speakers'));
    }

    public function assets($id)
    {
        $assets = DB::table('downloads')->where('ad_asp_slug', '=', $id)->where('ad_type', '=', 'PDF')->get();

        $videos = DB::table('downloads')->where('ad_asp_slug', '=', $id)->where('ad_type', '=', 'VIDEO')->get();

        $sponsor = DB::table('sponsors')->where('asp_ae_id', '=', 2)->where('asp_slug', '=', $id)->get()->first();
        $channel = $sponsor->asp_chat_channel;

        $next = DB::table('sponsors')->select('asp_slug')->where('asp_order', '>', $sponsor->asp_order)->where('asp_ae_id', '=', 2)->orderBy('asp_order')->first();

        // previous link
        $previous = DB::table('sponsors')->select('asp_slug')->where('asp_order', '<', $sponsor->asp_order)->where('asp_ae_id', '=', 2)->orderBy('asp_order', 'DESC')->first();

        if (!empty($next)) {
            $nextlink = url('resources/'.$next->asp_slug);
        } else {
            $next = DB::table('sponsors')->select('asp_slug')->where('asp_ae_id', '=', 2)->orderBy('asp_order')->first();

            $nextlink = url('resources/'.$next->asp_slug);
        }

        if (!empty($previous)) {
            $previouslink = url('resources/'.$previous->asp_slug);
        } else {
            $previous = DB::table('sponsors')->select('asp_slug')->where('asp_ae_id', '=', 2)->orderBy('asp_order', 'DESC')->first();
            $previouslink = url('resources/'.$previous->asp_slug);
        }

        $videolink = $name = '';

        // dd($sponsor->asp_slug );
        if (in_array($sponsor->asp_slug, ['microsoft', 'amd', 'teamviewer'])) {
            $name = 'boothlink';
            $videolink = 'boothvideo';
        } else {
            $name = 'oraclelink';
            $videolink = 'oraclevideo';
        }

        return $this->common->front_view('pages.assets', compact('assets', 'videos', 'channel', 'sponsor', 'previouslink', 'nextlink', 'name', 'videolink'), $id);
    }
}

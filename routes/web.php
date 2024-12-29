<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SessionTrackingController;
use App\Http\Controllers\SponsorsController;
use App\Http\Controllers\SpeakersController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RequestMeetingController;
use App\Http\Controllers\videoMeetController;
use App\Http\Controllers\ChatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::get('/', [UserController::class, 'index']);


Route::post('/userlogin', [UserController::class, 'login'])->name('userlogin');
Route::post('/ajaxlogin', [UserController::class, 'ajaxlogin']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/api/register', 'UserController@register')->name('api/register');

Route::get('/mass_user_login/{id}/{event_id?}', [UserController::class, 'mass_user_login'])->name('mass_user_login');
Auth::routes();

 Route::group(['middleware' => ['usersession']], function () {
    Route::get('/conference', [SessionsController::class, 'index']);
    Route::get('/lobby/{id}', [SessionsController::class, 'lobby']);
    Route::get('/session/{id}', [SessionsController::class, 'session']);
    Route::get('/agenda', [SessionsController::class, 'agenda']);
    Route::get('/awards', [SessionsController::class, 'awards']);
    Route::get('/countdown',  [SessionsController::class, 'countdown']);
    Route::get('/speakers',  [SpeakersController::class, 'index']);
    Route::post('/survey_response', [SessionsController::class, 'survey_response']);


    Route::get('/networking', [ChatController::class, 'index']);
    Route::get('/networking/{id}', [videoMeetController::class, 'meeting']);
    Route::get('/helpdesk', [ChatController::class, 'helpdesk']);
    Route::post('/emailconnect', [ChatController::class, 'emailConnect'])->name('emailconnect');
    Route::get('/requestmeeting', [ChatController::class, 'requestmeeting']);

    Route::get('/ajax_agenda', [SessionsController::class, 'ajax_agenda']);
    Route::get('/sponsors', [SponsorsController::class, 'index']);
    Route::get('/resource/{id}', [SponsorsController::class, 'assets']);
    Route::get('/assets', [SponsorsController::class, 'resources']);
    Route::post('/track_session_endtime', [SponsorsController::class, 'track_session_endtime']);


    Route::post('/track-event', [SessionTrackingController::class, 'track_session'])->name('track-event');
    Route::post('/track-close-event', [SessionTrackingController::class, 'track_close_session'])->name('track-close-event');
    Route::get('/track-live-session', [SessionTrackingController::class, 'track_live_session'])->name('track-live-session');
    Route::get('/profile', [UserController::class, 'view_profile'])->name('profile');
    Route::get('/edit-profile', [UserController::class, 'edit_profile'])->name('edit-profile');
    Route::post('/edit-profile', [UserController::class, 'edit_profile'])->name('edit-profile');
    Route::post('/createmeet', [videoMeetController::class, 'createmeet'])->name('createmeet');


    Route::post('/request-meeting', [RequestMeetingController::class, 'store'])->name('request-meeting');
    Route::post('/ask-question', [QuestionController::class, 'store'])->name('ask-question');
    Route::post('/get_questions', [QuestionController::class, 'show'])->name('get_questions');
});

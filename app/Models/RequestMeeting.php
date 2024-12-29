<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestMeeting extends Model
{

    const CREATED_AT = 'rm_created_at';
    const UPDATED_AT = 'rm_updated_at';

 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rm_meeting_date', 'rm_meeting_time', 'rm_au_id', 'rm_message', 'rm_sponsor', 'rm_created_at', 'rm_updated_at'
    ];
}


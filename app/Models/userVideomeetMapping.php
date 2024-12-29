<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userVideomeetMapping extends Model
{
  protected $table = 'dts_attendee_video_meet_mapping';

  protected $fillable = [];

  public $timestamps = false;
}

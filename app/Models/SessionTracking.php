<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionTracking extends Model
{
    const CREATED_AT = 'st_created_at';
    const UPDATED_AT = 'st_updated_at';

    protected $fillable = [
        'st_au_id',  'st_as_id', 'st_track_type', 'st_start_datetime', 'st_ip', 'st_values', 'st_created_at', 'st_updated_at',
    ];
}

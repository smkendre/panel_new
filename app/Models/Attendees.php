<?php

namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;

class Attendees extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'au_name', 'au_fname', 'au_lname', 'au_email', 'au_phone', 'au_company', 'au_job_title', 'au_address', 'au_city', 'au_country', 'au_forms', 'au_unique_id', 'au_source', 'au_pincode', 'created_at',
    ];
}

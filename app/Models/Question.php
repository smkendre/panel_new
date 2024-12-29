<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    const CREATED_AT = 'aq_created_at';
    const UPDATED_AT = 'aq_updated_at';

 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aq_id', 'aq_au_id', 'aq_question', 'aq_name', 'aq_email', 'aq_event', 'aq_created_at', 'aq_updated_at'
    ];
}

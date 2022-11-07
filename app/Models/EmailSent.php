<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSent extends Model
{
    protected $table = 'sent_emails';
    protected $guarded = array();
    public static $rules = array();
}

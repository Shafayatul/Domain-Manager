<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Ticket extends Model
{
    /**
    * laravel activity log
    */
    use LogsActivity;

    protected $fillable = ['subject', 'user_id', 'assigned_to'];

    protected static $logAttributes = ['subject', 'user_id', 'assigned_to'];

}

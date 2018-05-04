<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TicketDetail extends Model
{
    /**
    * laravel activity log
    */
    use LogsActivity;
    
    protected $fillable = ['ticket_id', 'user_id', 'content'];

    protected static $logAttributes = ['ticket_id', 'user_id', 'content'];

}

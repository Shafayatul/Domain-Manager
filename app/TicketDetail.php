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
}

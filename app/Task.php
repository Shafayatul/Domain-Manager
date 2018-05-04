<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
{
    /**
    * laravel activity log
    */
    use LogsActivity;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'assign_to', 'due_date', 'domain_name', 'task_type', 'status', 'description'];

    protected static $logAttributes = ['user_id', 'assign_to', 'due_date', 'domain_name', 'task_type', 'status', 'description'];
    
}

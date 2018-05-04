<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use \DataTables;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        return view('activity.index');
    }

    public function datatable_activity_index()
    {

        $activitys = Activity::
        			select(
                		'activity_log.id as id',
                		'activity_log.log_name as log_name',
                		'activity_log.description as description',
                		'activity_log.subject_id as subject_id',
                		'activity_log.subject_type as subject_type',
                		'activity_log.causer_id as causer_id',
                		'activity_log.causer_type as causer_type',
                		'activity_log.properties as properties',
                		'activity_log.created_at as created_at',
                		'activity_log.updated_at as updated_at'
	                );

        return DataTables::of($activitys)->make(true);
    }


}

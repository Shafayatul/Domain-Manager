<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();






//only for logged in users - all admin, specialist and client 
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

//all
Route::group(['middleware' => ['permission:Ticket Detail Management']], function () {   
    Route::get('/ticketDetail/{ticket_id}', 'TicketController@ticketDetail');
    Route::post('/addDetail/{ticket_id}', 'TicketController@addDetail');
});

//only client
Route::group(['middleware' => ['permission:Client Ticket Management']], function () {   
    Route::get('/client/datatable/tickets/index', 'TicketController@datatable_client_index');
    Route::get('/tickets/create', 'TicketController@create');
    Route::get('/tickets/index', 'TicketController@index');
    Route::post('/tickets', 'TicketController@store')->name('tickets.store');
});



//only specialist
Route::group(['middleware' => ['permission:Specialist Ticket Management']], function () {    
    Route::get('/specialist/datatable/tickets/index', 'TicketController@datatable_specialist_index'); 
    Route::get('/specialist/tickets/index', 'TicketController@specialist_index');
    Route::post('/specialist/statusChange', 'TicketController@statusChange');
});



//only admin
Route::group(['middleware' => ['permission:Admin Ticket Management']], function () {
    Route::get('/admin/datatable/tickets/index', 'TicketController@datatable_admin_index');
    Route::get('/admin/tickets/index', 'TicketController@admin_index');
    Route::post('/admin/assignSpecialist', 'TicketController@assignSpecialist');
    Route::post('/admin/statusChange', 'TicketController@statusChange');
});

//only admin
Route::group(['middleware' => ['permission:Activity Log']], function () {
    Route::get('/datatable/activity/index', 'ActivityController@datatable_activity_index');
    Route::get('/activity/index', 'ActivityController@index');
});
//only admin
Route::group(['middleware' => ['permission:Manage User']], function () {
    // Route::get('/datatable/activity/index', 'ActivityController@datatable_activity_index');
    Route::post('/admin/user/store', 'UserController@admin_user_store');
    Route::get('/admin/user/create', 'UserController@admin_user_create');
});

//only admin
Route::group(['middleware' => ['permission:Manage Task']], function () {
    Route::resource('/note',  'NoteController');
    Route::post('/task/ajax_delete', 'TaskController@ajax_delete');
    Route::get('/datatable/task/index', 'TaskController@datatable_task_index');
    Route::get('/task-note/{task_id}', 'NoteController@taskNote');
    Route::resource('/task',  'TaskController');
});

//only admin
Route::group(['middleware' => ['permission:Manage Role']], function () {
    Route::post('/admin/assignRole',  'RoleController@assignRole'); 
    Route::get('/admin/datatable/role_assign', 'RoleController@datatable_user_role');
    Route::get('/admin/role/assign',  'RoleController@assign')->name('role.assign'); 
    Route::resource('/admin/role',  'RoleController');   
});

//only admin
Route::group(['middleware' => ['permission:Manage Permission']], function () {
    Route::get('/admin/permission/assign/{role_id}',  'PermissionController@assign')->name('permission.assign'); 
    Route::post('/admin/permission/assign/store',  'PermissionController@assign_store')->name('permission.assign_store'); 
    Route::resource('/admin/permission',  'PermissionController');  
});

// Route::resource('tickets',  'TicketController');
Route::get('/', function () {
    return view('welcome');
});


<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Task;
use App\User;
use Auth;
use Illuminate\Http\Request;
use \DataTables;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $tasks = Task::latest()->paginate($perPage);
        } else {
            $tasks = Task::latest()->paginate($perPage);
        }

        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $specialists = User::role('Specialist')->get();
        $specialist_array = array();
        $specialist_array[0] = '';
        foreach ($specialists as $specialist) {
            $specialist_array[$specialist->id] = $specialist->name;
        }

        return view('task.create', compact('specialist_array'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        if($request->input('assign_to') == 0){
            $requestData = $request->except(['assign_to']);
            Task::create($requestData + ['user_id' => $user_id, 'assign_to' => $user_id, ]);
        }else{
            $requestData = $request->all();
            Task::create($requestData + ['user_id' => $user_id]);            
        }
        return redirect('task')->with('flash_message', 'Task added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        $specialists = User::role('Specialist')->get();
        $specialist_array = array();
        foreach ($specialists as $specialist) {
            $specialist_array[$specialist->id] = $specialist->name;
        }

        return view('task.edit', compact('task', 'specialist_array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $user_id = Auth::id();
        if($request->input('assign_to') == 0){
            $requestData = $request->except(['assign_to']);
        }else{
            $requestData = $request->all();          
        }
        
        
        $task = Task::findOrFail($id);
        $task->update($requestData);

        return redirect('task')->with('flash_message', 'Task updated!');
    }



    public function ajax_delete(Request $request)
    {
        Task::destroy($request->input('id'));
        return response()->json(array('msg'=> 'Success'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Task::destroy($id);

        return redirect('task')->with('flash_message', 'Task deleted!');
    }



    public function datatable_task_index()
    {

        $tasks = Task::
                select(
                    'tasks.id as id', 
                    // 'tasks.assign_to as assign_to', 
                    'tasks.due_date as due_date', 
                    'tasks.domain_name as domain_name', 
                    'tasks.task_type as task_type', 
                    'tasks.status as status', 
                    'tasks.description as description',
                    'users.name as name_assign_to'
                )
                ->leftJoin('users', 'tasks.assign_to', '=', 'users.id');

        return Datatables::of($tasks)
            ->addColumn('action', function($row){
                return '
                <td>
                    <a href="task-note/'.$row->id.'" title="View task"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Note</button></a>
                    <a href="task/'.$row->id.'/edit" title="Edit task"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    <button class="btn btn-danger btn-sm ajax_delete" title="Delete task" id="'.$row->id.'"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></a>
                </td>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}

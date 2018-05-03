<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\User;
use App\TicketDetail;
use Illuminate\Support\Facades\Storage;
use Session;
use Auth;
use \DataTables;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show all tickets in table
        return view('ticket.clientIndex');
    }

    
    public function ticketDetail($ticket_id)
    {

        // show all tickets in table
        $ticket = Ticket::where('id', $ticket_id)->first();
        $ticket_details = TicketDetail::where('ticket_id', $ticket_id)->get();



        return view('ticket.detail',compact('ticket', 'ticket_details', 'ticket_id'));
    }

    public function admin_index()
    {

        $specialists = User::role('Specialist')->get();
        $tickets = Ticket::orderBy('id','desc')->paginate(20);
        return view('ticket.adminIndex',compact('tickets','specialists'));
    }

    public function datatable_admin_index()
    {
        $tickets = Ticket::select(
                        'tickets.id as id', 
                        'tickets.status as status', 
                        'tickets.subject as subject', 
                        'tickets.created_at as created_at', 
                        'tickets.updated_at as updated_at', 
                        'tickets.assigned_to as assigned_to'
                    );

        return Datatables::of($tickets)
            ->addColumn('is_assign', function($row){
                if($row->assigned_to==""){
                    return '<span id="specialist_'.$row->id.'"><span class="label bg-red">Not Assigned</span></span>';
                }else{
                    return '<span id="specialist_'.$row->id.'"><span class="label bg-green">Assigned</span></span>';
                }
            })
            ->addColumn('status', function($row){
                if($row->status=="close"){
                    return '<span id="status_'.$row->id.'"><span class="label bg-red">CLOSE</span></span>';
                }elseif($row->status=="pending"){
                    return '<span id="status_'.$row->id.'"><span class="label bg-orange">PENDING</span></span>';
                }elseif($row->status=="open"){
                    return '<span id="status_'.$row->id.'"><span class="label bg-green">OPEN</span></span>';
                }
            })
            ->addColumn('action', function($row){
                return 
                '<button type="button" class="btn bg-blue-grey waves-effect addign-specialist" data-toggle=" model" title="Change Assigned Specialist" data-target="#change-specialist-model" id="'.$row->id.'">
                    <i class="material-icons">merge_type</i>
                </button>
                <button type="button" class="btn bg-lime waves-effect change-status" id="'.$row->id.'">
                    <i class="material-icons">vpn_key</i>
                </button>
                <a href="/ticketDetail/'.$row->id.'"> 
                    <button type="button" class="btn bg-teal waves-effect" data-toggle="tooltip" title="Reply">
                        <i class="material-icons">forum</i>
                    </button> 
                </a>';
            })
            ->rawColumns(['is_assign', 'status', 'action'])
            ->make(true);
    }


    public function datatable_specialist_index()
    {
        $tickets = Ticket::select(
                        'tickets.id as id', 
                        'tickets.status as status', 
                        'tickets.subject as subject', 
                        'tickets.created_at as created_at', 
                        'tickets.updated_at as updated_at', 
                        'tickets.assigned_to as assigned_to'
                    )->where('assigned_to', Auth::id());

        return Datatables::of($tickets)
            ->addColumn('status', function($row){
                if($row->status=="close"){
                    return '<span id="status_'.$row->id.'"><span class="label bg-red">CLOSE</span></span>';
                }elseif($row->status=="pending"){
                    return '<span id="status_'.$row->id.'"><span class="label bg-orange">PENDING</span></span>';
                }elseif($row->status=="open"){
                    return '<span id="status_'.$row->id.'"><span class="label bg-green">OPEN</span></span>';
                }
            })
            ->addColumn('action', function($row){
                return '
                <button type="button" class="btn bg-lime waves-effect change-status" id="'.$row->id.'">
                    <i class="material-icons">vpn_key</i>
                </button>
                <a href="/ticketDetail/'.$row->id.'"> 
                    <button type="button" class="btn bg-teal waves-effect" data-toggle="tooltip" title="Reply">
                        <i class="material-icons">forum</i>
                    </button> 
                </a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }



    public function datatable_client_index()
    {
        $tickets = Ticket::select(
                        'tickets.id as id', 
                        'tickets.status as status', 
                        'tickets.subject as subject', 
                        'tickets.created_at as created_at', 
                        'tickets.updated_at as updated_at'
                    );
        return Datatables::of($tickets)
            ->addColumn('status', function($row){
                if($row->status=="close"){
                    return '<span id="status_'.$row->id.'"><span class="label bg-red">CLOSE</span></span>';
                }elseif($row->status=="pending"){
                    return '<span id="status_'.$row->id.'"><span class="label bg-orange">PENDING</span></span>';
                }elseif($row->status=="open"){
                    return '<span id="status_'.$row->id.'"><span class="label bg-green">OPEN</span></span>';
                }
            })
            ->addColumn('action', function($row){
                return 
                '<a href="/ticketDetail/'.$row->id.'"> 
                    <button type="button" class="btn bg-teal waves-effect" data-toggle="tooltip" title="Reply">
                        <i class="material-icons">forum</i>
                    </button> 
                </a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }





    public function specialist_index()
    {
        // show all tickets in table
        /*$tickets = Ticket::where('assigned_to', Auth::id())->orderBy('id','desc')->paginate(20);
        return view('ticket.specialistIndex',compact('tickets'));*/
        return view('ticket.specialistIndex');
    }


    public function addDetail ($ticket_id, Request $request)
    {

        // upload audio file and get the link
        if (($request->hasFile('file')) ) {
            $file = Storage::disk('public')->put('', $request->file('file'));
            // $audio_file_url = Storage::url($url);
        }else{
            $file="";
        }
        $ticket_detail = new TicketDetail;
        $ticket_detail->ticket_id = $ticket_id;
        $ticket_detail->user_id = Auth::id();
        $ticket_detail->file = $file;
        $ticket_detail->content = $request->content;
        $ticket_detail->save();

        Session::flash('success','Detail has been submitted successfully.');

        return back();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request,array(
            'subject' => 'required'
        ));

        $user_id = Auth::id();

        // upload audio file and get the link
        if (($request->hasFile('file')) ) {
            $file = Storage::disk('public')->put('', $request->file('file'));
            // $audio_file_url = Storage::url($url);
        }else{
            $file="";
        }

        // store in database
        $ticket = new Ticket;
        $ticket->user_id = $user_id;
        $ticket->subject = $request->subject;
        $ticket->save();
        $ticket_id = $ticket->id;


        $ticket_detail = new TicketDetail;
        $ticket_detail->ticket_id = $ticket_id;
        $ticket_detail->user_id = $user_id;
        $ticket_detail->file = $file;
        $ticket_detail->content = $request->content;
        $ticket_detail->save();

        Session::flash('success','Ticket has been submitted successfully.');


        // redirect someone to another page
        return redirect('/tickets/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }    

    /**
    * ajax assignSpecialist
    */
    public function assignSpecialist(Request $request)
    {
        $specialist_id = $request->input('specialist_id');
        $ticket_id = $request->input('ticket_id');

        $ticket = Ticket::where('id', $ticket_id)->first();
        $ticket->assigned_to = $specialist_id;
        $ticket->save();

        return response()->json(array('msg'=> 'Success'), 200);
    }

    /**
    * ajax statusChange
    */
    public function statusChange(Request $request)
    {
        $status = $request->input('status');
        $ticket_id = $request->input('ticket_id');

        $ticket = Ticket::where('id', $ticket_id)->first();
        $ticket->status = $status;
        $ticket->save();

        return response()->json(array('msg'=> 'Success'), 200);
    }
}

@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>TASK INFOS</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos" id="users-table">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Is Assigned</th>
                                            <th>Submission Date</th>
                                            <th>Last Update</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>                         
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                <!-- Modal -->
				<div id="change-specialist-model" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Assign Specialist</h4>
				      </div>
				      <div class="modal-body">
				      	
				      		<div class="row">
				      			<div class="col-md-12">
				      				<div class="form-group">
				      				<label for="specialist_id">Select list:</label>
						      		<select class="form-control" id="specialist_id">
						      			@foreach($specialists as $specialist)
						      				<option value="{{$specialist->id}}">{{$specialist->email}}</option>
						      			@endforeach
						      		</select>
						      		</div>	
						      		<br>
						      		<button type="button" id="assign-submit" class="btn bg-cyan btn-block btn-lg waves-effect">Submit</button>			      				
				      			</div>
				      		</div>		
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>

				<div id="change-status-model" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Change Status</h4>
				      </div>
				      <div class="modal-body">
				      	
				      		<div class="row">
				      			<div class="col-md-12">
				      				<div class="form-group">
				      				<label for="status">Select Status:</label>
						      		<select class="form-control" id="status">
					      				<option value="open">Open</option>
					      				<option value="close">Close</option>
					      				<option value="pending">Pending</option>
						      		</select>
						      		</div>	
						      		<br>
						      		<button type="button" id="status-submit" class="btn bg-cyan btn-block btn-lg waves-effect">Submit</button>			      				
				      			</div>
				      		</div>		
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>


            </div>
        </div>
    </section>




@endsection



@section('footer-script')
<script type="text/javascript">
	$(function(){
		$('#change-specialist-model').modal({
		   show:false,
		   backdrop:'static'
		});
		$('#change-status-model').modal({
		   show:false,
		   backdrop:'static'
		});

		 //now on button click
		var ticket_id = "";
		$(document).on('click', '.addign-specialist', function(){
			ticket_id = $(this).attr('id');
			$('#change-specialist-model').modal('show');
		});

		$(document).on('click', '.change-status', function(){
			ticket_id = $(this).attr('id');
			$('#change-status-model').modal('show');
		});


		$(document).on('click', '#status-submit', function(){
			var status = $('#status option:selected').val();
			var html='';
			$.ajax({
				 type:'POST',
				 url:'/admin/statusChange',
				 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				 data:{
				 	'status' : status,
				 	'ticket_id' : ticket_id
				 },
				 success:function(data){
				 	if(data.msg=="Success"){
				 		
						if(status=="close"){
						    html = '<span class="label bg-red">CLOSE</span>';
						}else if(status=="pending"){
						    html = '<span class="label bg-orange">PENDING</span>';
						}else if(status=="open"){
						    html = '<span class="label bg-green">OPEN</span>';
						}
						$('#change-status-model').modal('hide');
						$('#status_'+ticket_id).html(html);
				 	}
				 }
			});
		});

		$(document).on('click', '#assign-submit', function(){
		// $().click(function(){
			var specialist_id = $('#specialist_id option:selected').val();
			$.ajax({
				 type:'POST',
				 url:'/admin/assignSpecialist',
				 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				 data:{
				 	'specialist_id' : specialist_id,
				 	'ticket_id' : ticket_id
				 },
				 success:function(data){
				 	if(data.msg=="Success"){
				 		$('#change-specialist-model').modal('hide');
				 		$('#specialist_'+ticket_id).html('<span class="label bg-green">Assigned</span>');
				 	}
				 }
			});
		});


	    $('#users-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{ url("/admin/datatable/tickets/index") }}',
	        columns: [
	            {data: 'subject', name: 'tickets.subject'},
	            {data: 'status', name: 'tickets.status'},
	            {data: 'is_assign'},
	            {data: 'created_at', name: 'tickets.created_at'},
	            {data: 'updated_at', name: 'tickets.updated_at'},
	            {data: 'action'}
	        ]
	    });
		  
	});	
</script>
	
@endsection
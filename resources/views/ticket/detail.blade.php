@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Ticket</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Ticket Detail
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                     @if(Session::has('success'))
                                        <div class="alert alert-success">
                                            <strong>Success!</strong> {{ Session::get('success') }}
                                        </div>
                                    @endif

                                    @if(Session::has('error'))
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> {{ Session::get('error') }}
                                    </div>
                                    @endif   

                                    @if(count($errors)>0)
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> 
                                        @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </div>
                                    @endif


                                </div>
                            </div>
                        	<div class="row">
                        		<div class="col-xs-12">
                        		@foreach($ticket_details as $ticket_detail)
                        			@if($ticket->user_id == $ticket_detail->user_id)
									<blockquote>
                                        <p>{{$ticket_detail->content}}</p>
                                        @if($ticket_detail->file != "")
                                        <p><a href="{!! Storage::path($ticket_detail->file) !!}" download="w3logo">Download</a></p>
                                        @endif
		                                <footer>By Client</footer>
		                            </blockquote>
		                            @else
		                            <blockquote class="blockquote-reverse">
                                        <p>{{$ticket_detail->content}}</p>
                                        @if($ticket_detail->file != "")
                                        <p><a href="{!! Storage::path($ticket_detail->file) !!}" download="w3logo">Download</a></p>
                                        @endif
		                                <footer>By Admin</footer>
		                            </blockquote>
		                            @endif
                        		
                        		@endforeach
                        		</div>
                        	</div>


                            {!! Form::open(["url"=>"/addDetail/".$ticket_id, "files" => true]) !!}

                                    {{ Form::label('content', 'Detail:', array('class' => 'form-margin')) }}
                                    {{ Form::textarea('content', '', array("class" => "form-control ", "required" => "required")) }}

                                    {{ Form::label('file', 'Upload a mp3 file:', array("class" => "form-margin") ) }}
                                    {{ Form::file('file', array("class" => "form-control" )) }}

                                    {{ Form::submit('Add Ticket', array('class' => 'btn btn-lg btn-block btn-success form-margin')) }}

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection

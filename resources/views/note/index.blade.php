@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Note</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Note
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
                                @foreach($notes as $note)
                                    @if($note->user_id == $task->user_id)
                                    <blockquote>
                                        <p>{{$note->note}}</p>
                                        <footer>By Task Creator</footer>
                                    </blockquote>
                                    @else
                                    <blockquote class="blockquote-reverse">
                                        <p>{{$note->note}}</p>
                                        {{-- <footer></footer> --}}
                                    </blockquote>
                                    @endif
                                
                                @endforeach
                                </div>
                            </div>


                            {!! Form::open(["url"=>"/note/"]) !!}

                                    {{ Form::label('note', 'Add Note:', array('class' => 'form-margin')) }}
                                    {{ Form::textarea('note', '', array("class" => "form-control ", "required" => "required")) }}

                                    {{ Form::hidden('task_id', $task_id ) }}

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

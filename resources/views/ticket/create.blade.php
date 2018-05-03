@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Add Ticket</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                New Ticket
                            </h2>
                        </div>
                        <div class="body">
                            {!! Form::open(["route"=>"tickets.store", "files" => true]) !!}

                                    {{ Form::label('subject', 'Subject:') }}
                                    {{ Form::text('subject', '', array("class" => "form-control", "required" => "required", "maxlength" => "191")) }}

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

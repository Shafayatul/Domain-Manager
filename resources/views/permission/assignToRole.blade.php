@extends('layouts.app')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Assign Permission To Role</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Assign Permission To Role
                            </h2>
                        </div>
                        <div class="body">
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            {!! Form::open(["route"=>"permission.assign_store"]) !!}
								@foreach ($permissions as $permission)
							        {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $permission_ids) ? true : false, ['class' => 'filled-in chk-col-deep-orange', 'id' => $permission->id]) }}
							        {{Form::label($permission->id, ucfirst($permission->name)) }}<br>
							    @endforeach
							    {{ Form::hidden('role_id', $role->id) }}
							    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Submit', ['class' => 'btn btn-primary form-margin']) !!}
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>
@endsection
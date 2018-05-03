
@role('Admin')
{!! Form::label('assign_to', 'Assign To', ['class' => 'form-margin']) !!}
{!! Form::select('assign_to', $specialist_array, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
@else

{!! Form::hidden('assign_to', 0, null) !!}

@endrole

{!! Form::label('due_date', 'Due Date', ['class' => 'form-margin']) !!}
{!! Form::text('due_date', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control', 'id' => 'calendar1']) !!}


{!! Form::label('domain_name', 'Domain Name', ['class' => 'form-margin']) !!}
{!! Form::text('domain_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}


{!! Form::label('task_type', 'Task Type', ['class' => 'form-margin']) !!}
{!! Form::select('task_type', ['register' => 'Register', 'renew' => 'Renew', 'transfer' => 'Transfer', 'modify' => 'Modify'], null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}


{!! Form::label('status', 'Status', ['class' => 'form-margin']) !!}
{!! Form::select('status', ['open' => 'Open', 'in_progress' => 'In Progress', 'complete' => 'Complete'], null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}


{!! Form::label('description', 'Description', ['class' => 'form-margin']) !!}
{!! Form::textarea('description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary form-margin']) !!}


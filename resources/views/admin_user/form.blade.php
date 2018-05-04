
{!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}

{!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
{!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}

{!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
{!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}

{!! Form::label('role', 'Role', ['class' => 'control-label']) !!}
{{ Form::select('role', $roles, null, ['class' => 'form-control', 'required' => 'required']) }}

{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary  form-margin']) !!}

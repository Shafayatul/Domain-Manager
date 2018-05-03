
{!! Form::label('note', 'Note', ['class' => 'col-md-4 control-label']) !!}
{!! Form::textarea('note', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
       
{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary form-margin']) !!}

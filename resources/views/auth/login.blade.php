@extends('master')
@section('name', 'Login')

@section('content')
	<div class="container col-md-6 col-md-offset-3">
		<div class="well well bs-component">
			{!! Form::open(array('class' => 'form-horizontal')) !!}
				@foreach ($errors->all() as $error)
					<p class="alert alert-danger">{{ $error }}</p>
				@endforeach
				{!! csrf_field() !!}
				<fieldset>
					<div class="form-group">
						{!! Form::label('email', 'Email', $attributes = array('class'=>'col-lg-2 control-label')) !!}
                        <div class="col-lg-10">
                            {!! Form::text('email', old('email'), $attributes = array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email')) !!}
                        </div>
					</div>
					<div class="form-group">
						{!! Form::label('password', 'Password', $attributes = array('class'=>'col-lg-2 control-label')) !!}
                        <div class="col-lg-10">
                            {!! Form::password('password', $attributes = array('class' => 'form-control', 'id' => 'password')) !!}
                        </div>
					</div>
					<div class="checkbox">
						<label>
							{!! Form::checkbox('remember', '1', '') !!} Remember Me?
						</label>
					</div>
					<div class="form-group">
						<div class="col-lg-10 col-lg-offset-2">
                            {!! Form::button('Login', $attributes = array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
						</div>
					</div>
				</fieldset>
			{!! Form::close() !!}
		</div>
	</div>
@endsection
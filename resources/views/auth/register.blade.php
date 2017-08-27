@extends('master')
@section('name', 'Register')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">
            {!! Form::open(array('class' => 'form-horizontal')) !!}

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach


                <fieldset>
                    <legend>Register an account</legend>
                    <div class="form-group">
                        {!! Form::label('name', 'Name', $attributes = array('class'=>'col-lg-2 control-label')) !!}
                        <div class="col-lg-10">
                            {!! Form::text('name', old('name'), $attributes = array('class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name')) !!}
                        </div>
                    </div>

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

                    <div class="form-group">
                        {!! Form::label('password', 'Confirm Password', $attributes = array('class'=>'col-lg-2 control-label')) !!}
                        <div class="col-lg-10">
                            {!! Form::password('password_confirmation', $attributes = array('class' => 'form-control', 'id' => 'password_confirmation')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            {!! Form::button('Cancel', $attributes = array('type' => 'reset', 'class' => 'btn btn-default')) !!}
                            {!! Form::button('Submit', $attributes = array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
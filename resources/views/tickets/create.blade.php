@extends('master')
@section('title', 'Contact')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
            {!! Form::open(array ('class' => 'form-horizontal')) !!}
            
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                
                <fieldset>
                    <legend>Submit a new ticket</legend>
                    <div class="form-group">
                        {!! Form::label('title', 'Title', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-10">
                            {!! Form::text('title', '', $attributes = array ('class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('content', 'Content',  array('class' => 'col-lg-2 control-label')) !!}
                        <div class="col-lg-10">
                            {!! Form::textarea('content', '', $attributes = array ('class' => 'form-control', 'id' => 'content', 'rows' => '3')) !!}
                            <span class="help-block">Feel free to ask us any question.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            {!! Form::button('Cancel', $attributes = array('class' => 'btn btn-default')) !!}
                            {!! Form::button('Submit', $attributes = array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                </fieldset>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@extends('master')
@section('title', 'Edit a ticket')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
            {!! Form::open(array('class' => 'form-horizontal')) !!}

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <fieldset>
                    <legend>Edit ticket</legend>
                    <div class="form-group">
                        {!! Form::label('title', 'Title', array('class' => 'col-lg-2 control-label')) !!}
                        <div class="col-lg-10">
                            {!! Form::text('title', $ticket->title, $attributes = array ('class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Content</label>
                        <div class="col-lg-10">
                            {!! Form::textarea('content', $ticket->content, $attributes = array ('class' => 'form-control', 'id' => 'content', 'rows' => '3')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            {!! Form::checkbox('status', '1', '', $attributes = array ($ticket->status?"":"checked")) !!}
                            Close this ticket?
                        </label>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            {!! Form::button('Cancel', $attributes = array('class' => 'btn btn-default')) !!}
                            {!! Form::button('Update', $attributes = array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                </fieldset>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
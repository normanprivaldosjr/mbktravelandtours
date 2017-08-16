@extends('master')
@section('title', 'View a ticket')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
            <div class="well well bs-component">
                <div class="content">
                    <h2 class="header">{!! $ticket->title !!}</h2>
                    <p> <strong>Status</strong>: {!! $ticket->status ? 'Pending' : 'Answered' !!}</p>
                    <p> {!! $ticket->content !!} </p>
                </div>
                <a href="{!! action('TicketsController@edit', $ticket->slug) !!}" class="btn btn-info pull-left">Edit</a>
                {!! Form::open(array ('class'=>'pull-left', 'url' => action('TicketsController@destroy', $ticket->slug))) !!}
                    <div>
                        {!! Form::button('Delete', $attributes = array('class'=>'btn btn-warning', 'type'=>'submit')) !!}
                    </div>
                {!! Form::close() !!}

                <div class="clearfix"></div>
            </div>
    </div>

@endsection
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

            @foreach($comments as $comment)
                <div class="well well bs-component">
                    <div class="content">
                        {!! $comment->content !!}
                    </div>
                </div>
            @endforeach

            <div class="well well bs-component">
                {!! Form::open(array ('class'=>'form-horizontal', 'url' => url('/').'/comment')) !!}
                    <input type="hidden" name="post_type" value="App\Ticket">
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::hidden('post_id', $ticket->id) !!}

                    <fieldset>
                        <legend>Reply</legend>
                        <div class="form-group">
                            <div class="col-lg-12">
                                {!! Form::textarea('content', '', $attributes = array('class' => 'form-control', 'rows' => '3', 'id' => 'content')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                {!! Form::button('Cancel', $attributes = array('class'=>'btn btn-default', 'type'=>'reset')) !!}
                                {!! Form::button('Post', $attributes = array('class'=>'btn btn-primary', 'type'=>'submit')) !!}
                            </div>
                        </div>
                    </fieldset>
                {!! Form::close() !!}
            </div>
    </div>

@endsection
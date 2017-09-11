@extends('master')

@section('meta-description', 'Testimonials of MBK, A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines')
@section('meta-keywords', 'testimonials, testimonial, travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita')


@section('modified-style')
    <style type="text/css">
        #header{
            position: relative;
            float: left;
            width: 100%;
            height: 75vh;
            background: url('{!! url('/') !!}/assets/images/testimonials_header.jpg') bottom no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        #header h2{
            position: absolute;
            width: calc(100% - 140px);
            bottom: 50px;
            left: 70px;
            font-size: 45px;
        }

        #header .btn{
            margin: 3px 0px 0px 0px;
        }

        #content{
            position: relative;
            float: left;
            width: 100%;
            padding: 50px 70px;
        }

        ol li{
            padding: 15px 0px;
        }

        .footer{
            position: relative;
            float: left;
            width: 100%;
        }

        @media (max-width: 768px) and (min-width: 426px){
            #header h2{
                left: 20px;
                width: calc(100% - 40px);
            }

            #content{
                padding: 50px 15px;
            }
        }

        @media (max-width: 425px){
            #header h2{
                left: 20px;
                width: calc(100% - 40px);
            }

            #header h2 .btn{
                display: none;
            }

            #content{
                padding: 50px 15px;
            }
        }
    </style>
@endsection

@section('title')
    MBK - Testimonials
@endsection

@section('content')
    <!-- Header -->
    <div id="header">
        <div class="fill">
            <h2 class="text-white">Testimonials</h2>
        </div>
    </div>
    <!-- Header -->



    <!-- Content -->
    <div id="content">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                @if ($testimonials->isEmpty())
                    <h4 class="text-blue">There is no testimonial yet, be the first to give a testimonial!</h4>
                @else
                    @foreach ($testimonials as $testimonial)
                        <blockquote>
                            <p>
                                <i>"{!! $testimonial->message !!}"</i>
                            </p>
                            <br>
                            <p class="pull-right"><i>~ {!! ucwords($testimonial->full_name) !!}</i></p>
                        </blockquote>
                    @endforeach
                @endif
            </div>

            <div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-sm-12 col-xs-12">
                {!! Form::open(['id' => 'flight-form', 'data-toggle' => 'validator', 'role' => 'form']) !!}
                    <h4 class="text-blue">Submit a Testimonial</h4>
                    <hr>
                    <div class="form-group">
                        {!! Form::label('message', 'MESSAGE', ['class' => 'form-label']) !!}
                        {!! Form::textarea('message', '', ['class' => 'form-control', 'id' => 'message', 'placeholder' => 'Enter your message here...', 'rows' => '7', 'style' => 'resize: none; padding-top: 10px', 'required' => 'required']) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <?php
                            $full_name = "";
                            if (Auth::check()) {
                                $full_name = Auth::user()->first_name." ".Auth::user()->last_name;
                            }
                            else {
                                $full_name = "";
                            }
                        ?>
                        {!! Form::label('full_name', 'FULL NAME', ['class' => 'form-label']) !!}
                        {!! Form::text('full_name', $full_name, ['class' => 'form-control', 'id' => 'full_name', 'placeholder' => 'Enter full name', 'style' => 'height: 50px', 'required' => 'required']) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        {!! Form::button('Submit', $attributes = array('type' => 'submit', 'class' => 'btn btn-primary text-white text-uppercase')) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- Content -->


@endsection
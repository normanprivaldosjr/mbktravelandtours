@extends('master')

@section('meta-description', 'Cheap Tour Packages of MBK, Madya Byahe kita. A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines')
@section('meta-keywords', 'cheap, less, than, 10000, package, packages, travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita')

@section('modified-style')
    <style type="text/css">
        #header{
            position: relative;
            float: left;
            width: 100%;
            height: auto;
            background: url('{!! url('/') !!}/assets/images/promo_background.jpg') center no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        #promo-container{
            position: relative;
            width: 100%;
            padding: 0px 15%;
            margin: 170px 0px;
        }

        #promo-container h2{
            font-size: 50px;
            margin: 0px 0px 20px 0px;
        }

        #promo-container p{
            font-size: 14px;
            margin: 0px 0px 10px 0px;
        }

        #content{
            position: relative;
            float: left;
            width: 100%;
        }

        #grid-container{
            padding: 0px 110px;
        }

        .btn{
            letter-spacing: 0px;
            padding: 10px 15px;
            margin: 0px;
        }

        .form-control{
            height: 50px;
        }

        .checkbox-inline{
            padding: 10px 20px;
        }

        .range-slider {
            margin: 20px 0 0 0%;
        }

        .range-slider {
            width: 100%;
        }

        .range-slider__range {
            -webkit-appearance: none;
            float: left;
            width: calc(100% - 80px) !important;
            height: 10px;
            border-radius: 5px;
            background: #d7dcdf;
            outline: none;
            padding: 0;
            margin: 9px 0px 0px 0px;
        }

        .range-slider__range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #2c3e50;
            cursor: pointer;
            -webkit-transition: background .15s ease-in-out;
            transition: background .15s ease-in-out;
        }

        .range-slider__range::-webkit-slider-thumb:hover {
            background: #2196F3;
        }

        .range-slider__range:active::-webkit-slider-thumb {
            background: #2196F3;
        }

        .range-slider__range::-moz-range-thumb {
            width: 20px;
            height: 20px;
            border: 0;
            border-radius: 50%;
            background: #2c3e50;
            cursor: pointer;
            -webkit-transition: background .15s ease-in-out;
            transition: background .15s ease-in-out;
        }

        .range-slider__range::-moz-range-thumb:hover {
            background: #2196F3;
        }

        .range-slider__range:active::-moz-range-thumb {
            background: #2196F3;
        }

        .range-slider__value {
            display: inline-block;
            position: relative;
            width: 60px;
            color: #fff;
            line-height: 20px;
            text-align: center;
            border-radius: 3px;
            background: #2196F3;
            padding: 5px 10px;
            margin-left: 20px;
        }

        .range-slider__value:after {
            position: absolute;
            top: 8px;
            left: -7px;
            width: 0;
            height: 0;
            border-top: 7px solid transparent;
            border-right: 7px solid #2196F3;
            border-bottom: 7px solid transparent;
            content: '';
        }

        ::-moz-range-track {
            background: #d7dcdf;
            border: 0;
        }

        input::-moz-focus-inner,
        input::-moz-focus-outer {
            border: 0;
        }

        .ad_image{
            content: url('{!! url('/') !!}/assets/images/ads/ad_landscape.jpg');
        }

        @media (max-width: 768px) and (min-width: 426px){
            #grid-container{
                padding: 0px 15px;
            }
        }

        @media (max-width: 425px){
            #grid-container{
                padding: 0px 15px;
            }
            .ad_image{
                content: url('{!! url('/') !!}/assets/images/ads/ad_landscape_two.jpg');
            }
        }

    </style>
@endsection

@section('title', 'MBK - Cheap Tour Packages')
@section('content')

    <!-- Header -->
    <div id="header">
        <div class="fill">
            <div id="promo-container" class="text-white text-center">
                <h2>Custom Tour Packages?</h2>
                <p>
                    Want to customize your own tour package? Click the button below
                    <br><br><br>
                    <a href="{!! url('/') !!}/tour-packages/custom" class="btn btn-primary text-uppercase">Customize Tour</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Header -->

    <div id="">
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1 col-md-5 col-sm-6 col-xs-6 col-md-offset-1 box">
                <h4 class="title text-blue text-uppercase">Cheap Tour Packages Offered</h4>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 box text-right">
                <button class="btn btn-default text-uppercase" style="margin: 0px 5px" data-toggle="modal" data-target="#sort-modal">Sort</button>
            </div>
        </div>
        <div class="row" id="grid-container">
            @if (count($tour_packages) == 0)
                <div class="row text-center">
                    <p>Sorry, there was no result found, try refining your filter or search.</p>
                </div>
            @else
                @foreach ($tour_packages as $tour_package)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="package-container">
                            <img src="{!! url('/') !!}/assets/images/{!! $tour_package->package_image !!}">
                            <div class="location-container"><h3>{!! $tour_package->name !!}</h3></div>
                            <div class="primary-tour-details">
                                {!! $tour_package->package_description !!}
                                <br><br>
                                Duration: <b>{!! $tour_package->no_of_days !!} days &amp; {!! $tour_package->no_of_nights !!} nights</b><br>
                                Price starts at: <b class="text-blue">₱ {!! number_format($tour_package->price_starts, 2, '.', ',') !!}</b><br><br>
                                <a href="{!! url('/') !!}/tour-packages/{!! $tour_package->slug !!}" class="btn btn-primary">Add To Cart</a>
                                <a href="{!! url('/') !!}/tour-packages/{!! $tour_package->slug !!}" class="btn btn-default text-blue">Read More</a>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </div>

    @include('shared.ad_space')


    <div class="modal fade" tabindex="-1" role="dialog" id="sort-modal" style="margin-top: 10%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open(['action' => 'TourPackageController@cheap_packages', 'method' => 'get']) !!}


                <div class="modal-header bg-blue">
                    <h4 class="modal-title text-white">Sort Tour Packages</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Form::select('sort_type[]', [
                                    'name' => 'Name', 
                                    'created_at' => 'Date Created',
                                    'price_starts' => 'Price'
                                ], 'price', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Form::select('sort_procedure[]', [
                                    'asc' => 'Asceding', 
                                    'desc' => 'Descending'
                                ], 'asc', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::button('Cancel', ['class' => 'btn btn-sm btn-default', 'data-dismiss' => 'modal', 'style' => 'margin: 0px;']) !!}
                    {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary', 'style' => 'margin: 0px;']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('modified-script')
@endsection
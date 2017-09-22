@extends('master')

@section('meta-description', 'Tour Packages of MBK, Madya Byahe kita. A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines')
@section('meta-keywords', 'package, packages, travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita')

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

@section('title', 'MBK - Tours Agency')
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
                <h4 class="title text-blue text-uppercase">Tour Packages Offered</h4>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 box text-right">
                <button class="btn btn-default text-uppercase" style="margin: 0px 5px" data-toggle="modal" data-target="#sort-modal">Sort</button>
                <button class="btn btn-default text-uppercase" style="margin: 0px 5px" data-toggle="modal" data-target="#filter-modal">Filter</button>
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
                            <img src="{!! $tour_package->package_image !!}">
                            <div class="location-container"><h3>{!! $tour_package->name !!}</h3></div>
                            <div class="primary-tour-details">
                                @if(strlen($tour_package->package_description) > 200)
                                    {!! substr($tour_package->package_description, 0, 200)."..." !!}
                                @else
                                    {!! $tour_package->package_description !!}
                                @endif
                                <br><br>
                                Duration: <b>{!! $tour_package->no_of_days !!} days &amp; {!! $tour_package->no_of_nights !!} nights</b><br>
                                Price starts at: <b class="text-blue">₱ {!! number_format($tour_package->price_starts, 2, '.', ',') !!}</b><br><br>
                                
                                <a href="{!! url('/') !!}/tour-packages/{!! $tour_package->slug !!}" class="btn btn-primary text-white">Read More</a>
                                
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
                {!! Form::open(['action' => 'TourPackageController@index', 'method' => 'get']) !!}


                @foreach ($_GET as $key => $value)
                    @if ($key == 'travel_date' || $key == 'keyword' || $key == 'duration' || $key == 'guest' || $key == 'sort_type' || $key == 'sort_procedure')
                        @continue
                    @endif
                    @foreach ($value as $i => $v)
                        <input type="hidden" name="{!! $key !!}[]" value="{!! $v !!}">
                    @endforeach
                @endforeach


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
                                ], 'name', ['class' => 'form-control']) !!}
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

    <div class="modal fade" tabindex="-1" role="dialog" id="filter-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-blue">
                    <h4 class="modal-title text-white">Filter Tour Packages</h4>
                </div>
                {!! Form::open(['action' => 'TourPackageController@index', 'method' => 'get']) !!}


                @foreach ($_GET as $key => $value)
                    @if ($key == 'travel_date' || $key == 'keyword' || $key == 'duration' || $key == 'guest' || $key == 'destination' || $key == 'no_of_days' || $key == 'no_of_nights' || $key == 'price')
                        @continue
                    @endif
                    @foreach ($value as $i => $v)
                        <input type="hidden" name="{!! $key !!}[]" value="{!! $v !!}">
                    @endforeach
                @endforeach


                <div class="modal-body">
                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="destination_field">
                            {!! Form::label('', 'TOUR DESTINATION') !!}<br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('destination[]', '2', true, ['id' => 'destination_all']) !!} All
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('destination[]', '0', true, ['class' => 'destination']) !!} Local Destinations
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('destination[]', '1', true, ['class' => 'destination']) !!} International Destinations
                            </label>
                            
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px;">
                        <div id="days_field" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            {!! Form::label('', 'NUMBER OF DAYS') !!}<br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('no_of_days[]', '0', true, ['id' => 'days_all']) !!} All
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('no_of_days[]', '<= 3', true, ['class' => 'no_of_days']) !!} Less than 3 days
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('no_of_days[]', 'between 3 and 5', true, ['class' => 'no_of_days']) !!} 3 to 5 days
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('no_of_days[]', 'between 5 and 7', true, ['class' => 'no_of_days']) !!} 5 days to a week
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('no_of_days[]', '>= 7', true, ['class' => 'no_of_days']) !!} More than a week
                            </label>
                            <!--
                            <div class="range-slider">
                              <input name="no_of_days" class="range-slider__range" type="range" value="{!! $min_day !!}" min="{!! $min_day !!}" max="{!! $max_day !!}">
                              <span class="range-slider__value">0</span>
                            </div>-->
                        </div>
                        <div id="nights_field" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            {!! Form::label('', 'NUMBER OF NIGHTS') !!}<br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('no_of_nights[]', '0', true, ['id' => 'nights_all']) !!} All
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('no_of_nights[]', '<= 3', true, ['class' => 'no_of_nights']) !!} Less than 3 nights
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('no_of_nights[]', 'between 3 and 5', true, ['class' => 'no_of_nights']) !!} 3 to 5 nights
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('no_of_nights[]', 'between 5 and 7', true, ['class' => 'no_of_nights']) !!} 5 nights to a week
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('no_of_nights[]', '>= 7', true, ['class' => 'no_of_nights']) !!} More than a week
                            </label>
                            <!--<div class="range-slider">
                                <input name="no_of_nights" class="range-slider__range" type="range" value="{!! $min_night !!}" min="{!! $min_night !!}" max="{!! $max_night !!}">
                                <span class="range-slider__value">0</span>
                            </div>-->
                        </div>
                    </div>

                    <div id ="prices_field" class="row" style="margin-bottom: 15px">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            {!! Form::label('', 'PRICE') !!}
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            
                            <label class="checkbox-inline">
                                {!! Form::checkbox('price[]', '0', true, ['id' => 'prices_all']) !!} All
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('price[]', '<= 2000', true, ['class' => 'price']) !!} Less than ₱2,000.00
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('price[]', 'between 2000 and 5000', true, ['class' => 'price']) !!} ₱2,000.00 to ₱5,000.00
                            </label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="checkbox-inline">
                                {!! Form::checkbox('price[]', 'between 5000 and 10000', true, ['class' => 'price']) !!} ₱5,000.00 to ₱10,000.00
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('price[]', 'between 10000 and 20000', true, ['class' => 'price']) !!} ₱10,000.00 to ₱20,000.00
                            </label><br>
                            <label class="checkbox-inline">
                                {!! Form::checkbox('price[]', '>= 20000', true, ['class' => 'price']) !!} More than ₱20,000.00
                            </label>
                            <!--<div class="range-slider">
                                <input name="price" class="range-slider__range" type="range" value="{!! round($min_price) !!}" min="{!! round($min_price) !!}" max="{!! $max_price !!}">
                                <span class="range-slider__value">0</span>
                            </div>-->
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
    <script type="text/javascript">
        $('#destination_field input:checkbox').change(function() {
            if ($(this).prop('checked')) {//if this checkbox is checked
                if ($(this).attr('id') == 'destination_all') {
                    $('#destination_field .destination').prop('checked', true);
                }
                else {//if a checkbox is checked but not destination_all
                    //alert($('#destination_field .destination:checked').length + " " + $('#destination_field .destination').length);
                    if ($('#destination_field .destination:checked').length == $('#destination_field .destination').length) {

                        //if all checkboxes are checked
                        $('#destination_field #destination_all').prop('checked', true);
                    }
                    else {
                        //if not all the checkboxes are checked
                        $('#destination_field #destination_all').prop('checked', false);
                    }
                }
            }
            else {//otherwise
                if ($(this).attr('id') == 'destination_all') {
                    $('#destination_field .destination').prop('checked', false);
                }
                else {//if a checkbox is unchecked
                    $('#destination_field #destination_all').prop('checked', false);
                }

            }
        });
        $('#days_field input:checkbox').change(function() {
            if ($(this).prop('checked')) {//if this checkbox is checked
                if ($(this).attr('id') == 'days_all') {
                    $('#days_field .no_of_days').prop('checked', true);
                }
                else {//if a checkbox is checked but not days_all
                    if ($('#days_field .no_of_days:checked').length == $('#days_field .no_of_days').length) {
                        //if all checkboxes are checked
                        $('#days_field #days_all').prop('checked', true);
                    }
                    else {
                        //if not all the checkboxes are checked
                        $('#days_field #days_all').prop('checked', false);
                    }
                }
            }
            else {//otherwise
                if ($(this).attr('id') == 'days_all') {
                    $('#days_field .no_of_days').prop('checked', false);
                }
                else {//if a checkbox is unchecked
                    $('#days_field #days_all').prop('checked', false);
                }

            }
        });
        $('#nights_field input:checkbox').change(function() {
            if ($(this).prop('checked')) {//if this checkbox is checked
                if ($(this).attr('id') == 'nights_all') {
                    $('#nights_field .no_of_nights').prop('checked', true);
                }
                else {//if a checkbox is checked but not nights_all
                    if ($('#nights_field .no_of_nights:checked').length == $('#nights_field .no_of_nights').length) {
                        //if all checkboxes are checked
                        $('#nights_field #nights_all').prop('checked', true);
                    }
                    else {
                        //if not all the checkboxes are checked
                        $('#nights_field #nights_all').prop('checked', false);
                    }
                }
            }
            else {//otherwise
                if ($(this).attr('id') == 'nights_all') {
                    $('#nights_field .no_of_nights').prop('checked', false);
                }
                else {//if a checkbox is unchecked
                    $('#nights_field #nights_all').prop('checked', false);
                }

            }
        });
        $('#prices_field input:checkbox').change(function() {
            if ($(this).prop('checked')) {//if this checkbox is checked
                if ($(this).attr('id') == 'prices_all') {
                    $('#prices_field .price').prop('checked', true);
                }
                else {//if a checkbox is checked but not prices_all
                    if ($('#prices_field .price:checked').length == $('#prices_field .price').length) {
                        //if all checkboxes are checked
                        $('#prices_field #prices_all').prop('checked', true);
                    }
                    else {
                        //if not all the checkboxes are checked
                        $('#prices_field #prices_all').prop('checked', false);
                    }
                }
            }
            else {//otherwise
                if ($(this).attr('id') == 'prices_all') {
                    $('#prices_field .price').prop('checked', false);
                }
                else {//if a checkbox is unchecked
                    $('#prices_field #prices_all').prop('checked', false);
                }

            }
        });
        var rangeSlider = function(){
          var slider = $('.range-slider'),
              range = $('.range-slider__range'),
              value = $('.range-slider__value');
            
          slider.each(function(){

            value.each(function(){
              var value = $(this).prev().attr('value');
              $(this).html(value);
            });

            range.on('input', function(){
              $(this).next(value).html(this.value);
            });
          });
        };

        rangeSlider();
    </script>
@endsection
@extends('master')

@section('meta-description', 'Register to MBK, Madya Byahe kita. A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines')
@section('meta-keywords', 'sign, up, signup, register, registration, form, travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita')

@section('modified-style')
    <style type="text/css">
        #header{
            position: relative;
            float: left;
            width: 100%;
            background: url('{!! url('/') !!}/assets/images/bus_header.jpg') center no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        #header-content{
            position: relative;
            float: left;
            width: 66.66666667%;
            height: 100%;
            margin: 120px 16.66666667%;
        }

        .title{
            margin-bottom: 5px;
        }

        .media .text-blue{
            margin: 5px 0px 0px 0px;
        }

        #payment-swiper{
            width: 100%;
            height: 70px;
            margin-top: 20px;
        }

        #payment-swiper img{
            height: 100%;
        }

        #logo-swiper{
            width: 100%;
            height: 125px;
            margin-top: 30px;
        }

        #logo-swiper img{
            height: 100%;
        }

        .dropdown-flight {
            margin: 50px auto;
            max-width: 300px;
        }

        .dropdown-flight-menu {
          li {
            &+ li {
                margin-top: 10px;
            }
            a {
                padding: 5px 0 5px 55px;
                min-height: 50px;
                position: relative;
                white-space: normal;

            }
          }
          .typeahead-inner {
            .item-img {
                width: 40px;
                height: 40px;
                position: absolute;
                left: 5px;
                top: 5px;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                border-radius: 5px;
            }
            
            .item-heading {
                display: inline-block;
                vertical-align: middle;
                line-height: 18px;
            }
          }
        }

        .btn-blue{
            background: #3B5998;
            color: #FFFFFF;
            border-color: #3B5998;
            text-transform: uppercase;
            transition: all 0.2s ease-in;
        }

        .btn-blue:hover,
        .btn-blue:focus{
            background: #344E85;
            color: #FFFFFF;
        }

        .btn-red{
            background: #EA4335;
            color: #FFFFFF;
            border-color: #EA4335;
            text-transform: uppercase;
            transition: all 0.2s ease-in;
        }

        .btn-red:hover,
        .btn-red:focus{
            background: #D93F32;
            color: #FFFFFF;
        }


        /* tablet */
        @media (max-width: 768px) and (min-width: 426px){
            #header,
            #header-content{
                height: auto;
            }

            .swiper-container{
                width: 90%;
            }
        }

        /* mobile */
        @media (max-width: 425px){
            #header,
            #header-content{
                height: auto;
            }

            #header-content{
                width: 90%;
                margin: 0px 5%;
                padding-bottom: 50px;
            }

            #header-content .card{
                position: relative;
                top: 0px;
                margin-top: 25%;
            }

            .swiper-container{
                width: 95%;
            }
        }
    </style>
@endsection

@section('title', 'MBK - Register')

@section('content')
    <!-- Main content -->
    <div id="header">
        <div class="fill">
            <div id="header-content">
                <div class="card gardient-blue">
                    {!! Form::open(['id' => 'register-form', 'data-toggle' => 'validator', 'role' => 'form']) !!}
                        <h2 class="text-blue text-uppercase">Sign Up</h2>
                        <p class="text-gray">Already have an account? <a href="{!! url('/') !!}/users/login<?php
                            if (!empty($_GET['for'])) {
                                if ($_GET['for'] == 'checkout') {
                                    echo '?for=checkout';
                                    setcookie('for', 'checkout', time() + (86400 * 1), "/");
                                }
                                else {
                                    setcookie('for', 'checkout', time() - (86400 * 1), "/");
                                }
                            }
                            else {
                                setcookie('for', 'checkout', time() - (86400 * 1), "/");
                            }
                        ?>">Sign in here</a></p>
                        <hr>
                         <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('email', 'Email Address', ['class' => 'form-label']) !!}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                            {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter email address', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('phone_number', 'PHONE NUMBER', ['class' => 'form-label']) !!}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                            {!! Form::text('phone_number', '', ['class' => 'form-control number-only', 'id' => 'phone_number', 'placeholder' => 'Enter Phone No', 'required' => 'required', 'pattern' => '^([0-9+]{1,2})?\(?[0-9]{3}\)?[.-]?[0-9]{3}[.-]?[0-9]{4,5}$']) !!}
                                        </div>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>-->
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('first_name', 'First Name', ['class' => 'form-label']) !!}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                            {!! Form::text('first_name', '', ['class' => 'form-control', 'id' => 'first_name', 'placeholder' => 'Enter first name', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('last_name', 'Last Name', ['class' => 'form-label']) !!}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                            {!! Form::text('last_name', '', ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Enter last name', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                       
                        <!--<div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('gender', 'Gender', ['class' => 'form-label']) !!}
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 div-form-radio">
                                            <label class="checkbox-inline label-form-radio">
                                                {!! Form::radio('gender', '1', true); !!} Male
                                            </label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 div-form-radio">
                                            <label class="checkbox-inline label-form-radio">
                                                {!! Form::radio('gender', '0'); !!} Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        {!! Form::label('birthday', 'BIRTHDAY', ['class' => 'form-label']) !!}
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                {!! Form::text('birthday', old('birthday', date('Y-m-d')), ['class' => 'form-control', 'id' => 'birthdate', 'placeholder' => 'MM/DD/YYYY', 'required' => 'required', 'onkeydown' => 'return false']) !!}
                                            </div>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!--<div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('province', 'Province', ['class' => 'form-label']) !!}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                            {!! Form::text('province', '', ['class' => 'form-control', 'id' => 'province', 'placeholder' => 'Enter province', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('city', 'City', ['class' => 'form-label']) !!}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                            {!! Form::text('city', '', ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Enter city', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                            {!! Form::password('password', ['placeholder' => '********', 'data-minlength' => '8', 'class' => 'form-control', 'id' => 'password', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'form-label']) !!}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                            {!! Form::password('password_confirmation', ['placeholder' => '********', 'class' => 'form-control', 'id' => 'password_confirmation', 'data-match' => '#password', 'data-match-error' => 'Passwords don\'t match.', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                                <div class="form-group pull-right" style="margin:0px">
                                    <!--{!! Form::button('Reset', ['type' => 'reset', 'class' => 'btn btn-basic']) !!}-->
                                    {!! Form::button('Register', ['type' => 'submit', 'class' => 'btn btn-primary', 'style' => 'margin:0px']) !!}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <div class="row">
                        <div class="row" style="margin:0px">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="form-label">Or Sign up via</label>
                            </div>
                        </div>
                        {{--<div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <button class="btn btn-blue btn-block" style="margin-top:0px; margin-bottom:3px" id="facebook-btn"><i class="fa fa-facebook"></i> Facebook</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <button class="btn btn-red btn-block" style="margin-top:0px; margin-bottom:3px"><i class="fa fa-google"></i> Google</button>
                            </div>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('modified-script')
@endsection
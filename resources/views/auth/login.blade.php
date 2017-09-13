@extends('sign_master')

@section('meta-description', 'Sign in to MBK, Madya Byahe kita. A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines')
@section('meta-keywords', 'sign, in, login, signin,  travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita')

@section('modified-style')
    <style type="text/css">
		#content{
			position: relative;
			float: left;
			width: 100%;
			height: 100vh;
			background: url('../assets/images/header.jpg') center no-repeat;
			background-size: cover;
			background-attachment: fixed;
		}

		.div{
			position: relative;
			float: left;
			width: 50%;
			height: 100%;
			display: table;
		}

		#title-container{
			width: 100%;
			display: table-cell;
			vertical-align: middle;
			text-align: center;
		}

		.title{
			width: 100%;
			font-size: 70px;
			margin: 0px 0px 20px 0px;
			font-weight: normal;
		}

		.subtitle{
			width: 100%;
			font-size: 17px;
			letter-spacing: 5px;
		}

		.card{
			width: calc(100% - 60px);
			margin: 0px 30px;
			padding: 50px 60px;
		}

		.card h2{
			margin: 0px 0px 10px 0px;
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

		#password{
			margin-bottom: 5px;
		}

		@media (max-width: 768px) and (min-width: 426px){
			.card{
				width: calc(100% - 30px);
				height: 100%;
				margin-right: 0px;
				padding: 50px 40px;
			}

			.card h2{
				font-size: 20px;
			}

			.card p{
				font-size: 12px;
			}

			.btn{
				margin: 10px 0px;
			}
		}

		@media (max-width: 425px){
			.div{
				width: 100%;
				height: auto;
			}

			#title-container{
				display: block;
				margin: 150px 0px;
			}

			.title{
				font-size: 37px;
				font-weight: 500;
				letter-spacing: 0px;
				margin-bottom: 15px;
			}

			.subtitle{
				font-size: 11px;
				letter-spacing: 3px;
			}

			.card{
				width: calc(100% - 30px);
				margin: 0px 15px;
				padding: 40px;
				margin-bottom: 50px;
			}

			.card h2{
				font-size: 20px;
			}

			.card p{
				font-size: 11px;
			}

			.btn{
				margin: 10px 0px;
			}

			.btn-primary{
				width: 100%;
			}
		}
	</style>
@endsection

@section('title', 'MBK - Login')

@section('content')
	<div id="content">
		<div class="fill">
			<div class="div">
				<div id="title-container">
					<a href="{!! url('/') !!}"><h1 class="title manus text-white">Madya Biyahe Kita!</h1></a>
					<p class="subtitle text-white text-uppercase">Travel &amp; Tours Agency</p>
				</div>
			</div>
			<div class="div" style="display: flex; justify-content: center; align-items: center;">
				<div class="card">
					{!! Form::open(['id' => 'login-form', 'data-toggle' => 'validator', 'role' => 'form']) !!}
                        <h2 class="text-blue text-uppercase">Sign In</h2>
                        <p class="text-gray">Don't have an account yet? <a href="{!! url('/') !!}/users/register<?php
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
                        ?>">Sign up here</a></p>
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
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                            {!! Form::password('password', ['placeholder' => '********', 'class' => 'form-control', 'id' => 'password', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 remember-me">
                        		<div class="form-group pull-left" style="margin:0px">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="checkbox-inline label-form-radio">
                                                {!! Form::checkbox('remember', '1', '') !!} Remember Me?
                                            </label>
                                        </div>
                                    </div>
                        			
                        		</div>
                        	</div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 sign-in-btn">
                                <div class="pull-right">
                                    {!! Form::button('Sign in', ['type' => 'submit', 'class' => 'btn btn-primary', 'style' => 'margin:0px']) !!}
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
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <button class="btn btn-blue btn-block" style="margin-top:0px; margin-bottom:3px"><i class="fa fa-facebook"></i> Facebook</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <button class="btn btn-red btn-block" style="margin-top:0px; margin-bottom:3px"><i class="fa fa-google"></i> Google</button>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
    
@endsection

@section('modified-script')
@endsection
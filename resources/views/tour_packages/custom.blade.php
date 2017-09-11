@extends('master')

@section('meta-description', 'Customize a tour to MBK, Madya Byahe kita. A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines')
@section('meta-keywords', 'tour, custom, travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita')

@section('modified-style')

	<style type="text/css">
		#header{
			position: relative;
			float: left;
			width: 100%;
			background: url('{!! url('/') !!}/assets/images/promo_background.jpg') center no-repeat;
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

		.ad_image{
			content: url('{!! url('/') !!}/assets/images/ads/ad_landscape.jpg');
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

			.ad_image{
				content: url('{!! url('/') !!}/assets/images/ads/ad_landscape_two.jpg');
			}
		}
	</style>
@endsection

@section('title', 'MBK - Customize a tour')

@section('content')
    <!-- Main content -->
	<div id="header">
		<div class="fill">
			<div id="header-content">
				<div class="card gardient-blue">
					{!! Form::open(['id' => 'flight-form', 'data-toggle' => 'validator', 'role' => 'form']) !!}
						<div class="row">
							<div class="head">
								<h4 class="title text-blue text-uppercase"><b>Create a Custom Tour Package</b></h4>
								<small class="desc">Please fill out the form completely and we'll get right back to you through your email address</small>
							</div>
							<div class="body">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
										<div class="form-group">
											{!! Form::label('location', 'DESIRED DESTINATION', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('location', '', ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'Enter Destination', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
										<div class="form-group">
											{!! Form::label('no_of_pax', 'NO. OF PAX', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::number('no_of_pax', '1', ['class' => 'form-control number-only', 'id' => 'no_of_pax', 'min' => '1', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="form-group">
											{!! Form::label('min_budget', 'MINIMUM BUDGET (₱)', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::number('min_budget', '1000', ['class' => 'form-control number-only', 'id' => 'min_budget', 'min' => '1', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="form-group">
											{!! Form::label('max_budget', 'MAXIMUM BUDGET (₱)', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::number('max_budget', '5000', ['class' => 'form-control number-only', 'id' => 'max_budget', 'min' => '1', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
										<div class="form-group">
											{!! Form::label('no_of_days', 'NO. OF DAYS', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::number('no_of_days', '1', ['class' => 'form-control number-only', 'id' => 'no_of_days', 'min' => '1', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
										<div class="form-group">
											{!! Form::label('no_of_nights', 'NO. OF NIGHTS', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::number('no_of_nights', '1', ['class' => 'form-control number-only', 'id' => 'no_of_nights', 'min' => '1', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="footer">
								<?php
									$full_name = "";
									$birthday  = "";
									$phone_number  = "";
									$email  = "";
									if (Auth::check()) {
										//------------ OLD VARIABLES ------------//
										$old_full_name = old('full_name');
										$old_birthday = old('birthday');
										$old_phone_number = old('phone_number');
										$old_email = old('email_address');

										//FULL NAME
										if (!empty($old_full_name)) {
											$full_name = $old_full_name;
										}
										else {
											$full_name = Auth::user()->first_name." ".Auth::user()->last_name;
										}
										
										
										//BIRTHDAY
										if (!empty($old_birthday)) {
											$birthday = date("m/d/Y", strtotime($old_birthday));
										}
										else if (!empty(Auth::user()->birthday)) {
											$birthday = date("m/d/Y", strtotime(Auth::user()->birthday));
										}
										else {
											$birthday = "";
										}
										//PHONE NUMBER
										if (!empty($old_phone_number)) {
											$phone_number = $old_phone_number;
										}
										else if (!empty(Auth::user()->phone_number)) {
											$phone_number = Auth::user()->phone_number;
										}
										else {
											$phone_number = "";
										}


										//E-MAIL ADDRESS
										if (!empty($old_email)) {
											$email = $old_email;
										}
										else {
											$email = Auth::user()->email;
										}
									}
								?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('name', 'FULL NAME', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('name', $full_name, ['class' => 'form-control number-only', 'id' => 'name', 'placeholder' => 'Enter Full Name', 'required' => 'required']) !!}
												</div>
											</div>
    										<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('birthday', 'BIRTHDAY', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('birthday', $birthday, ['class' => 'form-control', 'id' => 'birthday', 'placeholder' => 'MM/DD/YYYY', 'required' => 'required', 'onkeydown' => 'return false']) !!}
												</div>
											</div>
    										<div class="help-block with-errors"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('phone_number', 'PHONE NUMBER', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('phone_number', $phone_number, ['class' => 'form-control number-only', 'id' => 'phone_number', 'placeholder' => 'Enter Phone No', 'required' => 'required', 'pattern' => '^([0-9+]{1,2})?\(?[0-9]{3}\)?[.-]?[0-9]{3}[.-]?[0-9]{4,5}$']) !!}
												</div>
											</div>
    										<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('email_address', 'EMAIL ADDRESS', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">

													{!! Form::email('email_address', $email, ['class' => 'form-control', 'id' => 'email_address', 'placeholder' => 'Enter Email Address', 'required' => 'required']) !!}
												</div>
											</div>
											
    										<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right" style="padding-top: 10px">
										{!! Form::button('RESET', $attributes = array('type' => 'reset', 'id' => 'reset_btn', 'class' => 'btn btn-default text-uppercase')) !!}
                            			{!! Form::button('Submit', $attributes = array('type' => 'submit', 'class' => 'btn btn-primary text-uppercase')) !!}
									</div>
								</div>
							</div>
						</div>
					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		@include('shared.steps', ['step_title' => 'LOCAL & INTERNATIONAL TOUR PACKAGE', 'service_name' => 'tour package'])
		@include('shared.faqs', ['service_name' => 'tour package'])
	</div>


	@include('shared.ad_space')
	
@endsection

@section('modified-script')
	<script type="text/javascript">
		$(document).ready(function() {
		  $("#location_id").select2();
		  $("#birthday").datetimepicker({
				maxDate: moment(),
				date: '{!! $birthday !!}',
				format: 'MM/DD/YYYY',
				icons: {
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right'
				}
			});
		});
	</script>
@endsection

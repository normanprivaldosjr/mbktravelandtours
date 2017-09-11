@extends('master')

@section('meta-description', 'Hotel Reservation with MBK, Madya Byahe kita. A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines')
@section('meta-keywords', 'hotel, reservation, hotels, inquiry, travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita')

@section('modified-style')

	<style type="text/css">
		#header{
			position: relative;
			float: left;
			width: 100%;
			background: url('{!! url('/') !!}/assets/images/hotel_header.jpg') center no-repeat;
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


		.info{
			margin-left: 10px;
			color: #999999;
			cursor: pointer;
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

@section('title', 'MBK - Hotel Reservation Inquiry')

@section('content')
    <!-- Main content -->
	<div id="header">
		<div class="fill">
			<div id="header-content">
				<div class="card gardient-blue">
					{!! Form::open(['id' => 'flight-form', 'data-toggle' => 'validator', 'role' => 'form']) !!}
						<div class="row">
							<div class="head">
								<h4 class="title text-blue text-uppercase"><b>Hotel Reservation Inquiry Form</b></h4>
								<small class="desc">Please fill out the form completely and we'll get right back to you through your email address</small>
							</div>
							<div class="body">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('location_name', 'LOCATION', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('location_name', '', ['class' => 'form-control', 'id' => 'location', 'required' => 'required', 'placeholder' => 'Enter country, province, or city']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="form-group">
											{!! Form::label('check_in', 'CHECK IN', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('check_in', old('check_in', date('Y-m-d')), ['class' => 'form-control', 'id' => 'hotel-check_in', 'placeholder' => 'MM/DD/YYYY', 'onkeydown' => 'return false', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="form-group">
											{!! Form::label('check_out', 'CHECK OUT', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('check_out', old('check_out', date('Y-m-d')), ['class' => 'form-control', 'id' => 'hotel-check_out', 'placeholder' => 'MM/DD/YYYY', 'onkeydown' => 'return false', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
										<div class="form-group">
											{!! Form::label('adult_no', 'ADULT', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::number('adult_no', '1', ['class' => 'form-control number-only', 'id' => 'adult_no', 'min' => '1']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
										<div class="form-group">
											{!! Form::label('child_no', 'CHILD', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::number('child_no', '0', ['class' => 'form-control number-only', 'id' => 'child_no', 'min' => '0']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="form-group">
											{!! Form::label('no_of_rooms', 'NO. OF ROOMS', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::number('no_of_rooms', '1', ['class' => 'form-control number-only', 'id' => 'no_of_rooms', 'min' => '1']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="form-group">
											<label class="form-label">FOR WORK? <i class="fa fa-question-circle info" data-toggle="popover" title="Why do you need this?" data-content="If you are traveling for work, we'll find you popular business travel features like breakfast, WiFi and free parking." data-placement="bottom"></i></label>
											<br>
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
													<label class="checkbox-inline">
														{!! Form::radio('for_work', '1', ['class' => 'form-control', 'id' => 'travel_for_work_yes']) !!} Yes
													</label>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
													<label class="checkbox-inline">
														{!! Form::radio('for_work', '0', ['class' => 'form-control', 'id' => 'travel_for_work_yes']) !!} No
													</label>
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
		@include('shared.steps', ['step_title' => 'HOTEL RESERVATION', 'service_name' => 'hotel reservation'])
		@include('shared.faqs', ['service_name' => 'hotel reservation'])
	</div>


	@include('shared.ad_space')
	
@endsection

@section('modified-script')
	<script type="text/javascript">
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 

		    <?php 
				$check_in = "";
				$check_out = "";

				$old_ci = old('check_in');
				$old_co = old('check_out');

				if (!empty($old_ci)) {
					$check_in = date("m/d/Y", strtotime($old_ci));
				}
				else {
					$check_in = "";
				}

				if (!empty($old_co)) {
					$check_out = date("m/d/Y", strtotime($old_co));
				}
				else {
					$check_out = "";
				}
			?>
			$("#hotel-check_in").datetimepicker({
				minDate: moment(),
				date: '{!! $check_in !!}',
				format: 'MM/DD/YYYY',
				icons: {
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right'
				}
			});

			$("#hotel-check_out").datetimepicker({
				minDate: moment(),
				date: '{!! $check_out !!}',
				format: 'MM/DD/YYYY',
				icons: {
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right'
				}
			});

			$("#hotel-check_in").on("dp.change", function(e){
				$("#hotel-check_out").data("DateTimePicker").minDate(e.date);
			});

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
		$('.info').popover({});
	</script>
@endsection

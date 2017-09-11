@extends('master')

@section('meta-description', 'Bus Booking with MBK, Madya Byahe kita. A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines')
@section('meta-keywords', 'bus, booking, inquiry, travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita')

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

@section('title', 'MBK - Bus Booking Inquiry')

@section('content')
    <!-- Main content -->
	<div id="header">
		<div class="fill">
			<div id="header-content">
				<div class="card gardient-blue">
					{!! Form::open(['id' => 'flight-form', 'data-toggle' => 'validator', 'role' => 'form']) !!}
						<div class="row">
							<div class="head">
								<h4 class="title text-blue text-uppercase"><b>Bus Booking Inquiry Form</b></h4>
								<small class="desc">Please fill out the form completely and we'll get right back to you through your email address</small>
							</div>
							<div class="body">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('travel_type', 'TRAVEL TYPE', ['class' => 'form-label']) !!}
											<br>
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 div-form-radio">
													<label class="checkbox-inline label-form-radio">
														{!! Form::radio('travel_type', '1', true); !!} Round Trip
													</label>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 div-form-radio">
													<label class="checkbox-inline label-form-radio">
														{!! Form::radio('travel_type', '0'); !!} One Way
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="form-group">
											{!! Form::label('origin', 'ORIGIN', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::select('origin', $bus_travel_locations, 0, ['class' => 'form-control location-from-select', 'id' => 'loc_from', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="form-group">
											{!! Form::label('destination', 'DESTINATION', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::select('destination', $bus_travel_locations, 0, ['class' => 'form-control location-to-select', 'id' => 'loc_to', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="form-group">
											{!! Form::label('date_departure', 'DEPART', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('date_departure', old('date_departure', date('Y-m-d')), ['class' => 'form-control', 'id' => 'bus-date_depart', 'placeholder' => 'MM/DD/YYYY', 'onkeydown' => 'return false', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" id="date_return_container">
										<div class="form-group">
											{!! Form::label('date_return', 'RETURN', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('date_return', old('date_return', date('Y-m-d')), ['class' => 'form-control', 'id' => 'bus-date_return', 'placeholder' => 'MM/DD/YYYY', 'onkeydown' => 'return false']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('drop_off_point', 'MAIN DROP OFF POINTS', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::select('drop_off_point', $drop_off_points, 0, ['class' => 'form-control', 'id' => 'drop_off']) !!}
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('id_number', 'ID NUMBER (STUDENT ID/SENIOR CITIZEN ID/PWD ID)', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('id_number', '', ['class' => 'form-control', 'id' => 'id_number', 'placeholder' => '000000']) !!}
												</div>
											</div>
											<small>For passengers who wants to avail student, senior citizen, or pwd discount, please indicate your id number below</small>
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
													{!! Form::text('birthday', $birthday, ['class' => 'form-control', 'id' => 'birthdate', 'placeholder' => 'MM/DD/YYYY', 'required' => 'required', 'onkeydown' => 'return false']) !!}
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
		@include('shared.steps', ['step_title' => 'BUS BOOKING', 'service_name' => 'bus booking'])
		@include('shared.faqs', ['service_name' => 'bus booking'])
	</div>


	@include('shared.ad_space')
	
@endsection

@section('modified-script')
	<script type="text/javascript">
		

		$(document).ready(function() {
			$("#loc_from").select2();
			$("#loc_to").select2();
			$('#drop_off').select2();


		 	$('#loc_from').on("select2:select", function(e) {
		   		$.ajax({
		   			url: "{!! url('/') !!}/inquiries/get-drop-offs",
				    dataType: 'json',
				    delay: 250,
				    data: {
				    	'origin_id': $(this).val(),
				    	'destination_id' : $('#loc_to').val()
					},
				    success: function (data) {
				    	if (data == "none" || data == "") {
				    		$('#drop_off').html('<option value="0">-- There is no drop off point in your route --</option>');
				    	}
				    	else {
				    		$('#drop_off').html('<option value="0">-- Select a drop off point --</option>');
					      	$.each(data, function(key, value) {
			                    $('#drop_off').append('<option value="' + key + '">' + value + '</option>');
			                });
				    	}
				    },
				    error: function (jqXHR, exception) {
				    	console.log(exception);
				    },
				    cache: true
		   		});
			});


			$('#loc_to').on("select2:select", function(e) { 
		   		$.ajax({
		   			url: "{!! url('/') !!}/inquiries/get-drop-offs",
				    dataType: 'json',
				    delay: 250,
				    data: {
				    	'origin_id': $('#loc_from').val(),
				    	'destination_id' : $(this).val()
					},
				    success: function (data) {
				    	//alert(data);
				    	if (data == "none" || data == "") {
				    		$('#drop_off').html('<option value="0">-- There is no drop off point in your route --</option>');
				    	}
				    	else {
				    		$('#drop_off').html('<option value="0">-- Select a drop off point --</option>');
					      	$.each(data, function(key, value) {
			                    $('#drop_off').append('<option value="' + key + '">' + value + '</option>');
			                });
				    	}
				    	
				    },
				    error: function (jqXHR, exception) {
				    	console.log(exception);
				    },
				    cache: true
		   		});
			});
			<?php 
				$date_departure = "";
				$date_return = "";

				$old_dd = old('date_departure');
				$old_dr = old('date_return');

				if (!empty($old_dd)) {
					$date_departure = date("m/d/Y", strtotime($old_dd));
				}
				else {
					$date_departure = "";
				}

				if (!empty($old_dr)) {
					$date_return = date("m/d/Y", strtotime($old_dr));
				}
				else {
					$date_return = "";
				}
			?>
			$("#bus-date_depart").datetimepicker({
				minDate: moment(),
				date: '{!! $date_departure !!}',
				format: 'MM/DD/YYYY',
				icons: {
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right'
				}
			});

			$("#bus-date_return").datetimepicker({
				minDate: moment(),
				date: '{!! $date_return !!}',
				format: 'MM/DD/YYYY',
				icons: {
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right'
				}
			});

			$("#bus-date_depart").on("dp.change", function(e){
				$("#bus-date_return").data("DateTimePicker").minDate(e.date);
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
	</script>
@endsection

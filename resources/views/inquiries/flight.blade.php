@extends('master')

@section('meta-description', 'Inquire a flight to MBK, Madya Byahe kita. A Travel and Tour Agency based in Naga City, Camarines Sur, Philippines')
@section('meta-keywords', 'flight, inquiry, travel, travels, tour, tours, naga, camarines, sur, mbk, madya, biyahe, kita')

@section('modified-style')

	<style type="text/css">
		#header{
			position: relative;
			float: left;
			width: 100%;
			background: url('{!! url('/') !!}/assets/images/flight_header.jpg') center no-repeat;
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

@section('title', 'MBK - Inquire a Flight')

@section('content')
    <!-- Main content -->
	<div id="header">
		<div class="fill">
			<div id="header-content">
				<div class="card gardient-blue">
					{!! Form::open(['id' => 'flight-form', 'data-toggle' => 'validator', 'role' => 'form']) !!}
						<div class="row">
							<div class="head">
								<h4 class="title text-blue text-uppercase"><b>Flight Reservation Inquiry Form</b></h4>
								<small class="desc">Please fill out the form completely and we'll get right back to you through your email address</small>
							</div>
							<div class="body">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('flight_route', 'FLIGHT ROUTE', ['class' => 'form-label']) !!}
											<br>
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 div-form-radio">
													<label class="checkbox-inline label-form-radio">
														{!! Form::radio('flight_route', '1', true); !!} Round Trip
													</label>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 div-form-radio">
													<label class="checkbox-inline label-form-radio">
														{!! Form::radio('flight_route', '0'); !!} One Way
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('flight_type', 'FLIGHT TYPE', ['class' => 'form-label']) !!}
											<br>
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 div-form-radio">
													<label class="checkbox-inline label-form-radio">
														{!! Form::radio('flight_type', '0', true); !!} Direct Flight
													</label>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 div-form-radio">
													<label class="checkbox-inline label-form-radio">
														{!! Form::radio('flight_type', '1'); !!} Connecting Flight
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('location_from', 'FROM', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::select('location_from', $locations, null, ['class' => 'form-control location-from-select', 'id' => 'loc_from', 'required' => 'required']) !!}
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('location_to', 'TO', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::select('location_to', $locations, null, ['class' => 'form-control location-to-select', 'id' => 'loc_to', 'required' => 'required']) !!}
												</div>
											</div>
										</div>
									</div>
									
								</div>

								<div class="row">
									<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('adult_no', 'ADULT NO', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::number('adult_no', '1', ['class' => 'form-control number-only', 'id' => 'adult_no', 'min' => '1']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('child_no', 'CHILD NO', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::number('child_no', '0', ['class' => 'form-control number-only', 'id' => 'child_no', 'min' => '0']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('infant_no', 'INFANT NO', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::number('infant_no', '0', ['class' => 'form-control number-only', 'id' => 'infant_no', 'min' => '0']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
										<div class="form-group">
											{!! Form::label('date_departure', 'DEPART', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('date_departure', old('date_departure', date('Y-m-d')), ['class' => 'form-control', 'id' => 'flight-date_depart', 'placeholder' => 'MM/DD/YYYY', 'onkeydown' => 'return false', 'required' => 'required']) !!}
												</div>
											</div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="date_return_container">
										<div class="form-group">
											{!! Form::label('date_return', 'RETURN', ['class' => 'form-label']) !!}
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
													{!! Form::text('date_return', old('date_return', date('Y-m-d')), ['class' => 'form-control', 'id' => 'flight-date_return', 'placeholder' => 'MM/DD/YYYY', 'onkeydown' => 'return false']) !!}
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
		@include('shared.steps', ['step_title' => 'International/Local Airline Ticketing', 'service_name' => 'flight reservation'])
		@include('shared.faqs', ['service_name' => 'flight reservation'])
	</div>


	@include('shared.airline_partners')

	@include('shared.ad_space')
	
@endsection

@section('modified-script')
	<script type="text/javascript">
		/*var loc_from = {
			typeaheadInit: function(){
				var jsonData = [{
									'id': 1,
									'name': '(DRW) Darwin'
								},
								{
									'id': 2,
									'name': '(OOL) Gold Coast'
								},
								{
									'id': 3,
									'name': '(MEL) Melbourne'
								}];

				var locationNames = [];
				$.each(jsonData, function(index, location){
					locationNames.push(location.name + "#" + location.id);
				});

				$("#loc_from").typeahead({
					source: locationNames,
					highlighter: function(item){
						var parts = item.split("#");
						html = '<div><div class="typehead-inner" id="'+parts[1]+'">';
						html += '<div class="item-body">';
						html += '<p class="item-heading">'+parts[0]+'</p>';
						html += '</div>';
						html += '</div></div>';

						var query = this.query;
						var reEscQuery = query.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
						var reQuery = new RegExp('(' + reEscQuery + ')', "gi");
				        var jElem = $(html);
				        var textNodes = $(jElem.find('*')).add(jElem).contents().filter(function() {
				          return this.nodeType === 3;
				        });
				        textNodes.replaceWith(function() {
				          return $(this).text().replace(reQuery, '<strong>$1</strong>');
				        });

				        return jElem.html();
					},
					updater: function(selectedLocation){
						var location = selectedLocation.split('#')[0];
	    				return location;
					}
				});
			},

			initialize: function(){
				var _this = this;
				_this.typeaheadInit();
			}
		};

		var loc_to = {
			typeaheadInit: function(){
				var jsonData = [{
									'id': 1,
									'name': '(DRW) Darwin'
								},
								{
									'id': 2,
									'name': '(OOL) Gold Coast'
								},
								{
									'id': 3,
									'name': '(MEL) Melbourne'
								}];

				var locationNames = [];
				$.each(jsonData, function(index, location){
					locationNames.push(location.name + "#" + location.id);
				});

				$("#loc_to").typeahead({
					source: locationNames,
					highlighter: function(item){
						var parts = item.split("#");
						html = '<div><div class="typehead-inner" id="'+parts[1]+'">';
						html += '<div class="item-body">';
						html += '<p class="item-heading">'+parts[0]+'</p>';
						html += '</div>';
						html += '</div></div>';

						var query = this.query;
						var reEscQuery = query.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
						var reQuery = new RegExp('(' + reEscQuery + ')', "gi");
				        var jElem = $(html);
				        var textNodes = $(jElem.find('*')).add(jElem).contents().filter(function() {
				          return this.nodeType === 3;
				        });
				        textNodes.replaceWith(function() {
				          return $(this).text().replace(reQuery, '<strong>$1</strong>');
				        });

				        return jElem.html();
					},
					updater: function(selectedLocation){
						var location = selectedLocation.split('#')[0];
	    				return location;
					}
				});
			},

			initialize: function(){
				var _this = this;
				_this.typeaheadInit();
			}
		}
		
		$(document).ready(function(){
			loc_from.initialize();
			loc_to.initialize();
		});*/

		$(document).ready(function() {
			$(".location-from-select").select2();
			$(".location-to-select").select2();

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
			$("#flight-date_depart").datetimepicker({
				minDate: moment(),
				date: '{!! $date_departure !!}',
				format: 'MM/DD/YYYY',
				icons: {
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right'
				}
			});

			$("#flight-date_return").datetimepicker({
				minDate: moment(),
				date: '{!! $date_return !!}',
				format: 'MM/DD/YYYY',
				icons: {
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right'
				}
			});

			$("#flight-date_depart").on("dp.change", function(e){
				$("#flight-date_return").data("DateTimePicker").minDate(e.date);
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

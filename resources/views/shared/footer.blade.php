<!-- Footer -->
<div class="row bg-gray text-white footer">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box main">
		<h3 id="title" class="manus text-blue">Madya Biyahe Kita!</h3>
		<small id="subtitle" class="text-uppercase">Travel &amp; Tours Agency</small>

		<p id="small-desc">
			<?php
				
				if (strlen($homepage->about) >= 160) {
                	$pos=strpos($homepage->about, ' ', 160); 
                }
                else {
                	$pos = strlen($homepage->about);
                }
            ?>
            
            {!! substr($homepage->about, 0, $pos) !!}...
		</p>

		<ul id="social">
			<li><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
			<li><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
			<li><a href="#"><i class="fa fa-instagram text-white"></i></a></li>
		</ul>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box main-tablet">
		<h5 class="text-white text-uppercase">Contact Info</h5>
		<div class="media" style="margin-top: 40px">
			<div class="media-left"><i class="fa fa-map-marker"></i></div>
			<div class="media-body"><p>{!! $homepage->address !!}</p></div>
		</div>
		<div class="media">
			<div class="media-left"><i class="fa fa-phone"></i></div>
			<div class="media-body"><p>{!! $homepage->phone_number !!}</p></div>
		</div>
		<div class="media">
			<div class="media-left"><i class="fa fa-envelope"></i></div>
			<div class="media-body"><p>{!! $homepage->email_address !!}</p></div>
		</div>
	</div>

	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 box">
		<h5 class="text-white text-uppercase">Services</h5>
		<ul id="services" style="margin-top: 20px">
			<li><a href="{!! url('/') !!}/inquiries/airline-ticketing" class="text-white">Airline Ticketing</a></li>
			<li><a href="{!! url('/') !!}/inquiries/bus-booking" class="text-white">Bus Booking</a></li>
			<li><a href="{!! url('/') !!}/tour-packages" class="text-white">Tour Packages</a></li>
			<li><a href="{!! url('/') !!}/visa-assistance" class="text-white">Visa Assistance</a></li>
			<li><a href="{!! url('/') !!}/travel-insurance" class="text-white">Travel Insurance</a></li>
			<li><a href="{!! url('/') !!}/inquiries/hotel-reservation" class="text-white">Hotel Reservation</a></li>
			<li><a href="{!! url('/') !!}/inquiries/van-rental" class="text-white">Van Rental</a></li>
		</ul>
	</div>

	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 box">
		<h5 class="text-white text-uppercase">Support</h5>
		<ul id="support" style="margin-top: 20px">
			<li><a href="{!! url('/') !!}/faqs" class="text-white">FAQs</a></li>
			<li><a href="{!! url('/') !!}/testimonials" class="text-white">Testimonials</a></li>
			<li><a href="{!! url('/') !!}/hotel-cancellation-policy" class="text-white">Hotel Cancellation Policy</a></li>
			<li><a href="{!! url('/') !!}/flight-cancellation-policy" class="text-white">Flight Cancellation Policy</a></li>
			<li><a href="{!! url('/') !!}/terms-and-conditions" class="text-white">Terms and Conditions</a></li>
			<li><a href="{!! url('/') !!}/work-with-us" class="text-white">Work With Us</a></li>
		</ul>
	</div>

	<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 box">
		<p id="signature">
			&copy; 2017<br>
			All rights reserved<br><br>
			Made by<br>
			Creative Minds <sup>PH</sup>
		</p>
	</div>
</div>
<!-- Footer -->
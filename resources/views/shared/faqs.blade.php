<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 box">
	<h2 class="title text-uppercase text-blue">FAQs</h2>
	<small>Frequently asked questions regarding {!! $service_name !!}</small>
	<?php $counter = 0; ?>
	@foreach ($faqs as $faq)
		<h5 class="text-blue" style="
		@if ($counter == 0)
			margin-top: 50px
		@endif
		"><b>{!! $faq->question !!}</b></h5>
		<p>
			{!! $faq->answer !!}
		</p>
		<br>
		<?php $counter++ ?>
	@endforeach
	<a href="{!! url('/') !!}/faqs" class="btn btn-primary text-uppercase pull-right">Read More FAQs</a>
	<!-- <h2 class="title text-uppercase text-blue">Modes Of Payment</h2>
	<small>We accept the following modes of payment for this specific service</small>
	<div id="payment-swiper" class="swiper-container">
		<div class="swiper-wrapper">
			<div class="swiper-slide"><img src="{!! url('/') !!}/assets/images/credit_cards/american_express.jpg"></div>
			<div class="swiper-slide"><img src="{!! url('/') !!}/assets/images/credit_cards/bdo.jpg"></div>
			<div class="swiper-slide"><img src="{!! url('/') !!}/assets/images/credit_cards/bpi.jpg"></div>
			<div class="swiper-slide"><img src="{!! url('/') !!}/assets/images/credit_cards/discover.jpg"></div>
			<div class="swiper-slide"><img src="{!! url('/') !!}/assets/images/credit_cards/jcb.jpg"></div>
			<div class="swiper-slide"><img src="{!! url('/') !!}/assets/images/credit_cards/mastercard.jpg"></div>
			<div class="swiper-slide"><img src="{!! url('/') !!}/assets/images/credit_cards/paypal.jpg"></div>
			<div class="swiper-slide"><img src="{!! url('/') !!}/assets/images/credit_cards/visa.jpg"></div>
		</div>
	</div> -->
</div>
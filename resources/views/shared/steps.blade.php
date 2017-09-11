<div class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-6 col-xs-12 box">
	<h2 class="title text-uppercase text-blue">{!! $step_title !!}</h2>
	<small>Procedure on how to make a {!! $service_name !!}</small>
	<?php $ends = array('th','st','nd','rd','th','th','th','th','th','th'); ?>
	@foreach ($steps as $step)
		@if (($step->step_number %100) >= 11 && ($step->step_number%100) <= 13)
		   <?php $abbreviation = $step->step_number. '<sup>th</sup>'; ?>
		@else
		   <?php $abbreviation = $step->step_number. '<sup>' .$ends[$step->step_number % 10].'</sup>'; ?>
		@endif
		<div class="media" style="margin-top: 50px">
			<div class="media-left">
				<h3 class="text-blue">{!! $abbreviation !!}</h3>
			</div>
			<div class="media-body">
				<p>
					{!! $step->step_desc !!}
				</p>
			</div>
		</div>
	@endforeach
</div>
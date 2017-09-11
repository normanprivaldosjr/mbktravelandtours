$(window).on('load', function(){
	$("#container").addClass("loaded");
	$("#loader").fadeOut("slow");

	setTimeout(function(){
		$("#loader").addClass("inactive");
	}, 1000);
});

$(function () {
	var $nav = $(".navbar-fixed-top");
	$nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	
	$(document).scroll(function () {
		var $nav = $(".navbar-fixed-top");
		$nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	});

	if($("input[name=flight_route]").val() == 0)
		$("#date_return_container").css("display", "none");
	else
		$("#date_return_container").css("display", "block");

	if($("input[name=travel_type]").val() == 0) {
		alert("test");
		$("#date_return_container").css("display", "none");
	}
	else
		$("#date_return_container").css("display", "block");

	$(document).ready(function () {
		var slides, space;

		if($(window).width() <= 425){
			slides = 2;
			space = 15;

			logo_slide = 2;
			logo_space = 15;

			payment_slide = 3;
			payment_space = 1;
		} else{
			slides = 3;
			space = 30;

			logo_slide = 5;
			logo_space = 30;

			payment_slide = 4;
			payment_space = 15;
		}

		//initialize swiper when document ready  
		var internationalSwiper = new Swiper ('#international-swiper', {
			// Optional parameters
			pagination: '.swiper-pagination',
	        slidesPerView: slides,
	        paginationClickable: true,
	        spaceBetween: space,
	        freeMode: true,
	        observer:true,
			observeParents:true
		});  

		var localSwiper = new Swiper ('#local-swiper', {
			// Optional parameters
			pagination: '.swiper-pagination',
	        slidesPerView: slides,
	        paginationClickable: true,
	        spaceBetween: space,
	        freeMode: true,
	        observer:true,
			observeParents:true
		});    

		var logoSwiper = new Swiper ('#logo-swiper', {
			autoplay: 2000,
			speed: 500,
			slidesPerView: logo_slide,
			spaceBetween: logo_space,
			freeMode: true,
			observer: true,
			observeParents: true
		});

		var paymentSwiper = new Swiper ('#payment-swiper', {
			autoplay: 2000,
			speed: 500,
			slidesPerView: payment_slide,
			spaceBetween: payment_space,
			freeMode: true,
			observer: true,
			observeParents: true
		});

		$('#travel-date').datetimepicker({
			minDate: moment(),
			format: 'MM/DD/YYYY',
			icons: {
				previous: 'fa fa-chevron-left',
				next: 'fa fa-chevron-right'
			}
		});   

		$("#date_depart").datetimepicker({
			minDate: moment(),
			format: 'MM/DD/YYYY',
			icons: {
				previous: 'fa fa-chevron-left',
				next: 'fa fa-chevron-right'
			}
		});

		$("#date_return").datetimepicker({
			minDate: moment(),
			format: 'MM/DD/YYYY',
			icons: {
				previous: 'fa fa-chevron-left',
				next: 'fa fa-chevron-right'
			}
		});

		$("#birthdate").datetimepicker({
			maxDate: moment(),
			format: 'MM/DD/YYYY',
			icons: {
				previous: 'fa fa-chevron-left',
				next: 'fa fa-chevron-right'
			}
		});

		$("#check_in").datetimepicker({
			minDate: moment(),
			format: 'MM/DD/YYYY',
			icons: {
				previous: 'fa fa-chevron-left',
				next: 'fa fa-chevron-right'
			}
		});

		$("#check_out").datetimepicker({
			minDate: moment(),
			format: 'MM/DD/YYYY',
			icons: {
				previous: 'fa fa-chevron-left',
				next: 'fa fa-chevron-right'
			}
		});

		$("#date_depart").on("dp.change", function(e){
			$("#date_return").data("DateTimePicker").minDate(e.date);
		});

		$("#check_in").on("dp.change", function(e){
			$("#check_out").data("DateTimePicker").minDate(e.date);
		});

		$("#chatbox-toggle").on("click", function(){
			$("#chatbox-container").toggleClass("opened");
		});

		$("input[name=flight_route]").on('change', function(){
			if($(this).val() == 0)
				$("#date_return_container").css("display", "none");
			else
				$("#date_return_container").css("display", "block");
		});

		$("input[name=travel_type]").on('change', function(){
			if($(this).val() == 0)
				$("#date_return_container").css("display", "none");
			else
				$("#date_return_container").css("display", "block");
		});
	});
});

function changeBackground(id){
	$('.tour-background').removeClass("active");
	$(id).addClass("active");
}

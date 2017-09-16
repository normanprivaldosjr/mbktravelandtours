$(window).on('load', function(){
	$("#container").addClass("loaded");
	$("#loader").fadeOut("slow");

	setTimeout(function(){
		$("#loader").addClass("inactive");
	}, 1000);
});

$(document).ready(function () {
    $("#sidebar").niceScroll({
        cursorcolor: 'rgba(0, 0, 0, 0.2)',
        cursorwidth: 4,
        cursorborder: 'none'
    });

    $('#sidebar-toggle').on('click', function () {
        $('#sidebar, #content, #sidebar-toggle').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});
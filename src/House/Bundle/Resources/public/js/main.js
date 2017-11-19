$(document).ready(function($) {
	$('.dropdown-toggle').dropdown();

	$('#tabproducts a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	//button scroll top and contact-us
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#fixed').fadeIn();
        } else {
            $('#fixed').fadeOut();
        }
    });
    $('button.top-list').click(function () {
        $('#fixed').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    $('button.top-list').tooltip('show');
    //end scroll top and contact-us
});
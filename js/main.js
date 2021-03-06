( function( $ ) {

	$(".search-trigger").click(function(){
		$(".search-form").toggleClass("act");
	});

	$(".login").click(function(){
		$("body").addClass("login-open");
	});

	$("#loginform").addClass("custom-form");

	$(".single-chapters").parent().removeClass("subpage").addClass("single-chapter");

	$('.hero-slider').carousel({
		interval: 4000
	});

	$(".close-login").click(function(){
		$("body").removeClass("login-open");
	});

	$(".bg-overlay").click(function(){
		$("body").removeClass("login-open");
	});

	$("#menu-account .page_item_has_children > a").click(function(){
		$('.page_item_has_children').removeClass("act");
		$(this).parent().addClass("act");
		return false;
	});

	$("#menu-account .menu-item-has-children > a").click(function(){
		$('.menu-item-has-children').removeClass("act");
		$(this).parent().addClass("act");
		return false;
	});


	if ( 'function' === typeof $.fn.magnificPopup ) {
		$('.gallery').magnificPopup({
			delegate: 'a',
			type: 'image',
			closeOnContentClick: false,
			closeBtnInside: false,
			mainClass: 'mfp-with-zoom mfp-img-mobile',
			image: {
				verticalFit: true
			},
			gallery: {
				enabled: true
			},
			zoom: {
				enabled: true,
				duration: 300, // don't foget to change the duration also in CSS
				opener: function(element) {
					return element.find('img');
				}
			}

		});

		$('.user-gallery').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
				delegate: 'a:not(.edit_link)', // the selector for gallery item
				type: 'image',
				gallery: {
				  enabled:true
				}
			});
		});
	}

$( "#photoFilter" ).on( "change", "select", function() {
	$("#photoFilter select").removeAttr('style').removeAttr("selected").not(this).val($("#photoFilter select option:first").val()).delay( 3000 );
		$( "#photoFilter" ).submit();
});


} )( jQuery );

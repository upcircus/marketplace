$(document).ready(function() {
	/*
	  *  Simple image gallery. Uses default settings
	  */

	$('.fancybox').fancybox();

	/*
	  *  Different effects
	  */

	// Change title type, overlay closing speed
	$(".fancybox-effects-a").fancybox({
		helpers: {
			title : {
				type : 'outside'
			},
			overlay : {
				speedOut : 0
			}
		}
	});

	// Disable opening and closing animations, change title type
	$(".fancybox-effects-b").fancybox({
		openEffect  : 'none',
		closeEffect	: 'none',

		helpers : {
			title : {
				type : 'over'
			}
		}
	});

	// Set custom style, close if clicked, change title type and overlay color
	$(".fancybox-effects-c").fancybox({
		wrapCSS    : 'fancybox-custom',
		closeClick : true,

		openEffect : 'none',

		helpers : {
			title : {
				type : 'inside'
			},
			overlay : {
				css : {
					'background' : 'rgba(0,0,0,0.85)'
				}
			}
		}
	});

	// Remove padding, set opening and closing animations, close if clicked and disable overlay
	$(".fancybox-effects-d").fancybox({
		padding: 0,

		openEffect : 'elastic',
		openSpeed  : 150,

		closeEffect : 'elastic',
		closeSpeed  : 150,

		closeClick : true,

		helpers : {
			overlay : null
		}
	});

	/*
	  *  Button helper. Disable animations, hide close button, change title type and content
	  */

	$('.fancybox-buttons').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',

		prevEffect : 'none',
		nextEffect : 'none',

		closeBtn  : false,

		helpers : {
			title : {
				type : 'inside'
			},
			buttons	: {}
		},

		afterLoad : function() {
			this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
		}
	});


	/*
	  *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
	  */

	$('.fancybox-thumbs').fancybox({
		prevEffect : 'none',
		nextEffect : 'none',

		closeBtn  : false,
		arrows    : false,
		nextClick : true,

		helpers : {
			thumbs : {
				width  : 50,
				height : 50
			}
		}
	});

	/*
	  *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
	*/
	$('.fancybox-media')
		.attr('rel', 'media-gallery')
		.fancybox({
			openEffect : 'none',
			closeEffect : 'none',
			prevEffect : 'none',
			nextEffect : 'none',

			arrows : false,
			helpers : {
				media : {},
				buttons : {}
			}
		});

	/*
	  *  Open manually
	  */

	$("#fancybox-manual-a").click(function() {
		$.fancybox.open('1_b.jpg');
	});

	$("#fancybox-manual-b").click(function() {
		$.fancybox.open({
			href : 'iframe.html',
			type : 'iframe',
			padding : 5
		});
	});

	$("#fancybox-manual-c").click(function() {
		$.fancybox.open([
			{
				href : '1_b.jpg',
				title : 'My title'
			}, {
				href : '2_b.jpg',
				title : '2nd title'
			}, {
				href : '3_b.jpg'
			}
		], {
			helpers : {
				thumbs : {
					width: 75,
					height: 50
				}
			}
		});
	});


});





$(document).ready(function() {
$(".various").fancybox({
	maxWidth	: 500,
	maxHeight	: 550,
	fitToView	: false,
	width		: '70%',
	height		: '70%',
	autoSize	: false,
	closeClick	: false,
	openEffect	: 'none',
	closeEffect	: 'none'

  });
});

$(document).ready(function() {
$(".connexion").fancybox({
	maxWidth	: 500,
	maxHeight	: 350,
	fitToView	: false,
	width		: '100%',
	height		: '100%',
	autoSize	: false,
	closeClick	: false,
	openEffect	: 'none',
	closeEffect	: 'none',
	type		: 'iframe',

  });
});

$(document).ready(function() {
$(".connexion_mob").fancybox({

	fitToView	: false,
	width		: '100%',
	height		: '100%',
	autoSize	: false,
	closeClick	: false,
	openEffect	: 'none',
	closeEffect	: 'none',
	type		: 'iframe',
	afterClose	: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
			  parent.location.reload(true);}
  });
});

$(document).ready(function() {
$("a.social").fancybox({ 			
		'hideOnContentClick'		: true,
		'padding'			: 0,
		'overlayColor'			:'#D3D3D3',
		'transitionIn'			:'elastic',
		'transitionOut'			:'elastic',
		'overlayOpacity'		: 0.7,
		'zoomSpeedIn'			: 300,
		'zoomSpeedOut'			: 300,
		'width'				: 950,
		'height'			: 400,
		'type'				:'iframe'
		});
});

$(document).ready(function() {
$(".moderation").fancybox({

	type		: 'iframe',
	afterClose	: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
			  parent.location.reload(true);}
  });
});
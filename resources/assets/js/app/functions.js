var xhr;

var ajaxCall = function (url, method, data, successCallback, failCallback, params) {
	if (xhr != null) {
		xhr.abort();
	}

	xhr = $.ajax({
		method: method,
		url: url,
		data: data
	})
	.done(function (response) {
		xhr = null;
		successCallback(response, params);
	})
	.fail(function (response) {
		failCallback(response, params);
	});
};

var submitForm = function () {
	var $this = $(this),
		$form = $this.parents('.ajax-refine-form');

	$form.submit();
}

$(document).ready(function() {
	// This is to prevent the ajax caching issue in Chrome
	$.ajaxSetup({
		cache: false
	});

	// Mobile navbar
	$('.navbar-toggle').click(function(event) {
		$('.navbar-header .right-col').stop().slideToggle();
	});

	// Homepage slider
	$('.page-home .slider').flexslider({
		prevText: '',
		nextText: ''
	});

	// Product page slider
	$('.page-product #slider').flexslider({
		animation: 'fade',
		controlNav: false,
		directionNav: false,
		animationLoop: false,
		slideshow: false,
		sync: '#carousel'
	});

	// Product page thumbs
	$('.page-product #carousel').flexslider({
		animation: 'slide',
		controlNav: false,
		//directionNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 184,
		itemMargin: 22,
		asNavFor: '#slider',
		prevText: '',
		nextText: ''
	});

	// Product page slider nav
	$('.page-product .nav-prev').on('click', function() {
		$('.page-product #carousel').flexslider('prev');
	})

	// Product page slider nav
	$('.page-product .nav-next').on('click', function() {
		$('.page-product #carousel').flexslider('next');
	})

	// Animate on scroll
	AOS.init({
		offset: 200,
		duration: 600
	});

	// Sly scroller
	var $frame = $('.products-carousel');
	var $slidee = $frame.children('ul').eq(0);
	var $wrap = $frame.parent();

	// Call Sly on frame
	$frame.sly({
		horizontal: true,

		// Item based navigation
		itemNav: 'basic',
		activatePageOn: 'click',
		activateOn: 'click',
		smart: true,

		// Scrolling
		scrollBy: 0,

		// Dragging
		mouseDragging: true,
		touchDragging: true,
		releaseSwing: true,
		swingSpeed: 0.2,
		elasticBounds: true,

		// Mixed options
		startAt: 0,
		easing: 'easeOutExpo',
		speed: 300
	});

	// Click search icon on header
	$('header .icon-search').click(function() {
		$(this).toggleClass('active');

		if ($(this).hasClass('active')) {
			$('.search-container').addClass('active');

			$('.search-container .form-control').focus();
		}
		else {
			$('.search-container .form-control').blur();

			$('.search-dropdown').slideUp('fast', function() {
				$('.search-container').removeClass('active');
			});
		}
	});

	// Click search dropdown close button
	$('.search-container .icon').click(function() {
		var dropdown = $('.search-dropdown');

		$(this).removeClass('active');
		$('.search-container .form-control').val('');
		dropdown.slideUp('fast');
	});

	// Enter search term
	$('.search-container .form-control').on('input', function(e) {
		window.clearTimeout($(this).data('timeout'));

		var parent = $('.search-container');
		var dropdown = parent.children('.search-dropdown');
		var icon = parent.find('.icon');
		var value = $.trim($(this).val());

		$(this).data('timeout', setTimeout(function() {
			var successCallback = function(response) {
				//console.log(response);

				dropdown.html(response);
			};

			var failCallback = function(response) {
				//console.log(response);
			};

			$('.search-container .loading').fadeIn();

			if (value != '' && value.length >= 2) {
				var url = $('.search').attr('data-url');

				var data = {
					search : value
				};

				ajaxCall(url, 'get', data, successCallback, failCallback);

				icon.addClass('active');

				dropdown.slideDown('fast');
			}
			else {
				icon.removeClass('active');

				dropdown.slideUp('fast');
			}
		}, 500));
	});

	// Results page price slider
	$('.page-results .results-block .price-slider').slider({
		min: 50,
		step: 100,
		max: 10000,
		value: 10000,
		slide: function(event, ui) {
			$('.price .value span').text(ui.value);
		},
		change: function(event, ui) {
			$('#max-price').val(ui.value).change();
		}
	});

	// Results page view button toggle
	$('.page-results .results-block').on('click', '.results .views span', function() {
		$(this).siblings().removeClass('active');
		$(this).addClass('active');

		if ($(this).hasClass('list-view')) {
			$('.results-block .items-grid').hide().addClass('list-view').removeClass('grid-view').fadeIn();
		}

		else if ($(this).hasClass('grid-view')) {
			$('.results-block .items-grid').hide().addClass('grid-view').removeClass('list-view').fadeIn();
		}
	});

	$('.page-basket').on('submit', '.basket-delete-item', function(event) {
		event.preventDefault();
		$form = $(this);
		var url = $form.attr('action');
		var method = $form.attr('method');
		var data = $form.serializeArray();
		var params = {};

		var successCallback = function (response) {
			$('.ajax-basket').html(response);
		};
		var failCallback = function (response) {
		};

		if(confirm('Are you sure you want to remove this item from your basket?')) {
			$('.overlay').fadeIn('fast');

			ajaxCall(url, method, data, successCallback, failCallback, params);
		}
	});

	// Disable default form submit on enter keypress
	$('.page-basket').on('keyup keypress', '.basket-quantity', function(e) {
		var keyCode = e.keyCode || e.which;

		if (keyCode === 13) {
			e.preventDefault();

			$(this).blur();
		}
	});

	$('.page-basket').on('change', '.basket-quantity', function() {
		var item = $(this).parents('.item');

		$(this).parent('form').submit();

		$('.overlay').fadeIn('fast');
	});

	$('.page-basket').on('submit', '.basket-update-form', function(event) {
		event.preventDefault();
		$form = $(this);
		var parent = $form.parents('.item');
		var url = $form.attr('action');
		var method = $form.attr('method');
		var data = $form.serializeArray();
		var params = {};

		if(parseInt($form.find('.basket-quantity').val()) < 1 ) {
			var error = 'Quantity must be greater than 1';
			$('.overlay').addClass('error').find('.error-text').text(error);
			return;
		}

		var successCallback = function (response) {
			$('.ajax-basket').html(response);
		};
		var failCallback = function (response) {
			var errors = response.responseJSON.quantity;
			var error = errors[errors.length - 1];
			$('.overlay').addClass('error').find('.error-text').text(error);
		};

		ajaxCall(url, method, data, successCallback, failCallback, params);
	});

	// Basket page - click OK button on error message overlay
	$('.page-basket').on('click', '.error-message .btn-ok', function() {
		$(this).parents('.overlay').fadeOut().removeClass('error');
	});

	// Show refine filters
	$('.page-results .filters .show-filters').click(function() {
		$('.filters-main').slideToggle();

		var span = $(this).children('span');

		var text = span.text();

		span.text(text == 'Show Filters' ? 'Hide Filters' : 'Show Filters');
	});

	$('.page-product .product-variant').change(function(event) {
		$selected = $(this).find(':selected');
		var price = $selected.attr('data-price');
		var stock = $selected.attr('data-stock');
                var sku = $selected.attr('data-sku');

		$('.price span').text(price);
		$('.stock span').text(stock);
                $('.sku').text(sku);
	});

	/*$(document).on('submit', '.contact-us-form', function(event) {
		event.preventDefault();
		
		$form = $(this);
		var url = $form.attr('action');
		var method = $form.attr('method');
		var data = $form.serializeArray();
		var params = {};
		
		var successCallback = function (response) {
			console.log(response);
		};
		var failCallback = function (response) {
			console.log(response);
		};
		
		ajaxCall(url, method, data, successCallback, failCallback, params);
	});*/

	// Made to Measure - click 'add / remove trim' button
	/*$('.page-designer #controls #add-remove-trim .content').click(function() {
		$(this).parent().toggleClass('active');

		$('#frame').toggleClass('trim-active');
	});*/

	// Made to Measure - change measurement units
	$('.page-designer #measurement-units').change(function() {
		var value = $(this).val();

		if (value == 'M') {
			$('.imperial').hide();
			$('.metric').show();
		}
		else if (value == 'I') {
			$('.imperial').show();
			$('.metric').hide();
		}
	});

	// Click 'choose file' button on create your own page
	$('.page-create-your-own .btn-select').click(function() {
		$('#file').click();
	});

	// Submit form on file input change
	$('.page-create-your-own #file').change(function() {
		$(this).parent('form').submit();
		$('.btn-select').addClass('active');
	});

	// Submit ajax form on input click
	$('.ajax-refine-form').on('click', 'input[type="checkbox"], input[type="radio"]', submitForm);

	// Submit ajax form on input change
	$('.ajax-refine-form').on('change', 'input[type="text"], input[type="hidden"], select', submitForm);

	// Disable default form submit on enter keypress
	$('.ajax-refine-form').on('keyup keypress', 'input[type="text"]', function(e) {
		var keyCode = e.keyCode || e.which;

		if (keyCode === 13) {
			e.preventDefault();

			$(this).blur();
		}
	});

	// Made to measure ajax filters
	$('.page-results .ajax-refine-form').submit(function(event) {
		event.preventDefault();

		$form = $(this);
		var $container = $form.find('.form-ajax-response'),
			parent = $container.parents('form'),
			loading = parent.find('.loading'),
			url = $form.attr('action'),
			method = $form.attr('method'),
			data = $form.serialize(),
			historyURL = url + '?' + data,
			params = {};

		// show loading indicator
		loading.fadeIn('fast');

		var successCallback = function (response) {
			$container.html(response);
			App.functions.addToBrowserHistory.init(historyURL, "Shop");
			App.functions.scrollToElement.init($container, 0);
			loading.fadeOut('fast');
		};
		var failCallback = function (response) {
			console.log(response.responseText);
			loading.fadeOut('fast');
		};

		ajaxCall(url, method, data, successCallback, failCallback, params);
	});

	// Copyright checkbox on create your own page
	$('.page-designer #copyright').change(function() {
		var checked = $(this).is(':checked');

		$('#add-to-basket').prop('disabled', !checked);
	});

	// when the country filed changes value for shipping address, we get the price
	$('.page-checkout-delivery-address .shipping-country').change(function(event) {
		var $selected = $(this).find(':selected'),
			$country = $selected.attr('value'),
			$loading = $('#delivery-address-form').children('.loading');
 
		var url = $(this).attr('data-url');
		var method = 'GET';
		var data = { country: $country };
		var params = {};

		$loading.fadeIn('fast');

		var successCallback = function (response) {
			$('#delivery-price').text(response.price);
			$loading.fadeOut('fast');
		};
		var failCallback = function (response) {
			console.log(response);
			$loading.fadeOut('fast');
		};

		ajaxCall(url, method, data, successCallback, failCallback, params);
	});

	// Use billing address copy function
	$('.page-checkout-delivery-address #use-billing-address').click(function() {
		var $this = $(this),
			$form = $('#delivery-address-form'),
			$selects = $form.find('select'),
			$loading = $form.children('.loading');

		$loading.fadeIn('fast');

		$.ajax({
			type: 'get',
			url: App.routes.getBillingAddressURL,
			cache: false,
			dataType: 'json',
			success: function(response) {
				for (var index in response) {
					$form.find('#' + index).val(response[index]).change();
				}
				$loading.fadeOut('fast');
			},
			error: function(error) {
				console.log(error.responseText);
				$loading.fadeOut('fast');
			}
		});
	});

    // use existing address copy function
	$('.page-checkout-billing-address #use-existing-address, .page-checkout-delivery-address #use-existing-address').change(function() {
		var $this = $(this),
			$form = $('#'+$(this).attr('data-form')),
			$selects = $form.find('select'),
			$loading = $form.children('.loading');

		$loading.fadeIn('fast');

		$.ajax({
			type: 'get',
			url: App.routes.getAddressURL,
			cache: false,
            data: $(this).serializeArray(),
			dataType: 'json',
			success: function(response) {
				for (var index in response) {
					$form.find('#' + index).val(response[index]).change();
				}
				$loading.fadeOut('fast');
			},
			error: function(error) {
				console.log(error.responseText);
				$loading.fadeOut('fast');
			}
		});
	});

    $('.delete-address').submit(function(event) {
		event.preventDefault();
		$form = $(this);
		var url = $form.attr('action');
		var method = $form.attr('method');
		var data = $form.serializeArray();
		var params = {};

		var successCallback = function (response) {
            $form.closest('.item').fadeOut();
		};
		var failCallback = function (response) {
            
		};

		if(confirm('Are you sure you want to delete this address?')) {
			ajaxCall(url, method, data, successCallback, failCallback, params);
		}
	});

    $('.delete-favorite').submit(function(event) {
		event.preventDefault();
		$form = $(this);
		var url = $form.attr('action');
		var method = $form.attr('method');
		var data = $form.serializeArray();
		var params = {};

		var successCallback = function (response) {
            window.location.reload();
		};
		var failCallback = function (response) {
            
		};

		if(confirm('Are you sure you want to delete this favourite?')) {
			ajaxCall(url, method, data, successCallback, failCallback, params);
		}
	});

    // allow the user to toggle favourite
    $('.page-results .results-block, .page-designer .form, .page-product form, .page-home .featured-block').on('click', '.favourite', function(event) {
        event.preventDefault();
        var element = $(this);

        var successCallback = function (response) {
            element.removeClass('waiting').toggleClass('active');
        };
        var failCallback = function (response) {
            alert('There was an error in updating favourite');
        };

        if(App.isAuthUser) {
            element.addClass('waiting');

            ajaxCall(
                App.routes.toggleFavourite,
                'GET',
                {
                    product_id: $(this).attr('data-product-id')
                },
                successCallback,
                failCallback
            );
        } else {
            alert('You need to log in to perform this action.');
        }
    });

	$('.page-results .results-block').on('click', '.quick-view', function(event) {
		event.preventDefault();

		var image = $(this).attr('data-image');

		$('.modal-body .image').css('background-image', 'url(' + image + ')');
	});

	$('.social-share a').click(function(e) {
	    // Prevent default anchor event
	    e.preventDefault();

	    var obj = $(this);

	    // Set values for window
	    var intWidth = '600';
	    var intHeight = '500';

	    // Set title and open popup with focus on it
	    var strTitle = ((typeof obj.attr('title') !== 'undefined') ? obj.attr('title') : 'Social Share');
	    var strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=yes,scrollbars=no';

	    window.open(obj.attr('href'), strTitle, strParam).focus();
	});
        
        // this function will show the review form 
        $('.write-review').click(function(e) {
            $('.review-form').slideToggle();
	});

});

// global variable for the player
var player;

// this function gets called when API is ready to use
function onYouTubePlayerAPIReady() {
	// create the global player from the specific iframe (#video)
	player = new YT.Player('video', {
		events: {
			// call this function when player is ready to use
			'onReady': onPlayerReady
		}
	});
}

function onPlayerReady(event) {
	var button = $('.page-home .video #play-button');

	button.click(function() {
		$(this).parents('.overlay').removeClass('inactive');

		if ($(this).hasClass('active')) {
			player.pauseVideo();
		}
		else {
			player.playVideo();
		}

		$(this).toggleClass('active');
	});
}

function loadDataOnScroll(element, url, limit, offset, count) {
    var wait = false;
    offset = offset + limit;
    var scroll = function() {
        var $this = $(this);
        if (offset <= count && wait === false) {
            wait = true;
            $.get(url, {offset: offset}, function(response) {
                element.append(response);
                offset = offset + limit;
                wait = false;
                if (offset > count) {
                    $this.addClass('hidden');
                }
            }).fail(function(error) {
                alert(error.responseText);
            });
        }
    };
    $(document).on('click', '.load-more', scroll);
}

$(window).on('load', function() {
	if ($('.page-home').length) {
		// Inject YouTube API script
		var tag = document.createElement('script');
		tag.src = "//www.youtube.com/player_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	}
});

$(window).on('resize', function() {
	if ($('.page-home').length) {
		var $frame = $('.products-carousel');

		$frame.sly('reload');
	}
});
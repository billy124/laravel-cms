(function (App, $, History) {
	
	"use strict";
	
	App.functions = App.functions || {};
	
	var fn = App.functions,
		device = App.device,
		$window = App.$window,
		$document = App.$document;
		
	fn.checkDevice = {
		onDomReady: true,
		_onResize: function() {
			device.isMobile = ($window.width() < device.width.mobile) ? true : false;
			device.isTablet = ($window.width() < device.width.tablet) ? true : false;
		},
		init: function() {
			$window.on('resize', this._onResize);
			this._onResize();
		}
	};
	
	fn.confirmDelete = {
		onDomReady: true,
		_config: {
			formSelector: 'form.delete-form',
			message: 'Are you sure you want to delete it?'
		},
		_setConfig: function(config) {
			if (typeof config !== "undefined") {
				$.extend(this._config, config);
			}
		},
		init: function(params) {
			var obj = this;
			obj._setConfig(params);
			$document.on('submit', obj._config.formSelector, function() {
				var $this = $(this),
						message = ($this.data('message')) ? $this.data('message') : obj._config.message;
				return confirm(message);
			});
		}
	};
	
	fn.addToBrowserHistory = {
		init: function(historyURL, pageTitle) {
			pageTitle = (pageTitle) ? pageTitle + ' | ohpopsi' : 'ohpopsi';
			History.pushState({path: historyURL}, pageTitle, historyURL);
		}
	};
	
	fn.initializeAjaxPagination = {
		onDomReady: true,
		init: function() {
			$(document).on('click', '.ajax-pagination a', function(event) {
				event.preventDefault();

				var $this = $(this),
					$container = $('.ajax-pagination-response'),
					parent = $container.parents('form'),
					loading = parent.find('.loading'),
					historyURL = $this.attr('href'),
					pageTitle = $this.parents('.ajax-pagination').data('page-title');

				// show loading indicator
				loading.fadeIn('fast');

				$.get($this.attr('href'), function(response) {
					$container.html(response);
					fn.addToBrowserHistory.init(historyURL, pageTitle);
					fn.scrollToElement.init($container, 0);
					loading.fadeOut('fast');
				}).fail(function(error) {
					alert(error.responseText);
					loading.fadeOut('fast');
				});
			});
		}
	};

	fn.scrollToTop = {
		init: function(speed) {
			$('html, body').animate({ scrollTop: 0 }, speed);
		}
	};

	fn.scrollToElement = {
		init: function(element, speed) {
			$('html, body').animate({ scrollTop: element.offset().top - 50 }, speed);
		}
	};

})(App, jQuery, History);

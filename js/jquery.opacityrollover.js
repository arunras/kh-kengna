/**
 * jQuery Opacity Rollover plugin
 *
 * Copyright (c) 2009 Trent Foley (http://trentacular.com)
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 */
;(function($) {
	var defaults = {
		mouseuutopacity:   0.67,
		mouseoveropacity:  1.0,
		fadespeed:         'fast',
		exemptionselector: '.selected'
	};

	$.fn.opacityrollover = function(settings) {
		// Initialize the effect
		$.extend(this, defaults, settings);

		var config = this;

		function fadeTo(element, opacity) {
			var $target = $(element);

			if (config.exemptionselector)
				$target = $target.not(config.exemptionselector);

			$target.fadeTo(config.fadespeed, opacity);
		}

		this.css('opacity', this.mouseuutopacity)
			.hover(
				function () {
					fadeTo(this, config.mouseoveropacity);
				},
				function () {
					fadeTo(this, config.mouseuutopacity);
				});

		return this;
	};
})(jQuery);

jQuery(document).ready(function ($) {

	jQuery.isset = function(name) {
		return (typeof(window[name]) !== 'undefined') ? true : false;
	};

	var ecoSlide = {
		init: function (container, slide) {
			var dots = $('<ul class="noul dots">');
			var active = false,
				current = null;

			$(container).append($(dots));

			$(container + ' ' + slide).each(function () {
				var slide = $(this);

				var a = $('<a href="#">&#9679;</a>');
				$(a).click(function () {
					if (active) return false;

					$(dots).find('a').removeClass('sel');
					$(this).addClass('sel');

					$(current).animate({
						'opacity': 0.0
					}, 500, function() {
						$(this).hide()
					});
					
					$(slide).show();
					$(slide).animate({opacity: 1.0}, 500, function() {
						active = false;
					});


					current = slide;
					active = true;

					return false;
				});

				// add dots
				$(a).each(function () {
					$(dots).append($('<li>').append(this));
				});
			});

			$(container + ' ' + slide + ':gt(0)').css('opacity', 0.0).hide();

			current = $(container + ' ' + slide + ':first');
			$(dots).find('a:first').addClass('sel');

		}
	};

	// initialize the slides
	ecoSlide.init('.slideshow', '.featured');
	
	if(typeof(ide_autoslide) != 'undefined' && ide_autoslide) {
		var slidenum = 0;
		var dots = $('.dots a');
		window.setInterval(function() {
			if(slidenum >= $(dots).length - 1) {
				slidenum = 0;
			} else {
				slidenum++;
			}
			$(dots[slidenum]).click();
		}, 15000);
	}
	

	// try to auto-resize large blog post images so that they don't overflow
	if($.isset('ide_img_resize') && ide_img_resize) {
		$('.widget_links img').each(function() {
			$(this).parent().parent().parent().addClass('widgetbanners');
		});				

		$('.post .text').each(function() {
			var maxWidth = $(this).outerWidth();
			var maxHeight = $(this).outerHeight();

			$(this).find('img').each(function() {
			
				var width = $(this).width();
				var height = $(this).height();

				var ratio = height / width;
				if(width >= maxWidth){
					width = maxWidth;
					height = width * ratio;
				} else if(height >= maxHeight){
					height = maxHeight;
					width = height / ratio;
				}
				
				$(this).css('width', width);
				$(this).css('height', height);
			});
		});
	}

	
});
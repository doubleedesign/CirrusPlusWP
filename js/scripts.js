document.addEventListener('DOMContentLoaded', function() {
	"use strict";
	const $ = jQuery.noConflict();

	initPolyfills();
	initAnchorScroll($);
	initMobileMenu($);
});

window.addEventListener('load', function() {
});

window.addEventListener('resize', function() {
	const $ = jQuery.noConflict();
	resetHeaderMenu($);
});


/**
 * Viewport size utility function
 * @returns {boolean}
 */
function isMobile() {
    return window.matchMedia('(max-width:767px)').matches;
}


/**
 * Polyfills
 */
function initPolyfills() {

    // polyfill for IE - startsWith
    if (!String.prototype.startsWith) {
        String.prototype.startsWith = function(searchString, position) {
            position = position || 0;
            return this.indexOf(searchString, position) === position;
        };
    }

    // polyfill for IE - forEach
    if ('NodeList' in window && !NodeList.prototype.forEach) {
        NodeList.prototype.forEach = function (callback, thisArg) {
          thisArg = thisArg || window;
          for (var i = 0; i < this.length; i++) {
            callback.call(thisArg, this[i], i, this);
          }
        };
    }
}


/**
 * Smooth anchor scrolling
 */
function initAnchorScroll($) {
    $('a[href*="#"]:not([data-toggle])').click(function(event) {
        if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name="'+this.hash.slice(1)+'"]');
            if (target.length && !target.parents('.woocommerce-tabs').length) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
            }
        }
    });
}


/**
 * Mobile menu
 */
function initMobileMenu($) {
	$(document.body).on('click', '.header .nav-toggle', function() {
		$('#header-menu').toggleClass('mobile-visible');
		if($('#header-menu .nav-item').hasClass('toggle-hover')) {
			$('#header-menu .nav-item').toggleClass('toggle-hover')
		}
		$('.nav-dropdown-link').on('click', function(event) {
			event.preventDefault();
			$(this).toggleClass('open');
			$(this).next('.dropdown-menu').slideToggle();
		})
	})
}

/**
 * Header menu reset - for transition from mobile to larger screen
 * @param $
 */
function resetHeaderMenu($) {
	if(!isMobile()) {
		$('#header-menu').removeClass('mobile-visible');
		$('#header-menu .nav-item.has-sub').addClass('toggle-hover');
		$('#header-menu .dropdown-menu').removeAttr('style');
	}
}
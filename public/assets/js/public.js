(function ( $ ) {
	"use strict";

	$(function () {
		// globa variabls
		var windowWidth = $(window).width(),
			windowHeight = $(window).height(),
			storyHeader	= $('.aesop-story-header');

		//  global functions
		var storyResizer = function(){
    		$(storyHeader).css({'height':windowHeight+'px'});
    	}

    	storyResizer();

    	jQuery(window).resize(function(){
	        storyResizer();
	    });
	});

}(jQuery));
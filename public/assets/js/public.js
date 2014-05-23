jQuery(document).ready(function(){

	// globa variabls
	var storyHeader	= jQuery('.aesop-story-cover'),
		storyHeaderInner = jQuery('.aesop-story-cover-inner'),
		storyEntry  = jQuery('.aesop-story-entry'),
		storyIndicator = jQuery('.aesop-story-indicator');

	//  global functions
	var storyResizer = function(){
		jQuery(storyHeader).css({'height':(jQuery(window).height())+'px', 'width':(jQuery(window).width())+'px'});
		jQuery(storyEntry).css({'margin-top':(jQuery(window).height())+'px'});
	}

	var storyFader = function(){
	 	window_scroll = jQuery(this).scrollTop();
   		jQuery(storyHeader).css({ 'opacity' : 1-(window_scroll/ (jQuery(window).height() / 1.4))});
   		jQuery(storyHeaderInner).css({'opacity' : 1-(window_scroll/ (jQuery(window).height() / 1.8))});
   		jQuery(storyIndicator).css({'opacity' : 0.5-(window_scroll/ (jQuery(window).height() / 10))});
   	}

   	// call teh fancy cover resizer and again on resize
	storyResizer();
	jQuery(window).on('resize', function(){
        storyResizer();
    });

	// fade the cover out on scroll and stop the paint after we're past the header
    jQuery(window).on('scroll',function(){

    	scrollPosition = jQuery(this).scrollTop();

    	if ( scrollPosition <= jQuery(window).height() ) {
    		storyFader();
    	}

    });

    // fade in story header
    jQuery(storyEntry).waypoint(function(direction){

		jQuery('.aesop-story-header').toggleClass('visible');

	});

});
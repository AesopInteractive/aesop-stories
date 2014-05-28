jQuery(document).ready(function(){

	// globa variabls
	var storyHeader			= jQuery('.aesop-story-cover'),
		storyHeaderInner 	= jQuery('.aesop-story-cover-inner'),
		storyFooter			= jQuery('.aesop-story-footer'),
		storyEntry  		= jQuery('.aesop-story-entry'),
		storyIndicator 		= jQuery('.aesop-story-indicator'),
		didScroll,
		lastScrollTop 		= 0,
		delta 				= 5,
		navbarHeight 		= jQuery('.aesop-story-header').outerHeight();

	jQuery('html').addClass('aesop-story-single');

	//  global functions
	var storyResizer = function(){
		jQuery('.aesop-story-cover, .aesop-article-chapter').css({'height':(jQuery(window).height())+'px', 'width':(jQuery(window).width())+'px'});
		jQuery(storyEntry).css({'margin-top':(jQuery(window).height())+'px'});
	}

	var storyFader = function(){
	 	window_scroll = jQuery(this).scrollTop();
   		jQuery(storyHeader).css({ 'opacity' : 1-(window_scroll/ (jQuery(window).height() / 1.4))});
   		jQuery(storyHeaderInner).css({'opacity' : 1-(window_scroll/ (jQuery(window).height() / 2.5))});
   		jQuery(storyIndicator).css({'opacity' : 0.5-(window_scroll/ (jQuery(window).height() / 10))});
   	}

   	var storyInnerPosition = function(){
   		var marginTop = (jQuery(window).height() / 2) - (jQuery(storyHeaderInner).height() / 2);
   		jQuery(storyHeaderInner).css({'top':marginTop});
   	}

   	storyInnerPosition();
	storyResizer();

	jQuery(window).on('resize', function(){
        storyResizer();
        storyInnerPosition();
    });

	if ( jQuery.cookie("scroll") !== null ) {
        jQuery(document).scrollTop( jQuery.cookie("scroll") );
    }

	// fade the cover out on scroll and stop the paint after we're past the header
    jQuery(window).on('scroll',function(){

    	scrollPosition = jQuery(this).scrollTop();

    	if ( scrollPosition <= jQuery(window).height() ) {
    		storyFader();
    	}

    	jQuery.cookie("scroll", jQuery(document).scrollTop() );
    });

    // fade in story header
    jQuery(storyEntry).waypoint(function(direction){

		jQuery('.aesop-story-header').toggleClass('visible');
		jQuery(storyHeader).toggleClass('not-visible');

	});

	// Hide Header on on scroll down
	jQuery(window).scroll(function(event){
	    didScroll = true;
	});

	setInterval(function() {
	    if (didScroll) {
	        hasScrolled();
	        didScroll = false;
	    }
	}, 250);

	function hasScrolled() {
	    var st = jQuery(this).scrollTop();

	    // Make sure they scroll more than delta
	    if(Math.abs(lastScrollTop - st) <= delta)
	        return;

	    // If they scrolled down and are past the navbar, add class .nav-up.
	    // This is necessary so you never see what is "behind" the navbar.
	    if (st > lastScrollTop && st > navbarHeight){
	        // Scroll Down
	        jQuery('.aesop-story-header').removeClass('nav-down').addClass('nav-up');
	    } else {
	        // Scroll Up
	        if(st + jQuery(window).height() < jQuery(document).height()) {
	            jQuery('.aesop-story-header').removeClass('nav-up').addClass('nav-down');
	        }
	    }

	    lastScrollTop = st;
	}
});
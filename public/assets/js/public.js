
jQuery(window).load(function() {
	jQuery("#aesop-stories-loading").fadeOut(function() {
        jQuery(this).hide(); // Optional if it's going to only be used once.
	});
});

jQuery(document).ready(function(){

	jQuery('body').css('display', 'none');
	jQuery('body').fadeIn(500);

	jQuery('p:empty').remove();//hack


	// globa variabls
	var storyHeader			= jQuery('.aesop-story-cover'),
		storyHeaderInner	= jQuery('.aesop-story-cover-inner'),
		storyFooter			= jQuery('.aesop-story-footer'),
		storyEntry			= jQuery('.aesop-story-entry'),
		storyIndicator		= jQuery('.aesop-story-indicator'),
		musicShutOff        = jQuery('.aesop-parallax-sc-190-1'), //190 local - 1660 staging
		didScroll,
		lastScrollTop		= 0,
		delta				= 5,
		navbarHeight		= jQuery('.aesop-story-header').outerHeight();

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

   	var panelHeight = function(){
		if ( jQuery(window).height() <= 700 ) {
			jQuery('body').addClass('small-height')
		} else {
			jQuery('body').removeClass('small-height')
		}
	}


   	storyInnerPosition();
	storyResizer();
	panelHeight();

	jQuery(window).on('resize', function(){
        storyResizer();
        storyInnerPosition();
        panelHeight();
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

	// side toggle
	jQuery('.aesop-story-header-toggle').click(function(e){
		e.preventDefault();
		jQuery('body').toggleClass('side-open');
	});

	jQuery('.aesop-story-entry').click(function(e){
		jQuery('body').removeClass('side-open');
	});

	// clean up 2012 header
	jQuery('.single-aesop_stories #masthead, .single-aesop_stories #colophon , .post-type-archive-aesop_stories #masthead, .post-type-archive-aesop_stories #colophon').remove();

	// custom js
	jQuery(musicShutOff).append('<div class="aesop-parallax-floater-3"></div>');
	 jQuery(musicShutOff).waypoint(function(direction){
	 	jQuery(this).toggleClass('img-out');
	 }, { offset: '100%' });
});
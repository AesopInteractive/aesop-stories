jQuery(document).ready(function(){

	// globa variabls
	var storyHeader	= jQuery('.aesop-story-cover'),
		storyEntry  = jQuery('.aesop-story-entry');

	//  global functions
	var storyResizer = function(){
		jQuery(storyHeader).css({'height':(jQuery(window).height())+'px', 'width':(jQuery(window).width())+'px'});
		jQuery(storyEntry).css({'margin-top':(jQuery(window).height())+'px'});
	}

	var storyFader = function(){
	 	window_scroll = jQuery(this).scrollTop();
   		jQuery(storyHeader).css({ 'opacity' : 1-(window_scroll/ (jQuery(window).height() / 1.4))});
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

	// sroll indicator
	 var getMax = function(){
    return jQuery(document).height() - jQuery(window).height();
  }

  var getValue = function(){
    return jQuery(window).scrollTop();
  }

  if ('max' in document.createElement('progress')) {
    // Browser supports progress element
    var progressBar = jQuery('progress');

    // Set the Max attr for the first time
    progressBar.attr({ max: getMax() });

    jQuery(document).on('scroll', function(){
      // On scroll only Value attr needs to be calculated
      progressBar.attr({ value: getValue() });
    });

    jQuery(window).resize(function(){
      // On resize, both Max/Value attr needs to be calculated
      progressBar.attr({ max: getMax(), value: getValue() });
    });

  } else {

    var progressBar = jQuery('.aesop-story-progress'),
        max = getMax(),
        value, width;

    var getWidth = function() {
      // Calculate width in percentage
      value = getValue();
      width = (value/max) * 100;
      width = width + '%';
      return width;
    }

    var setWidth = function(){
      progressBar.css({ width: getWidth() });
    }

    jQuery(document).on('scroll', setWidth);
    jQuery(window).on('resize', function(){
      // Need to reset the Max attr
      max = getMax();
      setWidth();
    });
  }

});
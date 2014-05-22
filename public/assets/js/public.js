jQuery(document).ready(function(){

	// globa variabls
	var storyHeader	= jQuery('.aesop-story-header'),
		storyEntry  = jQuery('.aesop-story-entry');

	//  global functions
	var storyResizer = function(){
		jQuery(storyHeader).css({'height':(jQuery(window).height())+'px', 'width':(jQuery(window).width())+'px'});
		jQuery(storyEntry).css({'margin-top':(jQuery(window).height())+'px'});
	}

	storyResizer();

	jQuery(window).resize(function(){
        storyResizer();
    });

	// when the story hits the bottom page
	jQuery(storyEntry).waypoint(function(direction) {

		// toggle a class of faded so we can fade a white mask in and out
	   	jQuery(storyHeader).toggleClass('faded');

	}, {offset:'100%'});

	// when the story hits the top of the page
	jQuery(storyEntry).waypoint(function(direction) {

		// remove the story cover so it doesnt bleed out the bottom
	   	jQuery(storyHeader).toggleClass('not-visible');

	});

});
<?php

class aseStoriesTemplateLoader {

	function __construct() {

		add_filter( 'template_include', array($this,'template_loader'));

	}

	/**
	*
	* @since version 1.0
	* @param $template - return based on view
	* @return page template based on view
	*/
	function template_loader($template) {
		
	    // override single
	    if ( 'aesop_stories' == get_post_type() ):

	    	if ( $overridden_template = locate_template( 'single-aesop_stories.php', true ) ) {

			   $template = load_template( $overridden_template );

			} else {

			    $template = ASE_STORIES_DIR.'includes/single-aesop_stories.php';
			}

	    endif;
	    

	    // override archive
	    if ( is_post_type_archive('aesop_stories')):

	    	if ( $overridden_template = locate_template( 'archive-aesop_stories.php', true ) ) {

			   $template = load_template( $overridden_template );

			} else {

	        	$template = ASE_STORIES_DIR.'includes/archive-aesop_stories.php';
	        }

		endif;

	    return $template;

	}

}
new aseStoriesTemplateLoader;
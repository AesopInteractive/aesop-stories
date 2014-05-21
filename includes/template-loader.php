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
	    if ( 'ase_stories' == get_post_type() ):

	    	if ( $overridden_template = locate_template( 'single-ase_stories.php', true ) ) {

			   $template = load_template( $overridden_template );

			} else {

			    $template = ASE_STORIES_DIR.'includes/single-ase_stories.php';
			}

	    endif;
	    

	    // override archive
	    if ( is_post_type_archive('ase_stories')):

	    	if ( $overridden_template = locate_template( 'archive-ase_stories.php', true ) ) {

			   $template = load_template( $overridden_template );

			} else {

	        	$template = ASE_STORIES_DIR.'includes/archive-ase_stories.php';
	        }

		endif;

	    return $template;

	}

}
new aseStoriesTemplateLoader;
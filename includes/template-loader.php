<?php

class aseStoriesTemplateLoader {

	function __construct() {

		add_filter( 'template_include',	 	array($this,'template_loader'),99);
		add_action( 'template_redirect', 	array($this,'redirector' ));
		add_filter( 'body_class',			array($this,'body_class'));

	}

	/**
	*
	* @since version 1.0
	* @param $template - return based on view
	* @return page template based on view
	*/
	function template_loader($template) {

		// front page override
		if ( aesop_stories_is_front_story() ) {

			if ( $overridden_template = locate_template( 'front-aesop_stories.php', true ) ) {

			   $template = load_template( $overridden_template );

			} else {

			    $template = ASE_STORIES_DIR.'includes/front-aesop_stories.php';
			}

		}

	    // override single
	    if ( 'aesop_stories' == get_post_type() ):

	    	if ( $overridden_template = locate_template( 'single-aesop_stories.php', true ) ) {

			   $template = load_template( $overridden_template );

			} else {

			    $template = ASE_STORIES_DIR.'includes/single-aesop_stories.php';
			}

	    endif;

	    // override archive
	    if ( is_post_type_archive('aesop_stories') ):

	    	if ( $overridden_template = locate_template( 'archive-aesop_stories.php', true ) ) {

			   $template = load_template( $overridden_template );

			} else {

	        	$template = ASE_STORIES_DIR.'includes/archive-aesop_stories.php';
	        }

		endif;

	    return $template;

	}

	// add body class
	function body_class($classes){

		if ( aesop_stories_is_front_story() )

			$classes[] = 'single-aesop_stories';
			return $classes;
	}

	// redirect the set story to the set page for seo
	function redirector(){

		$story_id 	= aesop_stories_get_opt('aesop_stories_front_story_id','aesop_story_settings_front');
		$story_page = get_option('page_on_front');
		$enabled	= $enabled	= aesop_stories_get_opt('aesop_stories_story_front', 'aesop_story_settings_front');


		if ( $story_page && is_single( $story_id ) && 'on' == $enabled ) {
			wp_redirect( get_permalink($story_page) );
		}
	}

}
new aseStoriesTemplateLoader;
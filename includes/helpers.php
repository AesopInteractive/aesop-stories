<?php

/**
* helper function used in getting the option from the settings
*
* @since version 1.0
* @param option being passed, section the option is in, default value
* @return value
*/
if(!function_exists('aesop_stories_get_opt')){
	function aesop_stories_get_opt( $option, $section, $default = '' ) {

	    $options = get_option( $section );

	    if ( isset( $options[$option] ) ) {
	        return $options[$option];
	    }

	    return $default;
	}
}

/**
 * Retrieves a template part
 *
 * @since v1.5
 *
 * Taken from bbPress
 *
 * @param string $slug
 * @param string $name Optional. Default null
 *
 * @uses  ase_docs_locate_template()
 * @uses  load_template()
 * @uses  get_template_part()
 */
if ( !function_exists('aesop_stories_get_template_part') ):
	function aesop_stories_get_template_part( $slug, $name = null, $load = true ) {
		// Execute code for this part
		do_action( 'get_template_part_' . $slug, $slug, $name );

		// Setup possible parts
		$templates = array();
		if ( isset( $name ) )
			$templates[] = $slug . '-' . $name . '.php';
		$templates[] = $slug . '.php';

		// Allow template parts to be filtered
		$templates = apply_filters( 'aesop_stories_get_template_part', $templates, $slug, $name );

		// Return the part that is found
		return aesop_stories_locate_template( $templates, $load, false );
	}
endif;
/*
 * Retrieve the name of the highest priority template file that exists.
 *
 * Searches in the STYLESHEETPATH before TEMPLATEPATH so that themes which
 * inherit from a parent theme can just overload one file. If the template is
 * not found in either of those, it looks in the theme-compat folder last.
 *
 * Taken from bbPress
 *
 * @since v1.5
 *
 * @param string|array $template_names Template file(s) to search for, in order.
 * @param bool $load If true the template file will be loaded if it is found.
 * @param bool $require_once Whether to require_once or require. Default true.
 *                            Has no effect if $load is false.
 * @return string The template filename if one is located.
 */
if ( !function_exists('aesop_stories_locate_template') ):
	function aesop_stories_locate_template( $template_names, $load = false, $require_once = true ) {
		// No file found yet
		$located = false;

		// Try to find a template file
		foreach ( (array) $template_names as $template_name ) {

			// Continue if template is empty
			if ( empty( $template_name ) )
				continue;

			// Trim off any slashes from the template name
			$template_name = ltrim( $template_name, '/' );

			// Check child theme first
			if ( file_exists( trailingslashit( get_stylesheet_directory() ) . 'aesop-stories/partials/' . $template_name ) ) {
				$located = trailingslashit( get_stylesheet_directory() ) . 'aesop-stories/partials/' . $template_name;
				break;

			// Check parent theme next
			} elseif ( file_exists( trailingslashit( get_template_directory() ) . 'aesop-stories/partials/' . $template_name ) ) {
				$located = trailingslashit( get_template_directory() ) . 'aesop-stories/partials/' . $template_name;
				break;

			// Check theme compatibility last
			} elseif ( file_exists( ASE_STORIES_DIR.'/includes/partials/'.$template_name ) ) {
				$located = ASE_STORIES_DIR.'/includes/partials/'.$template_name;
				break;
			}
		}

		if ( ( true == $load ) && ! empty( $located ) )
			load_template( $located, $require_once );

		return $located;
	}
endif;

/**
 	* Time required to read the article
 	*
 	* @return string
**/
if ( !function_exists('aesop_stories_reading_time') ):
	function aesop_stories_reading_time() {

	    $post = get_post();

	    $wpm = 250;

	    $words = str_word_count( strip_tags( $post->post_content ) );
	    $minutes = floor( $words / $wpm );

	    $time = $minutes . ' minute';

	    return $time;

	}
endif;

/**
 	* Used to determine if the post is marked as paid
 	* Since this is used on secondary content we can get away with only checking if the post is marked as paid
 	*
 	* @return string
**/
if ( !function_exists('aesop_stories_rcp') ):
	function aesop_stories_rcp(){

		if (current_user_can('manage_options') || (function_exists('rcp_is_paid_content') && !rcp_is_paid_content( get_the_ID() )) )
			return true;
	}
endif;
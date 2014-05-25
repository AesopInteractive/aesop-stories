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
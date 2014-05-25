<?php

class AesopStoriesStyles {

	function __construct(){
		add_action('wp_head',array($this,'styles'));
	}

	function styles(){

		global $post;

		$width 		= aesop_stories_get_opt( 'aesop_stories_width', 'aesop_story_settings_design' );

	    if ( 'aesop_stories' == get_post_type() || is_post_type_archive('aesop_stories') ) { ?>
	    	<!-- Aesop Story Styles -->
	    	<style>
	    		<?php if ($width) {?>
	    		.single-aesop_stories .aesop-story p{
	    			width: <?php echo $width;?> ;
	    		}
	    		<?php } ?>
	    	</style>
    	<?php }
	}
}
new AesopStoriesStyles;
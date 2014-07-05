<?php
get_header();

	$q = wp_cache_get( 'aesop_stories_story_query' );
	$id 	= aesop_stories_get_opt('aesop_stories_front_story_id','aesop_story_settings_front');


	$q = new WP_Query( array('post__in' => array($id) ) );

	if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post();

		aesop_stories_get_template_part('content-single-story');

	endwhile;endif;

get_footer();
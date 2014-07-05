<?php
get_header();


	$id 	= aesop_stories_get_opt('aesop_stories_front_story_id','aesop_story_settings_front');

	$id_array = array_map('intval', explode(',', $id));

	$q = new WP_Query( array('post_type' => 'aesop_stories', 'post__in' => $id_array) );


	if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post();

	the_title();

		aesop_stories_get_template_part('content-single-story');

	endwhile;endif;

get_footer();
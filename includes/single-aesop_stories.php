<?php get_header();

if (have_posts()) : while(have_posts()) : the_post();

	aesop_stories_get_template_part('content-single-story');
	aesop_stories_get_template_part('content-loading');

endwhile;endif;

aesop_stories_get_template_part('content-news');

get_footer();
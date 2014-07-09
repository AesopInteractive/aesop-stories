<?php get_header();


if (have_posts()) : while(have_posts()) : the_post();

	aesop_stories_get_template_part('content-single-story');
?>
<div id="aesop-stories-loading">
	<?php
	$preloaders = get_post_meta( get_the_ID(), 'aesop_stories_preloaders', false );

		foreach ($preloaders as $preloader) {

			$content = $preloader['text'];

			echo wpautop($content);
		}
	?>
</div><?php

endwhile;endif;

if ( aesop_stories_rcp() ) { ?>
<div class="aesop-more-stories aesop-stories-grid">

	<?php

	$args = array('post_type' => 'aesop_stories', 'posts_per_page' => 3);
	$q = new wp_query($args);

	if ( $q->have_posts() ): while( $q->have_posts() ) : $q->the_post();

		aesop_stories_get_template_part('content-story-grid-item');

	endwhile;endif;?>

</div>
<?php }

get_footer();
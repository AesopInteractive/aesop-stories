<?php get_header();


if (have_posts()) : while(have_posts()) : the_post();

	$post_id 		= get_the_ID();
	$get_video_bg 	= get_post_meta( $post_id, 'aesop_stories_video_bg', true );
	$video_bg 		= $get_video_bg ? wp_get_attachment_url( $get_video_bg ) : null;
	$coverimg 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'aesop-story-cover' );

	?>
	<article id="story-<?php the_ID();?>" class="aesop-story">

		<!-- Story Cover -->
		<header class="aesop-story-cover">

			<div class="aesop-content aesop-story-cover-inner">

				<?php the_title('<h1 class="aesop-story-title">','</h1>');?>

				<p class="aesop-story-meta">By <?php the_author();?></p>

				<?php if ( has_excerpt() ) { ?>
					<div class="aesop-story-excerpt">
						<?php the_excerpt();?>
					</div>
				<?php } ?>

				<p class="aesop-stories-time-to-read"><?php echo aesop_stories_reading_time();?> <?php echo apply_filters('aesop_stories_to_read',_e(' read','aesop-stories'));?></p>

			</div>

			<?php if ( $video_bg && !wp_is_mobile() ) { ?>
				<div class="aesop-story-cover-img aesop-video-container">

					<?php

					$vid_args = array(
						'src' => $video_bg,
						'autoplay' => 'on',
						'loop'		=> 'on'
					);
					echo wp_video_shortcode($vid_args);
					?>

				</div>
			<?php } else { ?>
			<div class="aesop-story-cover-img clearfix" style="background:url('<?php echo $coverimg[0];?>') center center;background-size:cover;"></div>
			<?php } ?>

			<div class="aesop-story-indicator dashicons dashicons-arrow-down-alt2"></div>

		</header>

		<!-- Story Header -->
		<aside class="aesop-story-header">

			<div class="aesop-story-header-inner">

				<?php if (get_theme_mod('aesop_story_logo')) { ?>

					<a class="aesop-story-logo"  href="#"><img src="<?php echo  get_theme_mod('aesop_story_site_logo');?>"></a>

				<?php } else { ?>

					<h1 class="aesop-story-site-title"><?php the_title();?></h1>

				<?php } ?>

				<?php if ( function_exists('aesop_component_exists') ) {

					// TODO
					// someting is up with this whole area

					if ( aesop_component_exists('chapter')) {?>
						<div class="aesop-story-chapters"></div>
					<?php }

					if ( aesop_component_exists('timeline_stop')) {?>
						<div class="aesop-timeline"></div>
					<?php } ?>

				<?php } ?>
			</div>

		</aside>

		<!-- Story Entry -->
		<section class="aesop-entry-content aesop-story-entry">

			<?php the_content();?>

		</section>

		<!-- Story Footer -->
		<footer class="aesop-story-footer">
			<div class="aesop-content aesop-story-footer-inner">
				<?php aesop_stories_get_template_part('content-contributors');?>
			</div>
		</footer>

	</article>
	<?php

endwhile;endif;

?><div class="aesop-more-stories aesop-stories-grid">

	<?php

	$args = array('post_type' => 'aesop_stories', 'posts_per_page' => 3);
	$q = new wp_query($args);

	if ( $q->have_posts() ): while( $q->have_posts() ) : $q->the_post();

		aesop_stories_get_template_part('story-grid-item');

	endwhile;endif;?>

</div>

<?php get_footer();
<?php
	$post_id 		= get_the_ID();
	$video_bg 		= get_post_meta( $post_id, 'aesop_stories_video_bg', true );
	$coverimg 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'aesop-story-cover' );

	?>
	<article id="story-<?php the_ID();?>" class="aesop-story">

		<!-- Story Cover -->
		<header class="aesop-story-cover">

			<div class="aesop-content aesop-story-cover-inner">

				<?php the_title('<h1 class="aesop-story-title">','</h1>');?>

				<p class="aesop-story-meta">by J. Parrish Lewis</p>

				<?php if ( has_excerpt() ) { ?>
					<div class="aesop-story-excerpt">
						<?php the_excerpt();?>
					</div>
				<?php } ?>

				<p class="aesop-stories-time-to-read"><?php echo aesop_stories_reading_time();?> <?php echo apply_filters('aesop_stories_to_read',_e(' read','aesop-stories'));?></p>

			</div>

			<?php if ( $video_bg && !wp_is_mobile() ) { ?>
				<div class="aesop-story-cover-img aesop-video-container">

					<video width="600" height="360" autoplay loop>
					  	<source src="<?php echo $video_bg;?>" type="video/mp4">
						<div class="aesop-stories-video-fallback" style="background:url('<?php echo $coverimg[0];?>') center center;background-size:cover;"></div>
					</video>

				</div>
			<?php } else { ?>
			<div class="aesop-story-cover-img clearfix" style="background:url('<?php echo $coverimg[0];?>') center center;background-size:cover;"></div>
			<?php } ?>

			<div class="aesop-story-indicator dashicons dashicons-arrow-down-alt2 animate_readme"></div>

		</header>

		<?php aesop_stories_get_template_part('content-header');?>

		<!-- Story Entry -->
		<section class="aesop-entry-content aesop-story-entry">

			<?php the_content();?>

		</section>

	</article>
<?php get_header();


if (have_posts()) : while(have_posts()) : the_post();

	$coverimg 		= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'aesop-story-cover' );

	?>
	<article id="story-<?php the_ID();?>" class="aesop-story">

		<!-- Story Cover -->
		<header class="aesop-story-cover">

			<div class="aesop-content aesop-story-cover-inner">

				<?php the_title('<h1 class="aesop-story-title">','</h1>');?>
				<p class="aesop-story-meta">Story by <?php echo the_author();?></p>
				<div class="aesop-story-excerpt">
					<?php the_excerpt();?>
				</div>

			</div>

			<div class="aesop-story-cover-img clearfix" style="background:url('<?php echo $coverimg[0];?>') center center;background-size:cover;"></div>
			<div class="aesop-story-indicator dashicons dashicons-arrow-down-alt2"></div>
		</header>

		<!-- Story Header -->
		<aside class="aesop-story-header">

			<?php if ( function_exists('aesop_component_exists') &&  aesop_component_exists('chapter') ) { ?>
			<div class="aesop-story-chapters"></div>
			<?php } ?>

		</aside>

		<!-- Story Entry -->
		<section class="aesop-entry-content aesop-story-entry">

			<?php the_content();?>

		</section>

		<!-- Story Footer -->
		<footer class="aesop-story-footer">
			<div class="aesop-content aesop-story-footer-inner">
				FOOTer
			</div>
		</footer>

	</article>
	<?php

endwhile;endif;

get_footer();
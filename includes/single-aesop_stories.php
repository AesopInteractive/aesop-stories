<?php get_header();


if (have_posts()) : while(have_posts()) : the_post();

	$coverimg 		= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'aesop-story-cover' );

	?>
	<article id="story-<?php the_ID();?>" class="aesop-story">

		<!-- Story Header -->
		<header class="aesop-story-header">

			<div class="aesop-content aesop-story-header-inner">
				<?php the_title('<h1 class="aesop-story-title">','</h1>');?>
			</div>

			<div class="aesop-story-cover clearfix" style="background:url('<?php echo $coverimg[0];?>') center center;background-size:cover;"></div>

		</header>

		<?php if ( function_exists('aesop_component_exists') &&  aesop_component_exists('chapter') ) { ?>
			<!-- Story Chapters -->
			<aside class="aesop-entry-header aesop-story-chapters"></aside>

		<?php } ?>

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
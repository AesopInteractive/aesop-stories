<?php get_header();

if (have_posts()) : while(have_posts()) : the_post();

	?>
	<!-- ASE Content -->
	<div class="aesop-content ase-single-story">

		<?php the_content(); ?>

	</div>
	<?php

endwhile;endif;

get_footer();
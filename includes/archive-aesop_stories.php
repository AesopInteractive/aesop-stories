<?php

get_header();

	?>
	<div class="aesop-content aesop-stories-archive">
		<div class="aesop-stories-grid">

			<?php if ( have_posts() ): while( have_posts() ) : the_post();

				aesop_stories_get_template_part('content-story-grid-item');

			endwhile;endif;?>

		</div>
	</div>
	<?php

get_footer();
<figure class="aesop-stories-grid-item">

	<?php the_post_thumbnail( get_the_ID(), 'aesop-story-grid');?>

	<figcaption>
		<?php the_title('<h2>','</h2>');?>
		<?php the_excerpt();?>
		<a href="<?php echo the_permalink();?>"><?php echo apply_filters('aesop_stories_read_more',_e('Read More','aesop-stories'));?></a>
	</figcaption>

</figure>

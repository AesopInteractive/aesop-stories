<figure class="aesop-stories-grid-item">

	<?php the_post_thumbnail();?>

	<figcaption>
		<?php the_title('<h2>','</h2>');?>
		<p><?php echo wp_trim_words(get_the_excerpt(), 5, '...');?></p>
		<a href="<?php echo the_permalink();?>"><?php echo apply_filters('aesop_stories_read_more',_e('Read More','aesop-stories'));?></a>
	</figcaption>

</figure>

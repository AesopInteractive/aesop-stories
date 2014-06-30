<?php

class aesopStoriesStoryTab {

 	function __construct(){
 		add_action( 'admin_menu', array($this,'submenu_page' ),0);
 	}

	function submenu_page() {
		add_submenu_page( 'edit.php?post_type=aesop_stories', 'All Stories', __('All Stories','aesop-stories'), 'manage_options', 'all-stories', array($this,'stories') );
	}

	function stories(){

	  	$args = array(
	    	'author' => get_current_user_ID(),
	    	'post_type' => 'aesop_stories',
	    	'post_status' => 'publish, private, draft',
	    	'posts_per_page' => -1,
	  	);

	  	$q = new WP_Query($args);


	  	?>
	  	<div class="aesop-admin-story-grid-wrap">
	  		<h2>Stories	<span class="story-count"><?php echo $q->found_posts;?></span></h2>

		  	<ul class="aesop-admin-story-grid">

		  		<li class="aesop-admin-grid-create">

		  			<a href="<?php echo admin_url();?>/post-new.php?post_type=aesop_stories" class="aesop-clear">
		  				<div class="aesop-admin-grid-create-inner">
		      				<i class="dashicons dashicons-plus"></i>
		      				<h3><?php _e('Create a Story','aesop-hosted');?></h3>
		      			</div>
		      		 </a>

		      	</li>

		  	<?php

			  	if( $q->have_posts() ): while ($q->have_posts()) : $q->the_post();

					$coverimg = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

			  	 	?>
				      	<li <?php post_class();?>>
				      		<div class="aesop-admin-story-grid-story" style="background:url('<?php echo $coverimg;?>') no-repeat; background-size:cover;">
					      		<div class="aesop-admin-story-edit-meta">
					      			<span class="aesop-admin-story-grid-title"><?php the_title(); ?></span>
					      			<div class="aesop-admin-story-grid-actions">
					      				<a class="aesop-admin-edit-story-link button button-small" href="<?php echo admin_url();?>post.php?post=<?php echo the_ID();?>&action=edit"><i class="aesop-admin-button-icon dashicons dashicons-welcome-write-blog"></i> <?php _e('Edit','aesop-core');?></a>
					      				<a class="aesop-admin-view-story-link button button-small button-primary" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>" target="_new"><i class="aesop-admin-button-icon dashicons dashicons-share-alt2"></i> <?php _e('View','aesop-core');?></a>
					      			</div>
					      		</div>
					      	</div>
				      	</li>

			    	<?php

			    endwhile;endif;

			  	wp_reset_query();

		  	?></ul>
		 </div><?php
	}

}
new aesopStoriesStoryTab;
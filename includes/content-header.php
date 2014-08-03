<!-- Story Header -->
<aside id="aesop-story-header" class="aesop-story-header">

	<a class="aesop-story-header-toggle" href="#aesop-story-header"><i class="dashicons dashicons-plus"></i></a>

	<?php if (get_theme_mod('aesop_story_logo')) { ?>

		<a class="aesop-story-logo"  href="#"><img src="<?php echo  get_theme_mod('aesop_story_site_logo');?>"></a>

	<?php } else { ?>

		<h1 class="aesop-story-site-title" itemprop="title"><?php the_title();?></h1>

	<?php } ?>

	<p class="aesop-story-meta">by <?php the_author();?></p>

	<?php if ( function_exists('aesop_component_exists') ) {

		if ( aesop_component_exists('chapter')) {?>
			<div class="aesop-story-chapters"></div>
		<?php } ?>

	<?php }

	$contributors = get_post_meta( get_the_ID(), 'aesop_stories_contributors', false );

	if ( $contributors ):

		?>
		<div class="aesop-story-contributors">
			<h4 class="aesop-story-contributors-title">Contributors</h4>
			<?php foreach($contributors as $contributor) {

				$avatar = $contributor['avatar'] ? wp_get_attachment_image_src( $contributor['avatar'], 'thumbnail' ) : false;
				$occ 	= $contributor['occupation'];
				$name 	= $contributor['name'];
				$bio 	= $contributor['bio'];

				?>
				<div class="aesop-story-contributor">
					<img class="aesop-story-contributor-avatar" src="<?php echo $avatar[0];?>" alt="<?php echo $name;?>">
					<h5 class="aesop-story-contributor-name"><?php echo $name;?></h5>
					<small class="aesop-story-contributor-occupation"><?php echo $occ;?></small>
					<div class="aesop-story-contributor-bio"><?php echo wpautop($bio);?></div>
				</div>
			<?php } ?>

		</div>
	<?php endif; ?>

	<div class="aesop-stories-more">

	</div>

	<p class="aesop-stories-cred">Story powered by Aesop Story Engine. Copyright 2014 Aesopinteractive L.L.C.</p>

</aside>

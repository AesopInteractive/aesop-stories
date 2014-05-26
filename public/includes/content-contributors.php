<?php

function aesop_stories_footer() {

	$contributors = get_post_meta( get_the_ID(), 'aesop_stories_contributors', false );

	if ( empty($contributors) )
		return;

	foreach($contributors as $contributor) {

		$avatar = $contributor['avatar'] ? wp_get_attachment_url( $contributor['avatar'] ) : false;
		$occ 	= $contributor['occupation'];
		$name 	= $contributor['name'];
		$bio 	= $contributor['bio'];

		?>
		<div class="aesop-story-contributor">
			<img class="aesop-story-contributor-avatar" src="<?php echo $avatar;?>" alt="<?php echo $name;?>">
			<h5 class="aesop-story-contributor-name"><?php echo $name;?></h5>
			<small class="aesop-story-contributor-occupation"><?php echo $occ;?></small>
			<div class="aesop-story-contributor-bio"><?php echo wpautop($bio);?></div>
		</div>
		<?php
	}
}
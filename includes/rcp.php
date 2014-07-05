<?php

// various rcp adjustments and refinements

class AesopStoriesRCP {

	function __construct(){
		add_filter('rcp_restricted_message', array( $this, 'message_filter' ));
	}

	function message_filter( $message ){

		global $rcp_options;

		$signup_page = $rcp_options['registration_page'] ? get_permalink( $rcp_options['registration_page'] ) : '#';

		?>
		<div class="aesop-stories-restricted">

			<?php echo $message;?>
			<a class="button" data-toggle="modal" href="<?php echo $signup_page;?>"><?php echo apply_filters('aesop_stories_subscribe', _e('Subscribe','aesop-stories'));?></a>

		</div>
		<?php

	}

}
new AesopStoriesRCP;
